<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\HomeContent;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('category')->latest()->get();
        $categories = Category::all();

        // Si la ruta es de admin, mostramos el panel, si no, la oferta pública
        if ($request->is('admin/*')) {
            return view('admin.courses.index', compact('courses', 'categories'));
        }
        
        return view('public.oferta', compact('courses', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Validamos los campos normales y agregamos validación para los archivos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'mode' => 'required|string',
            'hours' => 'required|integer',
            'duration' => 'nullable|string',
            'cost' => 'nullable|string',
            'justification' => 'required|string',
            'general_objective' => 'nullable|string',
            'specific_objectives' => 'nullable|string', 
            'topics' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Máximo 2MB para imagen
            'pdf_document' => 'nullable|mimes:pdf|max:5120', // Máximo 5MB para PDF
        ]);

        // 2. Convertimos el texto de los textareas en arrays
        if ($request->has('specific_objectives')) {
            $validated['specific_objectives'] = array_filter(explode("\n", str_replace("\r", "", $request->specific_objectives)));
        }
        
        if ($request->has('topics')) {
            $validated['topics'] = array_filter(explode("\n", str_replace("\r", "", $request->topics)));
        }

        // 3. Procesar y guardar la Imagen
        if ($request->hasFile('image')) {
            // Guarda la imagen en storage/app/public/courses/images
            $imagePath = $request->file('image')->store('courses/images', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        } else {
            // Imagen por defecto si no suben ninguna
            $validated['image_url'] = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800';
        }

        // 4. Procesar y guardar el PDF Normativo
        if ($request->hasFile('pdf_document')) {
            // Guarda el PDF en storage/app/public/courses/pdfs
            $pdfPath = $request->file('pdf_document')->store('courses/pdfs', 'public');
            $validated['pdf_document'] = '/storage/' . $pdfPath; 
        }

        // 5. Crear el curso en la base de datos
        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Curso publicado exitosamente con sus archivos adjuntos.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('success', 'Curso eliminado correctamente.');
    }

    public function show($id)
{
    $course = Course::with('category')->findOrFail($id);
    return view('public.course-details', compact('course'));
}
public function oferta(Request $request)
{
    // 1. Traemos todas las categorías para los botones
    $categories = Category::all();
    //Traemos los textos de la página principal
    $homeContent = HomeContent::firstOrCreate(['id' => 1]);
    // 2. Preparamos la consulta de cursos
    $query = Course::query();

    // 3. MAGIA: Si el usuario dio clic en un botón (la URL tiene ?category=X)
    if ($request->has('category') && $request->category != null) {
        $query->where('category_id', $request->category);
    }

    // 4. Ejecutamos la consulta
    $courses = $query->get();

    // 5. Devolvemos la vista con los cursos filtrados
    return view('public.oferta', compact('courses', 'categories','homeContent'));
    
}
public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::all();
        
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {
        
        $course = Course::findOrFail($id);

        // 1. Validamos los datos (nota que las imágenes y PDFs son "nullable" porque no es obligatorio cambiarlos)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'mode' => 'required|string',
            'hours' => 'required|integer',
            'duration' => 'nullable|string',
            'cost' => 'nullable|string',
            'justification' => 'required|string',
            'general_objective' => 'nullable|string',
            'specific_objectives' => 'nullable|string', 
            'topics' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
            'pdf_document' => 'nullable|mimes:pdf|max:5120', 
        ]);

        // 2. Convertimos el texto de los textareas en arrays (Igual que en tu función store)
        if ($request->has('specific_objectives')) {
            $validated['specific_objectives'] = array_filter(explode("\n", str_replace("\r", "", $request->specific_objectives)));
        }
        
        if ($request->has('topics')) {
            $validated['topics'] = array_filter(explode("\n", str_replace("\r", "", $request->topics)));
        }

        // 3. Procesar y reemplazar la Imagen (SOLO si el usuario subió una nueva)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses/images', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        }

        // 4. Procesar y reemplazar el PDF (SOLO si el usuario subió uno nuevo)
        if ($request->hasFile('pdf_document')) {
            $pdfPath = $request->file('pdf_document')->store('courses/pdfs', 'public');
            $validated['pdf_document'] = '/storage/' . $pdfPath; 
        }

        // 5. Actualizamos el curso en la base de datos
        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Curso actualizado exitosamente.');
    }
}
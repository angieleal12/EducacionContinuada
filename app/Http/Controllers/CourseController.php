<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\HomeContent;

class CourseController extends Controller
{
    // Función privada actualizada para coincidir con la migración (Fase 1)
    private function getCategoriasFijas()
    {
        return [
            'DIPLOMADOS DE OPCION DE GRADO',
            'DIPLOMADOS DE PUBLICO GENERAL',
            'SEMINARIOS',
            'SEMINARIOS DE INGLES', // Actualizado
            'CURSOS'
        ];
    }

    public function index(Request $request)
    {
        $courses = Course::latest()->get();
        $categories = $this->getCategoriasFijas();

        if ($request->is('admin/*')) {
            return view('admin.courses.index', compact('courses', 'categories'));
        }
        
        return view('public.oferta', compact('courses', 'categories'));
    }

    public function create()
    {
        $categories = $this->getCategoriasFijas();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
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
            
            // --- NUEVO: Validación de los horarios dinámicos ---
            'schedules' => 'nullable|array',
            'schedules.*' => 'nullable|string'
        ]);

        // Procesamiento de Objetivos
        if ($request->has('specific_objectives')) {
            $validated['specific_objectives'] = array_filter(explode("\n", str_replace("\r", "", $request->specific_objectives)));
        }
        
        // Procesamiento de Temas
        if ($request->has('topics')) {
            $validated['topics'] = array_filter(explode("\n", str_replace("\r", "", $request->topics)));
        }

        // --- NUEVO: Limpieza y guardado de los Horarios en formato JSON ---
        if ($request->has('schedules')) {
            // Filtra los horarios vacíos por si agregaron campos extras sin llenarlos
            $horariosLimpios = array_filter($request->schedules, function($value) {
                return !is_null($value) && trim($value) !== '';
            });
            // Reindexa el arreglo para que sea un JSON limpio (["Horario 1", "Horario 2"])
            $validated['schedules'] = !empty($horariosLimpios) ? array_values($horariosLimpios) : null;
        }

        // Procesamiento de Imágenes
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses/images', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        } else {
            $validated['image_url'] = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800';
        }

        // Procesamiento de PDF
        if ($request->hasFile('pdf_document')) {
            $pdfPath = $request->file('pdf_document')->store('courses/pdfs', 'public');
            $validated['pdf_document'] = '/storage/' . $pdfPath; 
        }

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Curso publicado exitosamente con sus horarios y archivos adjuntos.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('success', 'Curso eliminado correctamente.');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('public.course-details', compact('course'));
    }

    public function oferta(Request $request)
    {
        $categories = $this->getCategoriasFijas();
        $homeContent = HomeContent::firstOrCreate(['id' => 1]);
        $query = Course::query();

        if ($request->has('category') && $request->category != null) {
            $query->where('category', $request->category);
        }

        $courses = $query->get();

        return view('public.oferta', compact('categories', 'homeContent', 'courses'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = $this->getCategoriasFijas();
        
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
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
            
            // --- NUEVO: Validación de los horarios dinámicos ---
            'schedules' => 'nullable|array',
            'schedules.*' => 'nullable|string'
        ]);

        if ($request->has('specific_objectives')) {
            $validated['specific_objectives'] = array_filter(explode("\n", str_replace("\r", "", $request->specific_objectives)));
        }
        
        if ($request->has('topics')) {
            $validated['topics'] = array_filter(explode("\n", str_replace("\r", "", $request->topics)));
        }

        // --- NUEVO: Limpieza y guardado de los Horarios en formato JSON ---
        if ($request->has('schedules')) {
            $horariosLimpios = array_filter($request->schedules, function($value) {
                return !is_null($value) && trim($value) !== '';
            });
            $validated['schedules'] = !empty($horariosLimpios) ? array_values($horariosLimpios) : null;
        } else {
            $validated['schedules'] = null; // Si borró todos los horarios, guardamos nulo
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses/images', 'public');
            $validated['image_url'] = '/storage/' . $imagePath;
        }

        if ($request->hasFile('pdf_document')) {
            $pdfPath = $request->file('pdf_document')->store('courses/pdfs', 'public');
            $validated['pdf_document'] = '/storage/' . $pdfPath; 
        }

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Curso actualizado exitosamente.');
    }
}
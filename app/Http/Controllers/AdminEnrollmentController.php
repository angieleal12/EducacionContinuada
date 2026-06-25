<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EnrollmentsExport;
use Illuminate\Support\Str;

class AdminEnrollmentController extends Controller
{
    public function index(Request $request)
    {
        
        $categories = Course::whereHas('enrollments')->distinct()->pluck('category');

        
        $selectedCategory = $request->query('category', $categories->first());

        // me permite traer las solicitudes que pertenecen exclusivamente a esa categoría
        $enrollments = Enrollment::whereHas('course', function($query) use ($selectedCategory) {
            $query->where('category', $selectedCategory);
        })
        ->with('course') //  me permite jalar los datos del curso para evitar consultas extra
        ->latest()
        ->paginate(20);

        return view('admin.enrollments.index', compact('categories', 'selectedCategory', 'enrollments'));
    }

    public function show($id)
    {
        // me busca la inscripción con todos sus datos y los del curso
        $enrollment = Enrollment::with('course')->findOrFail($id);
        
        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function export(Request $request)
    {
        // se identifica que  categoria y que estado quiere exportar
        $category = $request->query('category, todas');
        $status = $request->query('status', 'Todos'); 

     

        // para el nombre del excel
        $statusSlug = Str::slug($status);
        $categorySlug = Str::slug($category);
        $fileName = "inscripciones-{$statusSlug}-{$categorySlug}.xlsx"; 

        // se solicita la descarga pasandole la categoría y el estado al Excel
        return Excel::download(new EnrollmentsExport($category, $status), $fileName);
    }
    
   public function updateStatus(Request $request, $id, $status)
    {
        // se valida que el estado entrante sea correcto por seguridad 
        if (!in_array($status, ['Aprobado', 'Rechazado', 'Pendiente'])) {
            return back()->with('error', 'Estado no válido.');
        }

        $enrollment = Enrollment::findOrFail($id);
        $enrollment->status = $status;
        $enrollment->save();

        // Personalizamos el mensaje según la acción realizada
        if ($status === 'Aprobado') {
            $mensaje = 'La inscripción ha sido Aprobada exitosamente.';
        } elseif ($status === 'Rechazado') {
            $mensaje = 'La inscripción ha sido Rechazada. Se programará para su eliminación automática.';
        } else {
            $mensaje = 'El estado se ha revertido a Pendiente para una nueva evaluación.';
        }

        return back()->with('success', $mensaje);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    // ==========================================
    // RUTAS PÚBLICAS (ESTUDIANTE)
    // ==========================================

    public function searchForm()
    {
        return view('public.certificates.search');
    }

    public function find(Request $request)
    {
        $request->validate([
            'doc_type' => 'required',
            'doc_number' => 'required',
            'email' => 'required|email' // Validación del correo
        ]);

        $certificates = Certificate::where('doc_type', $request->doc_type)
                                   ->where('doc_number', $request->doc_number)
                                   ->where('email', $request->email) // Candado de seguridad
                                   ->with('course')
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        return view('public.certificates.search', compact('certificates'));
    }

    public function download($verification_code)
    {
        $certificate = Certificate::where('verification_code', $verification_code)->firstOrFail();

        if (!Storage::disk('local')->exists($certificate->file_path)) {
            abort(404, 'El archivo del certificado no se encuentra disponible.');
        }

        return Storage::disk('local')->download($certificate->file_path, 'Certificado_UT_' . $certificate->verification_code . '.pdf');
    }

    // ==========================================
    // RUTAS ADMINISTRATIVAS (PANEL UT)
    // ==========================================

    public function index()
    {
        $certificates = Certificate::with('course')->latest()->paginate(15);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }
    public function getStudentData($doc_number)
    {
        // Buscamos inscripciones APROBADAS con ese documento
        $enrollments = \App\Models\Enrollment::where('doc_number', $doc_number)
                                            ->where('status', 'Aprobado')
                                            ->with('course')
                                            ->get();

        if ($enrollments->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No se encontraron inscripciones aprobadas para este documento.']);
        }

        // Tomamos los datos personales de la primera inscripción que encontremos
        $student = $enrollments->first();
        
        // Extraemos solo los cursos donde está aprobado
        $courses = $enrollments->map(function($enrollment) {
            return [
                'id' => $enrollment->course->id,
                'title' => $enrollment->course->title
            ];
        });

        return response()->json([
            'success' => true,
            'doc_type' => $student->doc_type,
            'student_name' => $student->full_name,
            'email' => $student->personal_email,
            'courses' => $courses
        ]);
    }

    public function getCourses($category_id)
    {
        $courses = Course::where('category_id', $category_id)->get();
        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'doc_type' => 'required|string',
            'doc_number' => 'required|string',
            'student_name' => 'required|string',
            'email' => 'required|email',
            'pdf_file' => 'required|mimes:pdf|max:5120',
        ]);

        $path = $request->file('pdf_file')->store('certificates', 'local');

        Certificate::create([
            'course_id' => $request->course_id,
            'doc_type' => $request->doc_type,
            'doc_number' => $request->doc_number,
            'student_name' => strtoupper($request->student_name),
            'email' => strtolower($request->email), // Guardamos el correo
            'file_path' => $path,
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificado subido y vinculado correctamente al estudiante.');
    }

    // NUEVA FUNCIÓN: Para ver el PDF en pantalla sin descargarlo
    public function showPdf($id)
    {
        $certificate = Certificate::findOrFail($id);
        
        if (!Storage::disk('local')->exists($certificate->file_path)) {
            abort(404, 'Archivo no encontrado.');
        }

        // La función response() por defecto envía el archivo para visualizarlo "inline"
        return Storage::disk('local')->response($certificate->file_path);
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        
        if (Storage::disk('local')->exists($certificate->file_path)) {
            Storage::disk('local')->delete($certificate->file_path);
        }
        
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificado y archivo eliminados correctamente.');
    }
}
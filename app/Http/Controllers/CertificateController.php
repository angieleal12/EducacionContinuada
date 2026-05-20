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
            'doc_number' => 'required'
        ]);

        $certificates = Certificate::where('doc_type', $request->doc_type)
                                   ->where('doc_number', $request->doc_number)
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
        $categories = Category::all();
        return view('admin.certificates.create', compact('categories'));
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
            'student_name' => 'required|string|max:255',
            'pdf_file' => 'required|mimes:pdf|max:5120',
        ]);

        $path = $request->file('pdf_file')->store('certificates', 'local');

        Certificate::create([
            'course_id' => $request->course_id,
            'doc_type' => $request->doc_type,
            'doc_number' => $request->doc_number,
            'student_name' => strtoupper($request->student_name),
            'file_path' => $path,
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificado subido y protegido correctamente.');
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
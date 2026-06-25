<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewEnrollmentMail;
use App\Models\Course;
use App\Models\Enrollment; // Importante para poder guardar en la BD
use Illuminate\Support\Facades\Mail;

class EnrollmentController extends Controller
{
    public function create($id)
    {
        $course = Course::findOrFail($id);
        return view('public.enroll', compact('course'));
    }

    public function store(Request $request)
    {
        $course = Course::findOrFail($request->course_id);

        // 1. Validaciones base (Paso 1)
        $rules = [
            'course_id' => 'required|exists:courses,id',
            'full_name' => 'required|string|max:255',
            'doc_type' => 'required|string',
            'doc_number' => 'required|string',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'age' => 'required|integer',
            'expedition_place' => 'required|string',
            'expedition_date' => 'required|date',
            'gender' => 'required|string',
            'blood_type' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'personal_email' => 'required|email',
            'phone_number' => 'required|string',
            'extra_details' => 'nullable|array',
        ];

        // 2. Validaciones Condicionales (Paso 3 y Archivos)
        if ($course->category === 'DIPLOMADOS DE OPCION DE GRADO') {
            $rules['approval_document'] = 'required|mimes:pdf|max:5120'; // Aval obligatorio
            $rules['id_document'] = 'required|mimes:pdf|max:5120'; // Cédula obligatoria
        } elseif ($course->category === 'SEMINARIOS DE INGLES') {
            // Escenario B: No exige archivo adjunto, ni horario.
        } else {
            // Escenario C: Demás cursos exigen Cédula y Horario
            $rules['id_document'] = 'required|mimes:pdf|max:5120';
            $rules['schedule'] = 'required|string';
        }

        // 3. Validación estricta del correo institucional (Solo UT)
        if (isset($request->extra_details['is_ut_student']) && $request->extra_details['is_ut_student'] === 'yes') {
            $rules['institutional_email'] = ['required', 'email', 'regex:/^[a-zA-Z0-9._%+\-]+@ut\.edu\.co$/'];
        } else {
            $rules['institutional_email'] = 'nullable|email';
        }

        $validated = $request->validate($rules);

        try {
            // 4. Procesamiento de Archivos PDF (Guardado en storage)
            $idPath = 'N/A'; // Por defecto si es Seminario de Inglés y no sube nada
            if ($request->hasFile('id_document')) {
                $idPath = '/storage/' . $request->file('id_document')->store('enrollments/identities', 'public');
            }

            $approvalPath = null;
            if ($request->hasFile('approval_document')) {
                $approvalPath = '/storage/' . $request->file('approval_document')->store('enrollments/approvals', 'public');
            }

            // 5. Guardado oficial en la Base de Datos
            $enrollment = Enrollment::create([
                'course_id' => $validated['course_id'],
                'full_name' => $validated['full_name'],
                'doc_type' => $validated['doc_type'],
                'doc_number' => $validated['doc_number'],
                'birth_place' => $validated['birth_place'],
                'birth_date' => $validated['birth_date'],
                'age' => $validated['age'],
                'expedition_place' => $validated['expedition_place'],
                'expedition_date' => $validated['expedition_date'],
                'gender' => $validated['gender'],
                'blood_type' => $validated['blood_type'],
                'city' => $validated['city'],
                'address' => $validated['address'],
                'personal_email' => $validated['personal_email'],
                'institutional_email' => $validated['institutional_email'] ?? null,
                'phone_number' => $validated['phone_number'],
                'schedule' => $validated['schedule'] ?? null,
                'id_document_path' => $idPath,
                'approval_document_path' => $approvalPath,
                'extra_details' => $validated['extra_details'] ?? null,
                'status' => 'Pendiente'
            ]);

            // 6. Envío del correo electrónico
            Mail::to('allealt@ut.edu.co')->send(new NewEnrollmentMail($enrollment->toArray()));

            return redirect()->route('public.oferta')->with('success', '¡El formulario se ha enviado correctamente!');

        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un problema: ' . $e->getMessage())->withInput();
        }
    }
}
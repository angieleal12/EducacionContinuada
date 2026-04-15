<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewEnrollmentMail;
use App\Models\Course; // Asegúrate de tener el modelo Course
use Illuminate\Support\Facades\Mail;

class EnrollmentController extends Controller
{
    // Esta es la función que te falta y por eso sale el error
    public function create($id)
    {
        $course = Course::findOrFail($id);
        return view('public.enroll', compact('course'));
    }

    public function store(Request $request)
{
    $data = $request->all();

    try {
        // Enviar el correo (asegúrate de que sea tu correo para las pruebas)
        Mail::to('allealt@ut.edu.co')->send(new NewEnrollmentMail($data));

        // CAMBIO AQUÍ: Redirecciona al inicio (public.oferta) con el mensaje
        return redirect()->route('public.oferta')->with('success', '¡Tu formulario se ha enviado correctamente! Pronto nos pondremos en contacto contigo.');

    } catch (\Exception $e) {
        return back()->with('error', 'Hubo un problema: ' . $e->getMessage());
    }
}
}
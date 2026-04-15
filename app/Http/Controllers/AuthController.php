<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter; // <-- Importante para seguridad
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // 1. Mostrar el formulario
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Procesar el Login con Seguridad Máxima
    public function login(Request $request)
    {
        // Validar que los campos no vengan vacíos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // A. SEGURIDAD ANTI-HACKEO (Rate Limiting)
        // Usamos la IP y el email como llave única
        $key = 'login|'.$request->ip().'|'.$request->input('email');

        // Si falló 5 veces, lo bloqueamos por 60 segundos
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => "Demasiados intentos. Inténtalo de nuevo en $seconds segundos.",
            ]);
        }

        // B. INTENTO DE ACCESO
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // ¡Éxito! Limpiamos el contador de intentos fallidos
            RateLimiter::clear($key);

            // C. SEGURIDAD DE SESIÓN (Session Fixation Protection)
            // Regeneramos el ID de sesión para evitar robo de cookies
            $request->session()->regenerate();

            // Redirigir al panel de control
            return redirect()->intended(route('courses.index'));
        }

        // D. SI FALLA LA CONTRASEÑA
        // Contamos el fallo en el sistema de seguridad
        RateLimiter::hit($key);

        // Devolvemos un error genérico (Por seguridad no decimos si el email existe o no)
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // 3. Salir (Logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('public.oferta');
    }
}
<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeContentController;

// --- RUTA PÚBLICA ---
// Aquí es donde los estudiantes verán los cursos
Route::get('/', [CourseController::class, 'oferta'])->name('public.oferta');
Route::get('/oferta', [CourseController::class, 'index'])->name('public.oferta');
// Modifica la ruta raíz para que muestre la oferta

// --- RUTAS ADMINISTRATIVAS ---
// Es buena idea agruparlas o mantenerlas organizadas
Route::get('/admin/courses', [CourseController::class, 'index'])->name('courses.index');
Route::post('/admin/courses', [CourseController::class, 'store'])->name('courses.store');
Route::delete('/admin/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
// Rutas para editar y actualizar un curso
Route::get('/admin/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/admin/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
// Ruta para ver el formulario de un curso específico
Route::get('/inscribirse/{course_id}', [EnrollmentController::class, 'create'])->name('enrollments.create');

// Ruta para procesar la inscripción
Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
// Ruta para ver la ficha técnica (detalles)
Route::get('/curso/{id}', [CourseController::class, 'show'])->name('courses.show');
// Ruta pública para ver la oferta (y filtrar)
Route::get('/oferta', [CourseController::class, 'oferta'])->name('public.oferta');


// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Ruta para mostrar el formulario (GET)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');

// Ruta para procesar el ingreso (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');



// Ruta para VER el formulario (la que está fallando ahora)
Route::get('/inscribirse/{id}', [EnrollmentController::class, 'create'])->name('enrollments.create');

// Ruta para ENVIAR el formulario
Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
// Rutas para editar los textos de la página principal
Route::get('/admin/configuracion-inicio', [HomeContentController::class, 'edit'])->name('home.content.edit');
Route::put('/admin/configuracion-inicio', [HomeContentController::class, 'update'])->name('home.content.update');
@extends('layouts.admin')

@section('content')
<!-- Encabezado Cinemático -->
<div class="mb-10 relative z-10 animate-[fadeIn_0.6s_ease-in-out]">
    <h2
        class="text-3xl lg:text-4xl font-bold text-white tracking-wide font-space drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">
        Panel de Control General</h2>
    <p class="text-gray-400 mt-2 font-light text-sm lg:text-base">Gestión integral de la plataforma de Educación
        Continuada.</p>
</div>

<!-- Alerta de Éxito modo Dark Tech -->
@if(session('success'))
<div
    class="bg-emerald-900/20 border-l-4 border-emerald-500 text-emerald-300 p-4 rounded-lg shadow-[0_0_15px_rgba(16,185,129,0.1)] mb-8 backdrop-blur-md relative z-10 animate-[fadeIn_0.4s_ease-in-out]">
    <p class="font-space font-bold tracking-wide">¡Éxito!</p>
    <p class="text-sm mt-1">{{ session('success') }}</p>
</div>
@endif

<!-- Grilla de Tarjetas Holográficas -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">

    <!-- Tarjeta: Oferta Académica (Acento Rojo/Vinotinto) -->
    <a href="{{ route('courses.index') }}"
        class="relative bg-white/5 backdrop-blur-xl p-6 rounded-2xl border border-white/10 hover:border-red-500/50 transition-all duration-500 group flex flex-col items-center text-center overflow-hidden hover:-translate-y-2 hover:shadow-[0_10px_30px_-10px_rgba(220,38,38,0.4)] animate-[fadeIn_0.7s_ease-in-out]">

        <!-- Resplandor interno on hover -->
        <div
            class="absolute inset-0 bg-gradient-to-b from-red-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
        </div>

        <div
            class="w-16 h-16 bg-red-900/30 text-red-400 rounded-2xl flex items-center justify-center text-3xl mb-5 group-hover:scale-110 group-hover:shadow-[0_0_20px_rgba(220,38,38,0.4)] transition-all duration-500 border border-red-500/20 group-hover:border-red-500/50 relative z-10">
            📚
        </div>
        <h3
            class="font-bold text-white font-space text-lg group-hover:text-red-300 transition-colors relative z-10 tracking-wide">
            Oferta Académica</h3>
        <p class="text-xs text-gray-400 mt-2 relative z-10">Crear y gestionar diplomados y cursos.</p>

        <div class="mt-auto pt-6 w-full relative z-10">
            <div
                class="bg-black/20 border border-white/10 px-3 py-2 rounded-lg text-xs font-medium text-gray-300 w-full group-hover:bg-red-900/30 group-hover:border-red-500/30 group-hover:text-red-200 transition-all duration-300 font-space tracking-wider">
                {{ $totalCourses }} Publicados
            </div>
        </div>
    </a>

    <!-- Tarjeta: Inscripciones (Acento Azul Tech) -->
    <a href="{{ route('admin.enrollments.index') }}"
        class="relative bg-white/5 backdrop-blur-xl p-6 rounded-2xl border border-white/10 hover:border-blue-500/50 transition-all duration-500 group flex flex-col items-center text-center overflow-hidden hover:-translate-y-2 hover:shadow-[0_10px_30px_-10px_rgba(59,130,246,0.4)] animate-[fadeIn_0.8s_ease-in-out]">

        <div
            class="absolute inset-0 bg-gradient-to-b from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
        </div>

        <div
            class="w-16 h-16 bg-blue-900/30 text-blue-400 rounded-2xl flex items-center justify-center text-3xl mb-5 group-hover:scale-110 group-hover:shadow-[0_0_20px_rgba(59,130,246,0.4)] transition-all duration-500 border border-blue-500/20 group-hover:border-blue-500/50 relative z-10">
            📋
        </div>
        <h3
            class="font-bold text-white font-space text-lg group-hover:text-blue-300 transition-colors relative z-10 tracking-wide">
            Inscripciones</h3>
        <p class="text-xs text-gray-400 mt-2 relative z-10 mb-6">Revisar Inscripciones.</p>
    </a>

    <!-- Tarjeta: Publicidad (Acento Púrpura) -->
    <a href="{{ route('home.content.edit') }}"
        class="relative bg-white/5 backdrop-blur-xl p-6 rounded-2xl border border-white/10 hover:border-purple-500/50 transition-all duration-500 group flex flex-col items-center text-center overflow-hidden hover:-translate-y-2 hover:shadow-[0_10px_30px_-10px_rgba(168,85,247,0.4)] animate-[fadeIn_0.9s_ease-in-out]">

        <div
            class="absolute inset-0 bg-gradient-to-b from-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
        </div>

        <div
            class="w-16 h-16 bg-purple-900/30 text-purple-400 rounded-2xl flex items-center justify-center text-3xl mb-5 group-hover:scale-110 group-hover:shadow-[0_0_20px_rgba(168,85,247,0.4)] transition-all duration-500 border border-purple-500/20 group-hover:border-purple-500/50 relative z-10">
            📢
        </div>
        <h3
            class="font-bold text-white font-space text-lg group-hover:text-purple-300 transition-colors relative z-10 tracking-wide">
            Publicidad y Textos</h3>
        <p class="text-xs text-gray-400 mt-2 relative z-10 mb-6">Editar inicio y subir Pop-ups promocionales.</p>
    </a>

    <!-- Tarjeta: Certificados (Acento Esmeralda/Cyber) -->
    <a href="{{ route('admin.certificates.index') }}"
        class="relative bg-white/5 backdrop-blur-xl p-6 rounded-2xl border border-white/10 hover:border-emerald-500/50 transition-all duration-500 group flex flex-col items-center text-center overflow-hidden hover:-translate-y-2 hover:shadow-[0_10px_30px_-10px_rgba(16,185,129,0.4)] animate-[fadeIn_1s_ease-in-out]">

        <div
            class="absolute inset-0 bg-gradient-to-b from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
        </div>

        <div
            class="w-16 h-16 bg-emerald-900/30 text-emerald-400 rounded-2xl flex items-center justify-center text-3xl mb-5 group-hover:scale-110 group-hover:shadow-[0_0_20px_rgba(16,185,129,0.4)] transition-all duration-500 border border-emerald-500/20 group-hover:border-emerald-500/50 relative z-10">
            🎓
        </div>
        <h3
            class="font-bold text-white font-space text-lg group-hover:text-emerald-300 transition-colors relative z-10 tracking-wide">
            Certificados</h3>
        <p class="text-xs text-gray-400 mt-2 relative z-10 mb-6">Cargar diplomas PDF.</p>
    </a>

</div>
@endsection
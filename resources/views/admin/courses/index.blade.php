@extends('layouts.admin')

@section('content')
<!-- Encabezado de la Sección -->
<div
    class="mb-10 flex flex-col md:flex-row md:justify-between md:items-end gap-4 relative z-10 animate-[fadeIn_0.5s_ease-in-out]">
    <div>
        <h2 class="text-3xl font-bold text-white tracking-wide font-space drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">
            Gestión de Oferta Académica</h2>
        <p class="text-gray-400 mt-2 font-light">Administra los diplomados, seminarios y cursos publicados.</p>
    </div>
    <a href="{{ route('courses.create') }}"
        class="bg-gradient-to-r from-red-700 to-red-500 text-white px-6 py-3 rounded-xl text-sm font-space font-bold hover:from-red-600 hover:to-red-400 transition-all duration-300 shadow-[0_0_15px_rgba(220,38,38,0.4)] hover:shadow-[0_0_25px_rgba(220,38,38,0.7)] flex items-center gap-2 group border border-red-500/50">
        <span class="text-lg group-hover:rotate-90 transition-transform duration-300">＋</span> Nuevo Curso
    </a>
</div>

<!-- Alerta de Éxito modo Dark Tech -->
@if(session('success'))
<div
    class="bg-emerald-900/20 border-l-4 border-emerald-500 text-emerald-300 p-4 rounded-lg shadow-[0_0_15px_rgba(16,185,129,0.1)] mb-8 backdrop-blur-md relative z-10 animate-[fadeIn_0.6s_ease-in-out]">
    <p class="font-space font-bold tracking-wide">¡Éxito!</p>
    <p class="text-sm mt-1">{{ session('success') }}</p>
</div>
@endif

<!-- Contenedor Principal Glassmorphism -->
<div
    class="bg-white/5 backdrop-blur-xl p-8 rounded-2xl border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.4)] relative z-10 animate-[fadeIn_0.7s_ease-in-out]">

    <div class="flex justify-between items-center mb-8 border-b border-white/10 pb-5">
        <h3 class="text-xl font-bold text-white font-space tracking-wide">Cursos Publicados</h3>
        <span
            class="bg-black/30 text-red-300 text-xs font-space font-bold px-4 py-1.5 rounded-full border border-red-500/20 shadow-[inset_0_0_10px_rgba(220,38,38,0.1)]">
            Total: {{ $courses->count() }}
        </span>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        @forelse($courses as $course)
        <!-- Tarjeta de Curso Individual -->
        <div
            class="flex flex-col sm:flex-row justify-between sm:items-center p-5 rounded-xl border border-white/5 bg-black/20 hover:bg-white/5 hover:border-red-500/40 hover:shadow-[0_5px_20px_-5px_rgba(220,38,38,0.3)] transition-all duration-300 group">

            <div class="flex items-center gap-5 mb-4 sm:mb-0">
                <!-- Imagen o Placeholder -->
                @if($course->image_url && $course->image_url !==
                'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800')
                <div
                    class="relative w-16 h-16 rounded-lg overflow-hidden border border-white/10 group-hover:border-red-500/50 transition-colors">
                    <img src="{{ asset($course->image_url) }}" alt="Portada" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-red-500/10 opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>
                @else
                <div
                    class="w-16 h-16 rounded-lg bg-red-900/30 flex items-center justify-center text-red-400 font-space font-bold text-xl border border-red-500/20 group-hover:border-red-500/50 group-hover:shadow-[0_0_15px_rgba(220,38,38,0.3)] transition-all">
                    UT
                </div>
                @endif

                <!-- Información del Curso -->
                <div>
                    <h4
                        class="font-bold text-gray-200 text-base group-hover:text-red-300 transition-colors font-space tracking-wide">
                        {{ $course->title }}</h4>
                    <div class="flex flex-wrap gap-3 items-center mt-2">
                        <span
                            class="text-[10px] px-2.5 py-1 bg-black/40 border border-white/10 rounded-md text-gray-400 font-bold uppercase tracking-widest group-hover:border-red-500/30 transition-colors">
                            {{ $course->category }}
                        </span>
                        <span class="text-[11px] text-gray-500 font-medium flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $course->hours }} Horas
                        </span>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción Tech -->
            <div class="flex items-center gap-3 self-end sm:self-auto">
                <a href="{{ route('courses.edit', $course->id) }}"
                    class="flex items-center gap-1.5 text-blue-400 bg-blue-500/10 border border-blue-500/20 hover:bg-blue-500/20 hover:border-blue-400/50 hover:text-blue-300 px-4 py-2 rounded-lg text-xs font-space font-bold transition-all duration-300 hover:shadow-[0_0_15px_rgba(59,130,246,0.3)]">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Editar
                </a>

                <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar definitivamente este curso? Esta acción no se puede deshacer.')">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="flex items-center gap-1.5 text-red-400 bg-red-500/10 border border-red-500/20 hover:bg-red-500/20 hover:border-red-400/50 hover:text-red-300 px-4 py-2 rounded-lg text-xs font-space font-bold transition-all duration-300 hover:shadow-[0_0_15px_rgba(239,68,68,0.3)]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
        @empty
        <!-- Estado Vacío (Empty State) -->
        <div
            class="col-span-1 xl:col-span-2 text-center py-16 bg-black/20 rounded-2xl border-2 border-dashed border-white/10 hover:border-white/20 transition-colors">
            <div class="text-5xl mb-4 opacity-50 drop-shadow-[0_0_15px_rgba(255,255,255,0.2)]">📚</div>
            <p class="text-gray-400 font-medium mb-6 font-space tracking-wide text-lg">Aún no hay cursos registrados en
                el sistema.</p>
            <a href="{{ route('courses.create') }}"
                class="inline-flex items-center gap-2 text-red-300 bg-red-500/10 border border-red-500/30 px-6 py-3 rounded-xl font-space font-bold hover:bg-red-500/20 hover:border-red-500/60 hover:shadow-[0_0_20px_rgba(220,38,38,0.4)] transition-all duration-300">
                <span>＋</span> Crear el primer curso
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
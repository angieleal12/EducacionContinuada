@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto relative z-10 animate-[fadeIn_0.5s_ease-in-out]">

    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('courses.index') }}"
            class="group flex items-center gap-2 text-gray-300 hover:text-white font-space font-bold text-sm transition-all duration-300">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Volver al Panel
        </a>
    </div>

    <div class="bg-[#18151a]/95 backdrop-blur-xl p-8 md:p-10 rounded-2xl shadow-xl border border-white/10 relative">

        <h2
            class="text-3xl font-bold mb-8 text-white border-b border-white/10 pb-5 flex items-center gap-3 font-space tracking-wide">
            <span class="text-red-500">＋</span> Publicar Nuevo Programa Académico
        </h2>

        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-red-400 transition-colors">Título
                        del Curso *</label>
                    <input type="text" name="title" required placeholder="Nombre oficial del programa..."
                        class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white placeholder-gray-500 focus:border-red-500 focus:bg-white/10 outline-none transition-all">
                </div>
                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-red-400 transition-colors">Línea
                        de Formación *</label>
                    <select name="category" required
                        class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white focus:border-red-500 focus:bg-white/10 outline-none transition-all cursor-pointer">
                        <option value="" class="bg-gray-900 text-gray-400">Seleccione una categoría...</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" class="bg-gray-900 text-white">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-red-400 transition-colors">Modalidad
                        *</label>
                    <select name="mode" required
                        class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white focus:border-red-500 focus:bg-white/10 outline-none transition-all cursor-pointer">
                        <option value="Virtual" selected class="bg-gray-900 text-white">Virtual</option>
                        <option value="Presencial" class="bg-gray-900 text-white">Presencial</option>
                        <option value="Híbrido" class="bg-gray-900 text-white">Híbrido</option>
                        <option value="A Distancia" class="bg-gray-900 text-white">A Distancia</option>
                    </select>
                </div>
                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-red-400 transition-colors">Horas
                        *</label>
                    <input type="number" name="hours" required placeholder="Ej: 120"
                        class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white placeholder-gray-500 focus:border-red-500 focus:bg-white/10 outline-none transition-all">
                </div>
                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-red-400 transition-colors">Duración</label>
                    <input type="text" name="duration" placeholder="Ej: 2 meses"
                        class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white placeholder-gray-500 focus:border-red-500 focus:bg-white/10 outline-none transition-all">
                </div>
                <div class="group">
                    <label
                        class="block text-xs font-bold text-red-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-red-400 transition-colors">Inversión
                        / Costo</label>
                    <input type="text" name="cost" placeholder="Ej: $1.200.000"
                        class="w-full bg-red-900/20 border border-red-500/50 p-3.5 rounded-xl text-base text-white placeholder-red-300/50 focus:border-red-400 focus:bg-red-900/30 outline-none transition-all">
                </div>
            </div>

            <div class="pt-6 border-t border-white/10 space-y-4">
                <h3 class="text-base font-bold text-white uppercase tracking-wider font-space flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Horarios de Clase Disponibles
                </h3>
                <p class="text-sm text-gray-400">Agregue los horarios que el estudiante podrá elegir. Si es Seminario de
                    Inglés, déjelo vacío.</p>

                <div id="schedules-container" class="space-y-3">
                    <div class="flex items-center gap-3">
                        <input type="text" name="schedules[]" placeholder="Ej: Martes y Jueves 18:30 a 21:30"
                            class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white placeholder-gray-500 focus:border-red-500 focus:bg-white/10 outline-none transition-all">
                    </div>
                </div>

                <button type="button" id="add-schedule-btn"
                    class="mt-3 inline-flex items-center gap-2 text-sm bg-white/10 text-white border border-white/20 px-5 py-2.5 rounded-lg font-space font-bold hover:bg-white/20 transition-all">
                    <span>＋</span> Agregar otro horario
                </button>
            </div>

            <div class="pt-6 border-t border-white/10 space-y-4">
                <h3 class="text-base font-bold text-white uppercase tracking-wider font-space flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Soportes y Archivos
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="border border-dashed border-white/30 p-5 rounded-xl bg-white/5 hover:border-white/50 transition-colors group">
                        <label
                            class="block text-xs font-bold text-gray-300 uppercase tracking-wider font-space mb-3 group-hover:text-white transition-colors">Imagen
                            de Portada</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full text-sm text-gray-300 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-space file:font-bold file:bg-white/10 file:text-white hover:file:bg-white/20 file:transition-all cursor-pointer">
                    </div>

                    <div
                        class="border border-dashed border-white/30 p-5 rounded-xl bg-white/5 hover:border-white/50 transition-colors group">
                        <label
                            class="block text-xs font-bold text-gray-300 uppercase tracking-wider font-space mb-3 group-hover:text-white transition-colors">Normativa
                            o Presentación (PDF)</label>
                        <input type="file" name="pdf_document" accept=".pdf"
                            class="w-full text-sm text-gray-300 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-space file:font-bold file:bg-white/10 file:text-white hover:file:bg-white/20 file:transition-all cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-white/10 space-y-6">
                <h3 class="text-base font-bold text-white uppercase tracking-wider font-space flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Ficha Técnica y Contenidos
                </h3>

                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-red-400 transition-colors">Justificación
                        *</label>
                    <textarea name="justification" rows="3" required
                        class="w-full bg-white/5 border border-white/20 p-4 rounded-xl text-base text-white placeholder-gray-500 focus:border-red-500 focus:bg-white/10 outline-none transition-all leading-relaxed"
                        placeholder="Redacte la importancia y propósito de este programa..."></textarea>
                </div>

                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-red-400 transition-colors">Objetivo
                        General</label>
                    <textarea name="general_objective" rows="2"
                        class="w-full bg-white/5 border border-white/20 p-4 rounded-xl text-base text-white placeholder-gray-500 focus:border-red-500 focus:bg-white/10 outline-none transition-all leading-relaxed"
                        placeholder="Meta principal de aprendizaje..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-yellow-500 mb-1 uppercase tracking-wider font-space group-focus-within:text-yellow-400 transition-colors">Objetivos
                            Específicos</label>
                        <p class="text-xs text-gray-400 mb-2">Presione 'Enter' para separar cada objetivo.</p>
                        <textarea name="specific_objectives" rows="5"
                            class="w-full bg-yellow-900/10 border border-yellow-500/50 p-4 rounded-xl text-base text-white placeholder-gray-500 focus:border-yellow-400 focus:bg-yellow-900/20 outline-none transition-all leading-relaxed"
                            placeholder="Desarrollar competencias...&#10;Analizar casos de estudio..."></textarea>
                    </div>

                    <div class="group">
                        <label
                            class="block text-xs font-bold text-blue-400 mb-1 uppercase tracking-wider font-space group-focus-within:text-blue-300 transition-colors">Temario
                            / Módulos</label>
                        <p class="text-xs text-gray-400 mb-2">Presione 'Enter' para separar cada módulo.</p>
                        <textarea name="topics" rows="5"
                            class="w-full bg-blue-900/10 border border-blue-500/50 p-4 rounded-xl text-base text-white placeholder-gray-500 focus:border-blue-400 focus:bg-blue-900/20 outline-none transition-all leading-relaxed"
                            placeholder="Módulo I: Introducción...&#10;Módulo II: Conceptos avanzados..."></textarea>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-white/10 mt-8">
                <button type="submit"
                    class="w-full bg-[#8B0000] border border-red-500 text-white font-space font-bold py-4 rounded-xl text-lg hover:bg-red-700 transition-all duration-300 flex justify-center items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Publicar Curso en la Plataforma
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
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
            Volver a la Oferta Académica
        </a>
    </div>

    <div class="bg-[#18151a]/95 backdrop-blur-xl p-8 md:p-10 rounded-2xl shadow-xl border border-white/10 relative">

        <div class="flex flex-col md:flex-row md:items-center gap-5 mb-8 border-b border-white/10 pb-6">
            <div
                class="w-14 h-14 bg-blue-900/30 rounded-xl flex items-center justify-center text-blue-400 border border-blue-500/30 shadow-[0_0_15px_rgba(59,130,246,0.3)]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-white font-space tracking-wide">
                    Editar Curso: <span
                        class="text-blue-400 drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]">{{ $course->title }}</span>
                </h2>
                <p class="text-gray-400 text-sm mt-1">Actualiza la información y configuración de este programa.</p>
            </div>
        </div>

        @if ($errors->any())
        <div class="bg-red-900/20 border-l-4 border-red-500 p-5 mb-8 rounded-xl shadow-lg backdrop-blur-md">
            <h3 class="text-sm font-space font-bold text-red-400 mb-2 tracking-wide flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
                Por favor corrige los siguientes errores:
            </h3>
            <ul class="text-sm text-red-300 list-disc list-inside space-y-1 ml-7">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf
            @method('PUT')

            <div class="group">
                <label
                    class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-blue-400 transition-colors">Título
                    del Curso *</label>
                <input type="text" name="title" value="{{ $course->title }}" required
                    class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white placeholder-gray-500 focus:border-blue-500 focus:bg-white/10 outline-none transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-blue-400 transition-colors">Línea
                        de Formación *</label>
                    <select name="category" required
                        class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white focus:border-blue-500 focus:bg-white/10 outline-none transition-all cursor-pointer">
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" class="bg-gray-900 text-white"
                            {{ $course->category == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-blue-400 transition-colors">Modalidad
                        *</label>
                    <select name="mode" required
                        class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white focus:border-blue-500 focus:bg-white/10 outline-none transition-all cursor-pointer">
                        <option value="Virtual" class="bg-gray-900 text-white"
                            {{ $course->mode == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                        <option value="Presencial" class="bg-gray-900 text-white"
                            {{ $course->mode == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="Híbrido" class="bg-gray-900 text-white"
                            {{ $course->mode == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                        <option value="A Distancia" class="bg-gray-900 text-white"
                            {{ $course->mode == 'A Distancia' ? 'selected' : '' }}>A Distancia</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-blue-400 transition-colors">Horas
                        *</label>
                    <input type="number" name="hours" value="{{ $course->hours }}" required
                        class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white focus:border-blue-500 focus:bg-white/10 outline-none transition-all">
                </div>
                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-blue-400 transition-colors">Duración</label>
                    <input type="text" name="duration" value="{{ $course->duration }}"
                        class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white focus:border-blue-500 focus:bg-white/10 outline-none transition-all">
                </div>
                <div class="group">
                    <label
                        class="block text-xs font-bold text-blue-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-blue-400 transition-colors">Inversión
                        / Costo</label>
                    <input type="text" name="cost" value="{{ $course->cost }}"
                        class="w-full bg-blue-900/20 border border-blue-500/50 p-3.5 rounded-xl text-base text-white placeholder-blue-300/50 focus:border-blue-400 focus:bg-blue-900/30 outline-none transition-all">
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
                <p class="text-sm text-gray-400 font-light">Modifica, elimina o agrega nuevos horarios para este curso.
                </p>

                <div id="schedules-container" class="space-y-3">
                    @php
                    $horariosGuardados = is_string($course->schedules) ? json_decode($course->schedules, true) :
                    $course->schedules;
                    @endphp

                    @if(!empty($horariosGuardados) && is_array($horariosGuardados))
                    @foreach($horariosGuardados as $horario)
                    <div class="flex items-center gap-3">
                        <input type="text" name="schedules[]" value="{{ $horario }}"
                            class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white focus:border-blue-500 focus:bg-white/10 outline-none transition-all">
                        <button type="button" onclick="this.parentElement.remove()"
                            class="bg-red-500/10 border border-red-500/30 text-red-400 px-5 py-3.5 rounded-xl text-base font-space font-bold hover:bg-red-500/20 transition-all">
                            X
                        </button>
                    </div>
                    @endforeach
                    @else
                    <div class="flex items-center gap-3">
                        <input type="text" name="schedules[]" placeholder="Ej: Sábados 07:00 a 10:00"
                            class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white placeholder-gray-500 focus:border-blue-500 focus:bg-white/10 outline-none transition-all">
                    </div>
                    @endif
                </div>

                <button type="button" id="add-schedule-btn"
                    class="mt-3 inline-flex items-center gap-2 text-sm bg-white/10 text-white border border-white/20 px-5 py-2.5 rounded-lg font-space font-bold hover:bg-white/20 transition-all">
                    <span>＋</span> Agregar otro horario
                </button>
            </div>

            <div class="pt-6 border-t border-white/10 space-y-6">
                <h3 class="text-base font-bold text-white uppercase tracking-wider font-space flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Contenido Académico
                </h3>

                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-blue-400 transition-colors">Justificación
                        *</label>
                    <textarea name="justification" required
                        class="w-full bg-white/5 border border-white/20 p-4 rounded-xl text-base text-white focus:border-blue-500 focus:bg-white/10 outline-none transition-all leading-relaxed h-28">{{ $course->justification }}</textarea>
                </div>

                <div class="group">
                    <label
                        class="block text-xs font-bold text-gray-300 mb-2 uppercase tracking-wider font-space group-focus-within:text-blue-400 transition-colors">Objetivo
                        General</label>
                    <textarea name="general_objective"
                        class="w-full bg-white/5 border border-white/20 p-4 rounded-xl text-base text-white focus:border-blue-500 focus:bg-white/10 outline-none transition-all leading-relaxed h-20">{{ $course->general_objective }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-yellow-500 mb-1 uppercase tracking-wider font-space group-focus-within:text-yellow-400 transition-colors">Objetivos
                            Específicos</label>
                        <p class="text-xs text-gray-400 mb-2">Presione Enter para separar los objetivos.</p>
                        @php
                        $objText = is_array($course->specific_objectives) ? implode("\n", $course->specific_objectives)
                        : $course->specific_objectives;
                        @endphp
                        <textarea name="specific_objectives"
                            class="w-full bg-yellow-900/10 border border-yellow-500/50 p-4 rounded-xl text-base text-white focus:border-yellow-400 focus:bg-yellow-900/20 outline-none transition-all leading-relaxed h-32">{{ $objText }}</textarea>
                    </div>
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-blue-400 mb-1 uppercase tracking-wider font-space group-focus-within:text-blue-300 transition-colors">Temario
                            / Módulos</label>
                        <p class="text-xs text-gray-400 mb-2">Presione Enter para separar los módulos.</p>
                        @php
                        $topicText = is_array($course->topics) ? implode("\n", $course->topics) : $course->topics;
                        @endphp
                        <textarea name="topics"
                            class="w-full bg-blue-900/10 border border-blue-500/50 p-4 rounded-xl text-base text-white focus:border-blue-400 focus:bg-blue-900/20 outline-none transition-all leading-relaxed h-32">{{ $topicText }}</textarea>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-white/10 space-y-4">
                <h3 class="text-base font-bold text-white uppercase tracking-wider font-space flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Actualizar Archivos Adjuntos
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="border border-dashed border-white/30 p-5 rounded-xl bg-white/5 hover:border-white/50 transition-colors group">
                        <label
                            class="block text-xs font-bold text-gray-300 uppercase tracking-wider font-space mb-1 group-hover:text-white transition-colors">Imagen
                            de Portada</label>
                        <p class="text-xs text-gray-400 font-light mb-3">Sube un archivo nuevo solo si deseas reemplazar
                            la imagen actual.</p>
                        <input type="file" name="image" accept="image/*"
                            class="w-full text-sm text-gray-300 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-space file:font-bold file:bg-white/10 file:text-white hover:file:bg-white/20 file:transition-all cursor-pointer">
                    </div>

                    <div
                        class="border border-dashed border-white/30 p-5 rounded-xl bg-white/5 hover:border-white/50 transition-colors group">
                        <label
                            class="block text-xs font-bold text-gray-300 uppercase tracking-wider font-space mb-1 group-hover:text-white transition-colors">Documento
                            PDF</label>
                        <p class="text-xs text-gray-400 font-light mb-3">Sube un archivo nuevo solo si deseas reemplazar
                            el PDF actual.</p>
                        <input type="file" name="pdf_document" accept=".pdf"
                            class="w-full text-sm text-gray-300 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-space file:font-bold file:bg-white/10 file:text-white hover:file:bg-white/20 file:transition-all cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse sm:flex-row justify-end gap-4 pt-8 border-t border-white/10 mt-8">
                <a href="{{ route('courses.index') }}"
                    class="px-8 py-3.5 bg-white/5 text-gray-300 font-space font-bold uppercase tracking-wider text-sm rounded-xl hover:bg-white/10 border border-white/10 transition-all text-center">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-8 py-3.5 bg-blue-600 text-white font-space font-bold uppercase tracking-wider text-sm rounded-xl hover:bg-blue-700 transition-all shadow-lg hover:shadow-blue-500/30">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
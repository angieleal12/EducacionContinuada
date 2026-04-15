@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

    <div class="lg:col-span-5">
        <div class="bg-white p-6 rounded-lg shadow-md border sticky top-24">
            <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center gap-2 border-b pb-2">
                <span class="text-red-700">＋</span> Nuevo Curso
            </h2>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4 max-h-[75vh] overflow-y-auto pr-2">
                @csrf

                <div>
                    <label class="text-xs font-bold text-gray-600 uppercase">Título del Curso</label>
                    <input type="text" name="title" required
                        class="w-full border p-2 rounded text-sm focus:border-red-500 outline-none"
                        placeholder="Nombre del curso...">
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase">Categoría</label>
                        <select name="category_id" required class="w-full border p-2 rounded text-sm">
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase">Modalidad</label>
                        <select name="mode" required class="w-full border p-2 rounded text-sm">
                            <option value="Virtual" selected>Virtual</option>
                            <option value="Presencial">Presencial</option>
                            <option value="Híbrido">Híbrido</option>
                            <option value="A Distancia">A Distancia </option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase">Horas</label>
                        <input type="number" name="hours" required class="w-full border p-2 rounded text-sm"
                            placeholder="Ej: 120">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase">Duración</label>
                        <input type="text" name="duration" class="w-full border p-2 rounded text-sm"
                            placeholder="Ej: 2 meses">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-red-700 uppercase">Valor</label>
                        <input type="text" name="cost"
                            class="w-full border p-2 rounded text-sm bg-red-50 border-red-100"
                            placeholder="Ej: $1.200.000">
                    </div>
                </div>

                <div class="pt-2 border-t space-y-3">
                    <h3 class="text-xs font-bold text-red-700 uppercase">Archivos Adjuntos</h3>

                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Imagen de Portada</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full border p-1 rounded text-sm text-gray-600 bg-gray-50 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-red-50 file:text-red-700">
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Documento Normativa (PDF)</label>
                        <input type="file" name="pdf_document" accept=".pdf"
                            class="w-full border p-1 rounded text-sm text-gray-600 bg-gray-50 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-blue-50 file:text-blue-700">
                    </div>
                </div>

                <div class="pt-2 border-t space-y-3">
                    <h3 class="text-xs font-bold text-red-700 uppercase">Ficha Técnica</h3>

                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Justificación</label>
                        <textarea name="justification" rows="3" required class="w-full border p-2 rounded text-sm"
                            placeholder="¿Por qué es importante este curso?"></textarea>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Objetivo General</label>
                        <textarea name="general_objective" rows="2" class="w-full border p-2 rounded text-sm"
                            placeholder="Meta principal..."></textarea>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Objetivos Específicos (Uno por
                            línea)</label>
                        <textarea name="specific_objectives" rows="4"
                            class="w-full border p-2 rounded text-sm bg-yellow-50"
                            placeholder="Escribe cada objetivo y presiona Enter..."></textarea>
                    </div>

                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase">Temario / Módulos (Uno por
                            línea)</label>
                        <textarea name="topics" rows="4" class="w-full border p-2 rounded text-sm bg-blue-50"
                            placeholder="Módulo I: ...&#10;Módulo II: ..."></textarea>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white font-bold py-2 rounded hover:bg-green-700 transition flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Publicar en Universidad del Tolima
                </button>
            </form>
        </div>
    </div>

    <div class="lg:col-span-7">
        <div class="bg-white p-6 rounded-lg shadow-md border">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Cursos Publicados</h2>
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">Total:
                    {{ $courses->count() }}</span>
            </div>

            <div class="space-y-3">
                @forelse($courses as $course)
                <div
                    class="flex justify-between items-center p-4 border rounded-lg hover:bg-gray-50 transition shadow-sm">
                    <div class="flex items-center gap-4">

                        @if($course->image_url && $course->image_url !==
                        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800')
                        <img src="{{ asset($course->image_url) }}" alt="Portada"
                            class="w-12 h-12 rounded object-cover border border-gray-200">
                        @else
                        <div
                            class="w-12 h-12 rounded bg-red-50 flex items-center justify-center text-red-700 font-bold border border-red-100">
                            UT
                        </div>
                        @endif

                        <div>
                            <h4 class="font-bold text-gray-900">{{ $course->title }}</h4>
                            <div class="flex gap-2 items-center mt-1">
                                <span
                                    class="text-[10px] px-2 py-0.5 bg-gray-100 rounded-full text-gray-600">{{ $course->category->label ?? 'Sin Categoría' }}</span>
                                <span class="text-[10px] text-gray-400">• {{ $course->hours }} Horas</span>
                                @if($course->cost)
                                <span class="text-[10px] text-green-600 font-bold">• {{ $course->cost }}</span>
                                @endif

                                @if($course->pdf_document)
                                <span class="text-[10px] text-blue-600 font-bold flex items-center gap-1"
                                    title="Tiene normativa adjunta">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                            clip-rule="evenodd" />
                                    </svg> PDF
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('courses.edit', $course->id) }}"
                            class="text-blue-500 hover:bg-blue-50 p-2 rounded-full transition" title="Editar Curso">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>

                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar definitivamente este curso?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-full transition"
                                title="Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <p class="text-gray-400">Aún no hay cursos registrados en el sistema.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
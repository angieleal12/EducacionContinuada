@extends('layouts.admin') @section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-sm border mt-6">
    <div class="flex items-center gap-3 mb-6 border-b pb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
        <h2 class="text-2xl font-black text-gray-800 uppercase tracking-wide">Editar Curso: <span
                class="text-blue-600">{{ $course->title }}</span></h2>
    </div>
    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-600 p-4 mb-6 rounded-lg shadow-sm">
        <h3 class="text-sm font-bold text-red-800 mb-2">Por favor corrige los siguientes errores:</h3>
        <ul class="text-xs text-red-700 list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div class="mb-5">
            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Título del Curso</label>
            <input type="text" name="title" value="{{ $course->title }}" required
                class="w-full border border-gray-300 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-blue-100 outline-none transition">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Categoría</label>
                <select name="category_id" required
                    class="w-full border border-gray-300 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-blue-100 outline-none transition">
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $course->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->label ?? $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Modalidad</label>
                <select name="mode" required
                    class="w-full border border-gray-300 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-blue-100 outline-none transition">
                    <option value="Virtual" {{ $course->mode == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                    <option value="Presencial" {{ $course->mode == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                    <option value="Híbrido" {{ $course->mode == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Horas</label>
                <input type="number" name="hours" value="{{ $course->hours }}" required
                    class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Duración</label>
                <input type="text" name="duration" value="{{ $course->duration }}"
                    class="w-full border border-gray-300 p-2.5 rounded-lg text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-red-700 uppercase mb-1">Valor</label>
                <input type="text" name="cost" value="{{ $course->cost }}"
                    class="w-full border border-red-200 bg-red-50 p-2.5 rounded-lg text-sm font-bold text-gray-800">
            </div>
        </div>

        <div class="mb-5">
            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Justificación</label>
            <textarea name="justification" required
                class="w-full border border-gray-300 p-2.5 rounded-lg text-sm h-24">{{ $course->justification }}</textarea>
        </div>

        <div class="mb-8">
            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Objetivo General</label>
            <textarea name="general_objective"
                class="w-full border border-gray-300 p-2.5 rounded-lg text-sm h-20">{{ $course->general_objective }}</textarea>
        </div>

        <h3 class="text-sm font-black text-red-800 uppercase mt-8 mb-4 border-b pb-2">Actualizar Archivos Adjuntos</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Imagen de Portada</label>
                <p class="text-[10px] text-gray-500 mb-3">Sube un archivo nuevo solo si deseas reemplazar la imagen
                    actual.</p>
                <input type="file" name="image" accept="image/*"
                    class="w-full text-sm bg-white border border-gray-300 rounded p-1">
            </div>

            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Documento PDF</label>
                <p class="text-[10px] text-gray-500 mb-3">Sube un archivo nuevo solo si deseas reemplazar el PDF actual.
                </p>
                <input type="file" name="pdf_document" accept=".pdf"
                    class="w-full text-sm bg-white border border-gray-300 rounded p-1">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('courses.index') }}"
                class="px-6 py-2.5 bg-gray-100 text-gray-600 font-bold uppercase tracking-wider text-xs rounded-xl hover:bg-gray-200 transition">
                Cancelar
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 text-white font-bold uppercase tracking-wider text-xs rounded-xl hover:bg-blue-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
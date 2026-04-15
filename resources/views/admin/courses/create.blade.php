@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-12">
        <div class="bg-white p-6 rounded-lg shadow-md border">
            <h2 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Nuevo Curso</h2>

            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Título del Curso</label>
                        <input type="text" name="title" required
                            class="w-full border p-2 rounded text-sm focus:border-red-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Categoría</label>
                        <select name="category_id"
                            class="w-full border p-2 rounded text-sm focus:border-red-500 outline-none">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Duración</label>
                        <input type="text" name="duration" placeholder="Ej: 2 meses"
                            class="w-full border p-2 rounded text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-red-700 mb-1">Valor / Inversión</label>
                        <input type="text" name="cost" placeholder="Ej: Gratuito o $1.200.000"
                            class="w-full border p-2 rounded text-sm border-red-100 bg-red-50">
                    </div>
                </div>

                <div class="pt-4 border-t space-y-3">
                    <h3 class="text-xs font-bold text-gray-700 uppercase">Archivos Adjuntos</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase">Imagen de Portada
                                (Recomendado: 800x600px)</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full border p-1.5 rounded text-sm text-gray-600 bg-gray-50 file:mr-4 file:py-1 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase">Documento Normativa
                                (PDF)</label>
                            <input type="file" name="pdf_document" accept=".pdf"
                                class="w-full border p-1.5 rounded text-sm text-gray-600 bg-gray-50 file:mr-4 file:py-1 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t space-y-3">
                    <h3 class="text-xs font-bold text-red-700 uppercase">Contenido Académico</h3>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase">Justificación</label>
                        <textarea name="justification" rows="3" class="w-full border p-2 rounded text-sm"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase">Objetivo General</label>
                        <textarea name="general_objective" rows="2"
                            class="w-full border p-2 rounded text-sm"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase">Objetivos Específicos
                                (Uno por línea)</label>
                            <textarea name="specific_objectives" rows="4"
                                class="w-full border p-2 rounded text-sm bg-yellow-50"
                                placeholder="Enter para separar..."></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase">Temario (Uno por
                                línea)</label>
                            <textarea name="topics" rows="4" class="w-full border p-2 rounded text-sm bg-blue-50"
                                placeholder="Módulo 1..."></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white font-bold py-3 rounded hover:bg-green-700 transition shadow-lg mt-6">
                    Publicar Curso
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
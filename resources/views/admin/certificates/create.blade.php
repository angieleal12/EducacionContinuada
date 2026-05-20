@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-8">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-black text-gray-800">Subir Nuevo Certificado</h1>
        <a href="{{ route('admin.certificates.index') }}" class="text-gray-500 hover:text-red-700 font-bold transition">
            ← Volver al listado
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md">
        <ul class="list-disc list-inside text-sm text-red-700 font-medium">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Tipo de Doc *</label>
                    <select name="doc_type" required
                        class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-red-800 focus:ring-0 outline-none">
                        <option value="" disabled selected>Seleccione...</option>
                        <option value="CC">Cédula de Ciudadanía (CC)</option>
                        <option value="TI">Tarjeta de Identidad (TI)</option>
                        <option value="CE">Cédula de Extranjería (CE)</option>
                        <option value="PA">Pasaporte (PA)</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Número de Documento *</label>
                    <input type="text" name="doc_number" required placeholder="Ej: 111000222"
                        class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-red-800 focus:ring-0 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nombre Completo del Estudiante
                    *</label>
                <input type="text" name="student_name" required placeholder="Ej: JUAN PÉREZ GARCÍA"
                    class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-red-800 focus:ring-0 outline-none uppercase">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">1. Seleccionar Categoría
                        *</label>
                    <select id="category_select"
                        class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-red-800 focus:ring-0 outline-none">
                        <option value="" disabled selected>Seleccione una categoría...</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">2. Seleccionar Curso *</label>
                    <select id="course_select" name="course_id" required disabled
                        class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-red-800 focus:ring-0 outline-none disabled:bg-gray-200 disabled:text-gray-400">
                        <option value="" disabled selected>Primero elija una categoría</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Archivo del Certificado (Solo PDF,
                    Máx 5MB) *</label>
                <input type="file" name="pdf_file" accept=".pdf" required
                    class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-red-800 focus:ring-0 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-red-50 file:text-red-800 hover:file:bg-red-100 transition">
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                    class="px-8 py-3 bg-red-800 text-white font-bold rounded-xl hover:bg-red-900 shadow-md transition-all">
                    Guardar y Proteger Certificado
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category_select');
    const courseSelect = document.getElementById('course_select');

    categorySelect.addEventListener('change', function() {
        const categoryId = this.value;

        // Mientras carga, le avisamos a la administradora
        courseSelect.innerHTML = '<option value="" disabled selected>Cargando cursos...</option>';
        courseSelect.disabled = true;

        // Llamamos a la ruta interna (API) que creamos en el controlador
        fetch(`/admin/api/cursos-por-categoria/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                courseSelect.innerHTML =
                    '<option value="" disabled selected>Seleccione el curso exacto...</option>';

                if (data.length === 0) {
                    courseSelect.innerHTML =
                        '<option value="" disabled selected>No hay cursos en esta categoría</option>';
                } else {
                    // Llenamos el select con los cursos que llegaron de la base de datos
                    data.forEach(course => {
                        courseSelect.innerHTML +=
                            `<option value="${course.id}">${course.title}</option>`;
                    });
                    courseSelect.disabled = false; // Lo activamos
                }
            })
            .catch(error => {
                console.error('Error cargando los cursos:', error);
                courseSelect.innerHTML =
                    '<option value="" disabled selected>Error de conexión</option>';
            });
    });
});
</script>
@endsection
@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-sm border mt-6">
    <div class="mb-6 border-b pb-4">
        <h2 class="text-2xl font-black text-gray-800 uppercase tracking-wide">Textos de la Página Principal</h2>
        <p class="text-sm text-gray-500 mt-1">Edita la información usando el editor visual avanzado (estilo Word).</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm">
        <p class="text-green-800 font-bold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    <form action="{{ route('home.content.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-8 bg-gray-50 p-5 rounded-xl border border-gray-200">
            <label class="block text-sm font-black text-red-800 uppercase mb-2">1. Pestaña: Educación Continuada</label>
            <textarea id="editor_about" name="about_us">{{ $content->about_us ?? '' }}</textarea>
        </div>

        <div class="mb-8 bg-gray-50 p-5 rounded-xl border border-gray-200">
            <label class="block text-sm font-black text-red-800 uppercase mb-2">2. Pestaña: Tipos de Formación</label>
            <textarea id="editor_types" name="formation_types">{{ $content->formation_types ?? '' }}</textarea>
        </div>

        <div class="mb-8 bg-gray-50 p-5 rounded-xl border border-gray-200">
            <label class="block text-sm font-black text-red-800 uppercase mb-2">3. Pestaña: Descuentos</label>
            <textarea id="editor_discounts" name="discounts">{{ $content->discounts ?? '' }}</textarea>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit"
                class="px-8 py-3 bg-red-800 text-white font-bold uppercase tracking-wider text-sm rounded-xl hover:bg-red-900 transition shadow-lg transform hover:-translate-y-0.5">
                Guardar Textos
            </button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

<script>
tinymce.init({
    selector: 'textarea',
    height: 350,
    menubar: 'file edit view insert format tools table help',
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
    toolbar: 'undo redo | blocks | fontfamily fontsize | bold italic underline forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | removeformat | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
    language: 'es' // Para que esté en español
});
</script>

@endsection
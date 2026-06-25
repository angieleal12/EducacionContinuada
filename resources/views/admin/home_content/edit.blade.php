@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto relative z-10 animate-[fadeIn_0.5s_ease-in-out]">

    <!-- Encabezado y botón Volver -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-white font-space tracking-wide flex items-center gap-3">
                <span class="text-purple-500 drop-shadow-[0_0_10px_rgba(168,85,247,0.5)]">📢</span> Textos de la Página
                Principal
            </h2>
            <p class="text-gray-400 text-sm mt-1">Edita la información pública usando el editor visual avanzado.</p>
        </div>
        <a href="{{ route('admin.home_content.index') }}"
            class="bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white border border-white/10 px-5 py-2.5 rounded-xl font-space font-bold transition-all shadow-sm flex items-center gap-2 text-sm">
            ← Volver al Centro
        </a>
    </div>

    <!-- Alerta de Éxito Estilo Neón -->
    @if(session('success'))
    <div
        class="bg-emerald-500/10 border-l-4 border-emerald-500 p-5 mb-8 rounded-xl shadow-[0_0_15px_rgba(16,185,129,0.1)] backdrop-blur-md">
        <p class="text-emerald-400 font-space font-bold text-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </p>
    </div>
    @endif

    <!-- Contenedor Principal de Cristal Oscuro -->
    <div class="bg-[#18151a]/95 backdrop-blur-xl p-8 md:p-10 rounded-2xl shadow-xl border border-white/10 relative">

        <form action="{{ route('home.content.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Navegación de Pestañas Estilo Tech -->
            <div
                class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 bg-black/30 p-1.5 rounded-xl mb-8 border border-white/5">
                <button type="button" onclick="openTab('tab1', this)"
                    class="tab-btn flex-1 py-3 text-sm font-space font-bold rounded-lg bg-white/10 text-purple-400 border border-white/5 shadow-sm transition-all">
                    1. Educación Continuada
                </button>
                <button type="button" onclick="openTab('tab2', this)"
                    class="tab-btn flex-1 py-3 text-sm font-space font-bold rounded-lg text-gray-500 border border-transparent hover:text-gray-300 hover:bg-white/5 transition-all">
                    2. Tipos de Formación
                </button>
                <button type="button" onclick="openTab('tab3', this)"
                    class="tab-btn flex-1 py-3 text-sm font-space font-bold rounded-lg text-gray-500 border border-transparent hover:text-gray-300 hover:bg-white/5 transition-all">
                    3. Descuentos
                </button>
            </div>

            <!-- Contenedores de los Editores (Ocultos/Visibles mediante JS) -->
            <div id="tab1" class="tab-content block animate-[fadeIn_0.3s_ease-in-out]">
                <div class="bg-black/20 border border-white/10 rounded-xl overflow-hidden">
                    <textarea id="editor_about" name="about_us">{{ $content->about_us ?? '' }}</textarea>
                </div>
            </div>

            <div id="tab2" class="tab-content hidden animate-[fadeIn_0.3s_ease-in-out]">
                <div class="bg-black/20 border border-white/10 rounded-xl overflow-hidden">
                    <textarea id="editor_types" name="formation_types">{{ $content->formation_types ?? '' }}</textarea>
                </div>
            </div>

            <div id="tab3" class="tab-content hidden animate-[fadeIn_0.3s_ease-in-out]">
                <div class="bg-black/20 border border-white/10 rounded-xl overflow-hidden">
                    <textarea id="editor_discounts" name="discounts">{{ $content->discounts ?? '' }}</textarea>
                </div>
            </div>

            <!-- Botón Guardar Premium -->
            <div class="flex justify-end pt-8 mt-8 border-t border-white/10">
                <button type="submit"
                    class="px-8 py-3.5 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-500 hover:to-purple-400 text-white font-space font-bold uppercase tracking-wider text-sm rounded-xl transition-all shadow-[0_0_15px_rgba(168,85,247,0.3)] hover:shadow-[0_0_25px_rgba(168,85,247,0.5)] border border-purple-400/50 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                        </path>
                    </svg>
                    Guardar Todos los Textos
                </button>
            </div>
        </form>
    </div>
</div>

<!-- TinyMCE CDN Exclusivo de esta vista -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>



@endsection
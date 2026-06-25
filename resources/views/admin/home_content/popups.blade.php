@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto relative z-10 animate-[fadeIn_0.5s_ease-in-out]">

    <!-- Encabezado y botón Volver -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-white font-space tracking-wide flex items-center gap-3">
                <span class="text-red-500 drop-shadow-[0_0_10px_rgba(239,68,68,0.5)]">📢</span> Gestor de Ofertas
                (Pop-up)
            </h2>
            <p class="text-gray-400 text-sm mt-1 font-light">Sube banners o afiches que saltarán en la pantalla
                principal.</p>
        </div>
        <a href="{{ route('admin.home_content.index') }}"
            class="bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white border border-white/10 px-5 py-2.5 rounded-xl font-space font-bold transition-all shadow-sm flex items-center gap-2 text-sm">
            ← Volver al Centro
        </a>
    </div>

    <!-- Alertas de Error -->
    @if($errors->any())
    <div
        class="bg-red-500/10 border-l-4 border-red-500 p-5 mb-8 rounded-xl shadow-[0_0_15px_rgba(239,68,68,0.1)] backdrop-blur-md">
        <p class="text-red-400 font-space font-bold text-sm mb-2 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                </path>
            </svg>
            Error: Verifica los datos del formulario:
        </p>
        <ul class="list-disc list-inside text-sm text-red-300 ml-7 space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Formulario de Subida -->
    <div class="bg-[#18151a]/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/10 p-6 md:p-8 mb-12">
        <h3 class="font-space font-bold text-red-400 mb-6 uppercase tracking-widest text-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
            </svg>
            Subir Nueva Campaña
        </h3>

        <form action="{{ route('admin.popups.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
            @csrf

            <div class="group">
                <label
                    class="block text-[11px] font-bold text-gray-400 mb-2 uppercase tracking-widest font-space group-focus-within:text-red-400 transition-colors">Título
                    Interno *</label>
                <input type="text" name="title" required placeholder="Ej: Promo Junio"
                    class="w-full bg-black/20 border border-white/10 p-3.5 rounded-xl text-sm text-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500/50 outline-none transition-all hover:border-white/20">
            </div>

            <div class="group">
                <label
                    class="block text-[11px] font-bold text-gray-400 mb-2 uppercase tracking-widest font-space group-focus-within:text-red-400 transition-colors">Link
                    al hacer clic (Opcional)</label>
                <input type="url" name="link" placeholder="https://..."
                    class="w-full bg-black/20 border border-white/10 p-3.5 rounded-xl text-sm text-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500/50 outline-none transition-all hover:border-white/20">
            </div>

            <div class="group">
                <label
                    class="block text-[11px] font-bold text-gray-400 mb-2 uppercase tracking-widest font-space group-hover:text-red-400 transition-colors">Imagen
                    (Banner/Afiche) *</label>
                <input type="file" name="image" accept="image/*" required
                    class="w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-space file:font-bold file:bg-white/10 file:text-gray-300 hover:file:bg-white/20 file:transition-all cursor-pointer border border-white/10 p-1.5 rounded-xl bg-black/20 hover:border-white/20 transition-all">
            </div>

            <div class="md:col-span-3 flex justify-end mt-4 pt-4 border-t border-white/5">
                <button type="submit"
                    class="px-8 py-3.5 bg-gradient-to-r from-red-700 to-red-900 hover:from-red-600 hover:to-red-800 text-white font-space font-bold uppercase tracking-wider text-sm rounded-xl transition-all shadow-[0_0_15px_rgba(220,38,38,0.3)] hover:shadow-[0_0_25px_rgba(220,38,38,0.5)] border border-red-500/50 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                        </path>
                    </svg>
                    Subir Oferta
                </button>
            </div>
        </form>
    </div>

    <!-- Galería de Campañas -->
    <div class="flex items-center gap-4 mb-6">
        <h3 class="font-space font-bold text-white uppercase tracking-widest text-base">Campañas Disponibles</h3>
        <div class="h-px bg-white/10 flex-1"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($popups as $popup)
        <div
            class="bg-[#18151a]/80 backdrop-blur-md rounded-2xl shadow-lg border {{ $popup->is_active ? 'border-emerald-500/50 shadow-[0_0_20px_rgba(16,185,129,0.15)]' : 'border-white/10' }} overflow-hidden flex flex-col transition-all duration-300 group hover:-translate-y-1">

            <!-- Contenedor de Imagen -->
            <div
                class="h-48 bg-black/60 relative overflow-hidden flex items-center justify-center border-b border-white/5">
                <img src="{{ asset('storage/' . $popup->image_path) }}" alt="{{ $popup->title }}"
                    class="object-cover w-full h-full opacity-80 group-hover:opacity-100 transition-opacity duration-300">

                @if($popup->is_active)
                <div
                    class="absolute top-3 right-3 bg-emerald-500/20 text-emerald-400 border border-emerald-500/50 text-[10px] px-3 py-1.5 rounded-full font-space font-bold uppercase tracking-widest backdrop-blur-md flex items-center gap-2 shadow-lg">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Activo
                </div>
                @endif
            </div>

            <!-- Información -->
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <h4
                        class="font-space font-bold text-gray-200 text-lg mb-1.5 group-hover:text-white transition-colors">
                        {{ $popup->title }}</h4>
                    @if($popup->link)
                    <a href="{{ $popup->link }}" target="_blank"
                        class="text-xs font-medium text-blue-400 hover:text-blue-300 hover:underline truncate flex items-center gap-1.5 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Ver Link Asociado
                    </a>
                    @else
                    <span class="text-xs text-gray-500 italic block">Sin Link</span>
                    @endif
                </div>

                <!-- Acciones -->
                <div class="flex justify-between items-center mt-5 pt-4 border-t border-white/5">

                    <form action="{{ route('admin.popups.toggle', $popup->id) }}" method="POST">
                        @csrf @method('PATCH')
                        @if($popup->is_active)
                        <button type="submit"
                            class="text-[11px] uppercase tracking-wider font-space font-bold text-gray-400 bg-white/5 hover:bg-white/10 border border-white/10 hover:text-gray-300 px-4 py-2 rounded-lg transition-all shadow-sm">
                            Apagar
                        </button>
                        @else
                        <button type="submit"
                            class="text-[11px] uppercase tracking-wider font-space font-bold text-emerald-400 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/30 hover:border-emerald-500/50 px-4 py-2 rounded-lg transition-all shadow-sm">
                            Encender
                        </button>
                        @endif
                    </form>

                    <form action="{{ route('admin.popups.destroy', $popup->id) }}" method="POST"
                        onsubmit="return confirm('¿Estás seguro de borrar definitivamente este afiche?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="text-red-400 bg-red-500/10 hover:bg-red-500/20 border border-transparent hover:border-red-500/30 p-2 rounded-lg transition-all"
                            title="Eliminar campaña">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
        </div>
        @empty
        <!-- Estado Vacío -->
        <div
            class="md:col-span-2 lg:col-span-3 text-center py-16 bg-[#18151a]/50 backdrop-blur-sm rounded-2xl border border-dashed border-white/20">
            <div class="text-5xl mb-4 opacity-50 drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">🖼️</div>
            <p class="font-space font-bold text-lg text-gray-300">No hay ofertas publicitarias</p>
            <p class="text-sm mt-1 font-light text-gray-500">Sube tu primer banner en el formulario de arriba.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
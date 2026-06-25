@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-8 relative z-10 animate-[fadeIn_0.5s_ease-in-out]">

    <div class="text-center mb-10 relative">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-24 bg-purple-900/20 rounded-full blur-[60px] pointer-events-none">
        </div>
        <h1 class="text-2xl md:text-3xl font-bold text-white tracking-wide mb-2 relative z-10"
            style="font-family: 'Poppins', sans-serif;">
            Centro de Publicidad y Contenido
        </h1>
        <p class="text-gray-400 text-xs md:text-sm font-light relative z-10">¿Qué te gustaría gestionar el día de hoy?
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">

        <a href="{{ route('home.content.edit') }}"
            class="group relative bg-[#18151a]/80 backdrop-blur-xl p-6 md:p-8 rounded-2xl border border-white/5 hover:border-purple-500/30 transition-all duration-500 flex flex-col items-center text-center overflow-hidden shadow-xl hover:shadow-[0_0_20px_rgba(168,85,247,0.15)]">

            <div
                class="absolute -top-16 -right-16 w-32 h-32 bg-purple-600/10 rounded-full blur-[30px] group-hover:bg-purple-600/20 transition-colors duration-500 pointer-events-none">
            </div>

            <div
                class="relative w-16 h-16 bg-purple-500/10 border border-purple-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:-translate-y-1 group-hover:shadow-[0_5px_15px_rgba(168,85,247,0.2)] transition-all duration-300">
                <span class="text-3xl drop-shadow-[0_0_10px_rgba(168,85,247,0.4)]">📝</span>
            </div>

            <h2 class="relative text-lg md:text-xl font-bold text-gray-200 mb-2 group-hover:text-purple-400 transition-colors"
                style="font-family: 'Poppins', sans-serif;">Editar Textos Públicos</h2>
            <p class="relative text-gray-400 text-xs px-2 font-light leading-relaxed">
                Modifica la información estática de la página principal: educación continuada y descuentos.
            </p>
        </a>

        <a href="{{ route('admin.popups.index') }}"
            class="group relative bg-[#18151a]/80 backdrop-blur-xl p-6 md:p-8 rounded-2xl border border-white/5 hover:border-red-500/30 transition-all duration-500 flex flex-col items-center text-center overflow-hidden shadow-xl hover:shadow-[0_0_20px_rgba(239,68,68,0.15)]">

            <div
                class="absolute -bottom-16 -left-16 w-32 h-32 bg-red-600/10 rounded-full blur-[30px] group-hover:bg-red-600/20 transition-colors duration-500 pointer-events-none">
            </div>

            <div
                class="relative w-16 h-16 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:-translate-y-1 group-hover:shadow-[0_5px_15px_rgba(239,68,68,0.2)] transition-all duration-300">
                <span class="text-3xl drop-shadow-[0_0_10px_rgba(239,68,68,0.4)]">📢</span>
            </div>

            <h2 class="relative text-lg md:text-xl font-bold text-gray-200 mb-2 group-hover:text-red-400 transition-colors"
                style="font-family: 'Poppins', sans-serif;">Subir Nuevas Ofertas</h2>
            <p class="relative text-gray-400 text-xs px-2 font-light leading-relaxed">
                Publica afiches y banners dinámicos para promocionar los diplomados más recientes.
            </p>
        </a>

    </div>
</div>
@endsection
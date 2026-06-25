@extends('layouts.public')

@section('content')

<div class="w-full relative shadow-md mb-10 overflow-hidden">
    <img src="{{ asset('images/BannerEdCont.png') }}" alt="Educación Continuada Universidad del Tolima"
        class="w-full h-auto md:h-[400px] object-cover block">

    <div class="absolute inset-0 bg-gradient-to-r  via-gray-900/60 to-gray-900/30 pointer-events-none">
    </div>
</div>

<div class="container mx-auto px-6 mb-12">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">

        <div class="flex flex-col md:flex-row bg-gray-50 border-b border-gray-200">
            <button onclick="openTab(event, 'tab-educacion')"
                class="tab-button flex-1 py-4 px-6 text-sm font-bold text-center border-t-4 bg-white text-red-700 border-red-700 transition-colors">
                Educación Continuada
            </button>
            <button onclick="openTab(event, 'tab-tipos')"
                class="tab-button flex-1 py-4 px-6 text-sm font-bold text-center border-t-4 border-transparent bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors">
                Tipos de formación
            </button>
            <button onclick="openTab(event, 'tab-descuentos')"
                class="tab-button flex-1 py-4 px-6 text-sm font-bold text-center border-t-4 border-transparent bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors">
                Descuentos
            </button>
        </div>

        <div class="p-6 md:p-8">

            <div id="tab-educacion" class="tab-content block animate-fade-in">
                <h3 class="bg-green-700 text-white font-bold py-2 px-4 mb-4 rounded-sm shadow-sm inline-block">
                    ¿Qué es Educación Continuada?
                </h3>
                <div id="texto-educacion"
                    class="editor-content text-gray-700 leading-relaxed line-clamp-4 transition-all duration-300">
                    {!! clean($homeContent->about_us ?? '<p>La información se actualizará pronto.</p>') !!}
                </div>
                <button onclick="toggleText('texto-educacion', this)"
                    class="mt-4 text-sm font-bold text-red-700 hover:text-red-900 flex items-center gap-1 transition-colors toggle-btn">
                    Ver más ↓
                </button>
            </div>

            <div id="tab-tipos" class="tab-content hidden animate-fade-in">
                <h3 class="bg-green-700 text-white font-bold py-2 px-4 mb-4 rounded-sm shadow-sm inline-block">
                    Tipos de formación
                </h3>
                <div id="texto-tipos"
                    class="editor-content text-gray-700 leading-relaxed line-clamp-4 transition-all duration-300">
                    {!! clean($homeContent->formation_types ?? '<p>La información se actualizará pronto.</p>') !!}
                </div>
                <button onclick="toggleText('texto-tipos', this)"
                    class="mt-4 text-sm font-bold text-red-700 hover:text-red-900 flex items-center gap-1 transition-colors toggle-btn">
                    Ver más ↓
                </button>
            </div>

            <div id="tab-descuentos" class="tab-content hidden animate-fade-in">
                <h3 class="bg-green-700 text-white font-bold py-2 px-4 mb-4 rounded-sm shadow-sm inline-block">
                    Descuentos
                </h3>
                <div id="texto-descuentos"
                    class="editor-content text-gray-700 leading-relaxed line-clamp-4 transition-all duration-300">
                    {!! clean($homeContent->discounts ?? '<p>La información se actualizará pronto.</p>') !!}
                </div>
                <button onclick="toggleText('texto-descuentos', this)"
                    class="mt-4 text-sm font-bold text-red-700 hover:text-red-900 flex items-center gap-1 transition-colors toggle-btn">
                    Ver más ↓
                </button>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('js/oferta.js') }}"></script>

<div id="seccion-cursos" class="container mx-auto px-6 pb-16 scroll-mt-24">

    <div class="flex flex-wrap justify-center gap-2 mb-10">
        <a href="{{ route('public.oferta') }}#seccion-cursos"
            class="px-5 py-2 rounded-full border text-sm font-bold shadow-sm transition
            {{ !request('category') ? 'bg-green-800 text-white border-green-800' : 'bg-white text-gray-600 border-gray-200 hover:text-red-800 hover:border-red-400' }}">
            Todos
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('public.oferta', ['category' => $cat]) }}#seccion-cursos"
            class="px-5 py-2 rounded-full border text-sm font-bold shadow-sm transition
            {{ request('category') == $cat ? 'bg-green-800 text-white border-green-800' : 'bg-white text-gray-600 border-gray-200 hover:text-red-800 hover:border-red-400' }}">
            {{ $cat }}
        </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8 max-w-7xl mx-auto">
        @forelse($courses as $course)

        <div
            class="bg-white rounded-[2rem] shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 flex flex-col group">

            <div class="h-44 w-full bg-gray-100 relative overflow-hidden">
                <img src="{{ $course->image_url ?? 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800' }}"
                    alt="{{ $course->title }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>

            <div class="p-6 flex flex-col flex-grow text-center">

                <span class="text-[10px] font-black text-red-700 uppercase tracking-widest mb-3 block">
                    {{ $course->category }}
                </span>

                <h3
                    class="font-bold text-lg text-gray-900 mb-6 leading-tight flex-grow flex items-center justify-center">
                    {{ $course->title }}
                </h3>

                <div class="flex flex-col gap-2.5 mt-auto">
                    <a href="{{ route('courses.show', $course->id) }}"
                        class="w-full py-2.5 rounded-xl border-2 border-gray-900 bg-white text-gray-900 text-xs font-bold uppercase tracking-wide hover:bg-gray-900 hover:text-white transition-all">
                        Ver Detalles
                    </a>

                    <a href="{{ route('enrollments.create', $course->id) }}"
                        class="w-full py-2.5 rounded-xl border-2 border-transparent bg-red-800 text-white text-xs font-bold uppercase tracking-wide hover:bg-red-900 transition-all shadow-sm">
                        Inscribirme
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200">
            <p class="text-gray-400 font-bold uppercase tracking-widest">No hay cursos disponibles</p>
        </div>
        @endforelse
    </div>
</div>

@php
$activePopups = \App\Models\Popup::where('is_active', true)->get();
@endphp

@if($activePopups->count() > 0)
<div id="promo-popup"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-80 transition-opacity duration-300">

    <div class="relative max-w-2xl w-[90%] mx-auto bg-transparent rounded-lg shadow-2xl animate-popup-bounce">

        <button onclick="closePopup()"
            class="absolute -top-4 -right-4 bg-red-700 text-white rounded-full w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-red-800 shadow-lg border-2 border-white z-20 transition-transform hover:scale-110 cursor-pointer">
            &times;
        </button>

        <div class="relative overflow-hidden rounded-xl border-4 border-white shadow-lg bg-white">

            @foreach($activePopups as $index => $popup)
            <div class="carousel-item {{ $index == 0 ? 'block' : 'hidden' }} w-full" data-index="{{ $index }}">
                @if($popup->link)
                <a href="{{ $popup->link }}" target="_blank" class="block w-full">
                    <img src="{{ asset('storage/' . $popup->image_path) }}" alt="{{ $popup->title }}"
                        class="w-full h-auto object-cover max-h-[80vh]">
                </a>
                @else
                <img src="{{ asset('storage/' . $popup->image_path) }}" alt="{{ $popup->title }}"
                    class="w-full h-auto object-cover max-h-[80vh]">
                @endif
            </div>
            @endforeach

            @if($activePopups->count() > 1)
            <button onclick="prevPopup()"
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-opacity-80 transition z-10 font-bold text-lg">
                &#10094;
            </button>
            <button onclick="nextPopup()"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-opacity-80 transition z-10 font-bold text-lg">
                &#10095;
            </button>

            <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-10">
                @foreach($activePopups as $index => $popup)
                <span
                    class="dot w-3 h-3 rounded-full bg-white bg-opacity-50 {{ $index == 0 ? 'bg-opacity-100 shadow' : '' }}"></span>
                @endforeach
            </div>
            @endif
        </div>

    </div>
</div>
@endif
@endsection
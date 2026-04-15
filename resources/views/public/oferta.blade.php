@extends('layouts.public')

@section('content')

<style>
.editor-content h1,
.editor-content h2,
.editor-content h3,
.editor-content h4 {
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: #1f2937;
}

.editor-content h1 {
    font-size: 2rem;
}

.editor-content h2 {
    font-size: 1.5rem;
}

.editor-content h3 {
    font-size: 1.25rem;
}

.editor-content p {
    margin-bottom: 1rem;
}

.editor-content ul {
    list-style-type: disc;
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}

.editor-content ol {
    list-style-type: decimal;
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}

.editor-content a {
    color: #b91c1c;
    text-decoration: underline;
    font-weight: bold;
}

.editor-content strong,
.editor-content b {
    font-weight: 900;
}

.editor-content em,
.editor-content i {
    font-style: italic;
}
</style>

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
            {{ !request('category') ? 'bg-green-800 text-white border-green800' : 'bg-white text-gray-600 border-gray-200 hover:text-red-800 hover:border-red-400' }}">
            Todos
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('public.oferta', ['category' => $cat->id]) }}#seccion-cursos"
            class="px-5 py-2 rounded-full border text-sm font-bold shadow-sm transition
            {{ request('category') == $cat->id ? 'bg-green-800 text-white border-green-800' : 'bg-white text-gray-600 border-gray-200 hover:text-red-800 hover:border-red-400' }}">
            {{ $cat->label }}
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
                    {{ $course->category->label }}
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
@endsection
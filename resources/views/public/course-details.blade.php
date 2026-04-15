@extends('layouts.public')

@section('content')
<div class="max-w-6xl mx-auto py-16 px-4">
    <div class="flex flex-col lg:flex-row gap-8">

        <div class="lg:w-2/3 space-y-8">
            <div class="bg-white rounded-3xl shadow-sm border p-8">
                <h1 class="text-4xl font-black text-gray-900 mb-6 leading-tight">{{ $course->title }}</h1>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-gray-50 p-4 rounded-2xl text-center border border-gray-100">
                        <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Horas
                            Certificadas</span>
                        <span class="font-black text-xl text-gray-800">{{ $course->hours }}</span>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl text-center border border-gray-100">
                        <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Duración</span>
                        <span class="font-black text-xl text-gray-800">{{ $course->duration ?? 'N/A' }}</span>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl text-center border border-gray-100">
                        <span
                            class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Modalidad</span>
                        <span class="font-black text-xl text-gray-800">{{ $course->mode ?? 'Virtual' }}</span>
                    </div>
                </div>

                <div class="prose max-w-none text-gray-700">

                    <div class="mb-10">
                        <h3
                            class="flex items-center gap-2 text-xl font-black text-red-800 uppercase mb-4 border-b pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Justificación
                        </h3>
                        <p class="leading-relaxed text-justify">{{ $course->justification }}</p>
                    </div>

                    @if($course->general_objective)
                    <div class="mb-10">
                        <h3
                            class="flex items-center gap-2 text-xl font-black text-red-800 uppercase mb-4 border-b pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Objetivo General
                        </h3>
                        <div
                            class="bg-red-50 p-5 rounded-xl border-l-4 border-red-700 italic text-gray-800 font-medium">
                            "{{ $course->general_objective }}"
                        </div>
                    </div>
                    @endif

                    @if($course->specific_objectives && count($course->specific_objectives) > 0)
                    <div class="mb-10">
                        <h3
                            class="flex items-center gap-2 text-xl font-black text-red-800 uppercase mb-4 border-b pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            Objetivos Específicos
                        </h3>
                        <ul class="space-y-3">
                            @foreach($course->specific_objectives as $objetivo)
                            <li class="flex items-start gap-3">
                                <span class="bg-red-100 text-red-700 rounded-full p-1 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span>{{ $objetivo }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mb-6">
                        <h3
                            class="flex items-center gap-2 text-xl font-black text-red-800 uppercase mb-4 border-b pb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Temario Académico
                        </h3>
                        <div class="space-y-3">
                            @foreach($course->topics as $index => $topic)
                            <div
                                class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border-l-4 border-gray-300 hover:border-red-700 hover:bg-white hover:shadow-md transition duration-300">
                                <span
                                    class="font-black text-2xl text-gray-300 group-hover:text-red-700 transition">0{{ $index + 1 }}</span>
                                <span class="font-bold text-gray-800">{{ $topic }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:w-1/3">
            <div class="bg-white rounded-3xl shadow-xl border-2 border-red-50 p-8 sticky top-28">
                <div class="text-center mb-8">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Valor de Inversión</p>
                    <p class="text-4xl font-black text-gray-900">{{ $course->cost ?? 'Gratuito' }}</p>
                    <p class="text-[10px] text-gray-400 mt-2">Más información en extension.idead@ut.edu.co</p>
                </div>

                <a href="{{ route('enrollments.create', $course->id) }}"
                    class="block w-full text-center py-4 bg-green-800 text-white font-black uppercase tracking-widest rounded-2xl hover:bg-green-900 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 mb-4">
                    Inscribirme Ahora
                </a>

                @if($course->pdf_document)
                <a href="{{ asset($course->pdf_document) }}"
                    onclick="window.open(this.href, 'FichaTecnica', 'width=800,height=700,left=300,top=100'); return false;"
                    class="block w-full text-center py-3 bg-blue-50 text-blue-800 border border-blue-200 font-bold uppercase tracking-wider rounded-xl hover:bg-blue-100 transition-all mb-6 flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd" />
                    </svg>
                    Normativa (PDF)
                </a>
                @endif
                <div class="bg-yellow-50 p-4 rounded-xl text-xs text-yellow-800 border border-yellow-100 mb-6">
                    <strong>Nota:</strong> La inscripción será gestionada por la persona encargada en el área.
                </div>

                <div class="mt-4 pt-6 border-t border-gray-100 text-center">
                    <a href="{{ route('public.oferta') }}"
                        class="inline-flex items-center gap-2 text-xs font-bold text-gray-500 hover:text-red-800 transition uppercase tracking-wide">
                        ← Volver a la Oferta
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
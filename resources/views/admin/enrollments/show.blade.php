@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto relative z-10 animate-[fadeIn_0.5s_ease-in-out]">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-3xl font-bold text-white font-space tracking-wide flex items-center gap-3">
                <span class="text-blue-500 drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]">📄</span> Ficha de Inscripción
            </h2>
            <p class="text-gray-400 text-sm mt-1">Detalles completos de la persona inscrita.</p>
        </div>
        <a href="{{ route('admin.enrollments.index') }}"
            class="bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white border border-white/10 px-5 py-2.5 rounded-xl font-space font-bold transition-all shadow-sm flex items-center gap-2 text-sm">
            ← Volver a la lista
        </a>
    </div>

    <div class="bg-[#18151a]/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/10 overflow-hidden">

        <div
            class="bg-black/40 px-8 py-6 border-b border-white/10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">

            <div>
                <span
                    class="text-[11px] font-bold text-red-400 uppercase tracking-widest font-space">{{ $enrollment->course->category ?? 'Sin Categoría' }}</span>
                <h3 class="text-xl md:text-2xl font-bold text-white mt-1 font-space">
                    {{ $enrollment->course->title ?? 'Programa Eliminado' }}</h3>
            </div>

            <div class="flex flex-wrap items-center gap-5 w-full lg:w-auto">

                @php
                $statusColors = [
                'Aprobado' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30
                shadow-[0_0_10px_rgba(16,185,129,0.1)]',
                'Rechazado' => 'bg-red-500/10 text-red-400 border-red-500/30 shadow-[0_0_10px_rgba(239,68,68,0.1)]',
                'Pendiente' => 'bg-amber-500/10 text-amber-400 border-amber-500/30
                shadow-[0_0_10px_rgba(245,158,11,0.1)]'
                ];
                $colorClass = $statusColors[$enrollment->status] ?? 'bg-gray-500/10 text-gray-400 border-gray-500/30';
                @endphp

                <div class="flex flex-col items-start lg:items-end">
                    <span class="text-[10px] text-gray-500 uppercase tracking-widest font-space mb-1">Estado
                        Actual</span>
                    <span
                        class="px-4 py-1.5 inline-flex text-xs leading-5 font-space font-bold rounded-full border {{ $colorClass }}">
                        @if($enrollment->status === 'Aprobado') ✔
                        @elseif($enrollment->status === 'Rechazado') ✖
                        @else ⏳
                        @endif
                        &nbsp;{{ $enrollment->status }}
                    </span>
                </div>

                <div class="border-l border-white/10 pl-5 flex gap-3">
                    @if($enrollment->status === 'Pendiente')
                    <form action="{{ route('admin.enrollments.updateStatus', [$enrollment->id, 'Aprobado']) }}"
                        method="POST">
                        @csrf @method('PATCH')
                        <button type="submit"
                            class="bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white px-5 py-2.5 rounded-xl text-sm font-space font-bold transition-all shadow-[0_0_15px_rgba(16,185,129,0.2)] hover:shadow-[0_0_20px_rgba(16,185,129,0.4)] border border-emerald-400/50 flex items-center gap-2">
                            ✔ Aprobar
                        </button>
                    </form>

                    <form action="{{ route('admin.enrollments.updateStatus', [$enrollment->id, 'Rechazado']) }}"
                        method="POST">
                        @csrf @method('PATCH')
                        <button type="submit"
                            class="bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30 px-5 py-2.5 rounded-xl text-sm font-space font-bold transition-all flex items-center gap-2"
                            onclick="return confirm('¿Confirma que desea RECHAZAR a esta persona? El registro se programará para eliminación.');">
                            ✖ Rechazar
                        </button>
                    </form>
                    @else
                    <form action="{{ route('admin.enrollments.updateStatus', [$enrollment->id, 'Pendiente']) }}"
                        method="POST">
                        @csrf @method('PATCH')
                        <button type="submit"
                            class="bg-white/5 hover:bg-white/10 text-gray-300 border border-white/10 px-5 py-2.5 rounded-xl text-sm font-space font-bold transition-all flex items-center gap-2"
                            onclick="return confirm('¿Desea revertir el estado y volver a evaluar a esta persona?');">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                            </svg>
                            Corregir Estado
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-black/20 border border-white/5 p-6 rounded-2xl hover:border-white/10 transition-colors">
                <h4
                    class="font-space font-bold text-blue-400 border-b border-white/10 pb-3 mb-5 flex items-center gap-3">
                    <span
                        class="bg-blue-500/20 text-blue-300 w-7 h-7 rounded-lg flex items-center justify-center text-sm">1</span>
                    Identificación y Demografía
                </h4>
                <div class="space-y-4">
                    <div><span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Nombre
                            Completo:</span>
                        <p class="text-gray-200 text-sm">{{ $enrollment->full_name }}</p>
                    </div>
                    <div><span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Documento:</span>
                        <p class="text-gray-200 text-sm">{{ $enrollment->doc_type }} - {{ $enrollment->doc_number }}</p>
                    </div>
                    <div><span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Lugar
                            y Fecha de Expedición:</span>
                        <p class="text-gray-200 text-sm">{{ $enrollment->expedition_place }}
                            ({{ \Carbon\Carbon::parse($enrollment->expedition_date)->format('d/m/Y') }})</p>
                    </div>
                    <div><span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Lugar
                            y Fecha de Nacimiento:</span>
                        <p class="text-gray-200 text-sm">{{ $enrollment->birth_place }}
                            ({{ \Carbon\Carbon::parse($enrollment->birth_date)->format('d/m/Y') }})</p>
                    </div>

                    <div class="grid grid-cols-3 gap-4 pt-2">
                        <div><span
                                class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Edad:</span>
                            <p class="text-gray-200 text-sm">{{ $enrollment->age }} años</p>
                        </div>
                        <div><span
                                class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Género:</span>
                            <p class="text-gray-200 text-sm">{{ $enrollment->gender }}</p>
                        </div>
                        <div><span
                                class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">RH:</span>
                            <p class="text-gray-200 text-sm">{{ $enrollment->blood_type }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-black/20 border border-white/5 p-6 rounded-2xl hover:border-white/10 transition-colors">
                <h4
                    class="font-space font-bold text-red-400 border-b border-white/10 pb-3 mb-5 flex items-center gap-3">
                    <span
                        class="bg-red-500/20 text-red-300 w-7 h-7 rounded-lg flex items-center justify-center text-sm">2</span>
                    Contacto y Ubicación
                </h4>
                <div class="space-y-4">
                    <div><span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Correo
                            Personal:</span>
                        <p class="text-gray-200 text-sm">{{ $enrollment->personal_email }}</p>
                    </div>
                    @if($enrollment->institutional_email)
                    <div><span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Correo
                            Institucional:</span>
                        <p class="text-gray-200 text-sm">{{ $enrollment->institutional_email }}</p>
                    </div>
                    @endif
                    <div><span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Teléfono
                            / Celular:</span>
                        <p class="text-gray-200 text-sm">{{ $enrollment->phone_number }}</p>
                    </div>
                    <div><span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Ciudad
                            de Residencia:</span>
                        <p class="text-gray-200 text-sm">{{ $enrollment->city }}</p>
                    </div>
                    <div><span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Dirección
                            de Residencia:</span>
                        <p class="text-gray-200 text-sm">{{ $enrollment->address }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-black/20 border border-white/5 p-6 rounded-2xl hover:border-white/10 transition-colors">
                <h4
                    class="font-space font-bold text-amber-400 border-b border-white/10 pb-3 mb-5 flex items-center gap-3">
                    <span
                        class="bg-amber-500/20 text-amber-300 w-7 h-7 rounded-lg flex items-center justify-center text-sm">3</span>
                    Información Académica
                </h4>
                <div class="space-y-4">

                    @if($enrollment->schedule)
                    <div>
                        <span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-1.5 font-space">Horario
                            Seleccionado:</span>
                        <span
                            class="bg-white/10 text-gray-300 border border-white/10 px-3 py-1 rounded-lg text-sm">{{ $enrollment->schedule }}</span>
                    </div>
                    @endif

                    @if($enrollment->extra_details && is_array($enrollment->extra_details))
                    @php
                    $traducciones = [
                    'is_ut_student' => '¿Es estudiante activo(a) de la UT?',
                    'student_code' => 'Código Estudiantil',
                    'academic_program' => 'Programa Académico',
                    'semester' => 'Semestre Actual',
                    'has_degree' => '¿Cuenta con título superior?',
                    'degrees' => 'Títulos de Educación Superior',
                    'is_ut_graduate' => '¿Es persona graduada de la UT?'
                    ];
                    $registraTitulos = false;
                    @endphp

                    @foreach($enrollment->extra_details as $key => $value)
                    @if($value === null || $value === '' || (is_array($value) && empty($value))) @continue @endif
                    @php if ($key === 'degrees' || $key === 'has_degree') { $registraTitulos = true; } @endphp

                    <div>
                        @php $etiqueta = $traducciones[$key] ?? ucfirst(str_replace('_', ' ', $key)); @endphp
                        <span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">{{ $etiqueta }}:</span>

                        @if(is_array($value))
                        <span
                            class="text-amber-200 text-sm">{{ implode(' - ', \Illuminate\Support\Arr::flatten($value)) }}</span>
                        @else
                        @php
                        $valorVisible = $value;
                        if(strtolower($value) === 'yes') $valorVisible = 'Sí';
                        if(strtolower($value) === 'no') $valorVisible = 'No';
                        @endphp
                        <span class="text-amber-200 text-sm">{{ $valorVisible }}</span>
                        @endif
                    </div>
                    @endforeach

                    @if(!$registraTitulos)
                    <div>
                        <span
                            class="block text-[10px] text-gray-500 font-bold uppercase tracking-widest mb-0.5 font-space">Títulos
                            de Educación Superior:</span>
                        <span class="text-gray-600 italic text-sm">No registra (Ninguno)</span>
                    </div>
                    @endif

                    @elseif(empty($enrollment->schedule))
                    <p class="text-gray-500 italic text-sm">No se registró información académica adicional.</p>
                    @endif
                </div>
            </div>

            <div class="bg-black/20 border border-white/5 p-6 rounded-2xl hover:border-white/10 transition-colors">
                <h4
                    class="font-space font-bold text-emerald-400 border-b border-white/10 pb-3 mb-5 flex items-center gap-3">
                    <span
                        class="bg-emerald-500/20 text-emerald-300 w-7 h-7 rounded-lg flex items-center justify-center text-sm">4</span>
                    Documentos de Respaldo
                </h4>

                <div class="flex flex-col gap-4">
                    @if($enrollment->id_document_path && $enrollment->id_document_path !== 'N/A')
                    <a href="{{ asset($enrollment->id_document_path) }}"
                        onclick="window.open(this.href, 'VisorPDF', 'width=800,height=800,left=250,top=100,resizable=yes,scrollbars=yes'); return false;"
                        class="bg-white/5 hover:bg-white/10 border border-white/10 text-gray-200 hover:text-white text-center py-3 px-4 rounded-xl font-space font-bold uppercase transition-all flex items-center justify-center gap-3 shadow-sm">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Ver Cédula de Ciudadanía
                    </a>
                    @else
                    <div
                        class="bg-black/30 text-gray-600 text-center py-3 px-4 rounded-xl font-space font-bold uppercase border border-dashed border-white/10 text-sm">
                        Sin Cédula Adjunta
                    </div>
                    @endif

                    @if($enrollment->approval_document_path)
                    <a href="{{ asset($enrollment->approval_document_path) }}"
                        onclick="window.open(this.href, 'VisorPDF', 'width=800,height=800,left=250,top=100,resizable=yes,scrollbars=yes'); return false;"
                        class="bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 text-red-300 hover:text-red-200 text-center py-3 px-4 rounded-xl font-space font-bold uppercase transition-all flex items-center justify-center gap-3 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Ver Aval / Carta (Opción de Grado)
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
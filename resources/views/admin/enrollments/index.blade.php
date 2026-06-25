@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto relative z-10 animate-[fadeIn_0.5s_ease-in-out]">

    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
        <div>
            <h2 class="text-3xl font-bold text-white font-space tracking-wide flex items-center gap-3">
                <span class="text-red-500 drop-shadow-[0_0_10px_rgba(239,68,68,0.5)]">📋</span> Inscripciones
            </h2>
            <p class="text-gray-400 text-sm mt-2">Gestión y revisión de inscripciones por categoría.</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
            <a href="{{ url('/admin/dashboard') }}"
                class="bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white border border-white/10 text-sm font-space font-bold py-2.5 px-6 rounded-xl transition-all flex items-center justify-center gap-2 shadow-sm">
                ← Volver al Panel
            </a>

            <div class="relative group inline-block z-50">
                <button
                    class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 group-hover:bg-emerald-500/20 group-hover:text-emerald-300 text-sm font-space font-bold py-2.5 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 w-full shadow-[0_0_15px_rgba(16,185,129,0.1)] group-hover:shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Exportar Excel ▾
                </button>

                <div
                    class="absolute right-0 mt-2 w-56 bg-[#18151a] border border-white/10 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 overflow-hidden backdrop-blur-xl">
                    <a href="{{ route('admin.enrollments.export', ['category' => $selectedCategory, 'status' => 'Todos']) }}"
                        class="block px-5 py-3.5 text-sm font-space font-bold text-gray-300 hover:text-white hover:bg-white/5 border-b border-white/5 transition-colors">
                        📄 Todos los registros
                    </a>
                    <a href="{{ route('admin.enrollments.export', ['category' => $selectedCategory, 'status' => 'Pendiente']) }}"
                        class="block px-5 py-3.5 text-sm font-space font-bold text-amber-400 hover:bg-amber-500/10 border-b border-white/5 transition-colors">
                        ⏳ Solo Pendientes
                    </a>
                    <a href="{{ route('admin.enrollments.export', ['category' => $selectedCategory, 'status' => 'Aprobado']) }}"
                        class="block px-5 py-3.5 text-sm font-space font-bold text-emerald-400 hover:bg-emerald-500/10 border-b border-white/5 transition-colors">
                        ✔ Solo Aprobados
                    </a>
                    <a href="{{ route('admin.enrollments.export', ['category' => $selectedCategory, 'status' => 'Rechazado']) }}"
                        class="block px-5 py-3.5 text-sm font-space font-bold text-red-400 hover:bg-red-500/10 transition-colors">
                        ✖ Solo Rechazados
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-[#18151a]/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/10 overflow-hidden">

        <div class="flex overflow-x-auto border-b border-white/10 bg-black/20">
            @if($categories->count() > 0)
            @foreach($categories as $category)
            <a href="{{ route('admin.enrollments.index', ['category' => $category]) }}"
                class="px-6 py-4 font-space font-bold text-sm transition-all duration-300 whitespace-nowrap tracking-wider relative
                           {{ $selectedCategory == $category ? 'text-red-400 bg-white/5' : 'text-gray-500 hover:text-gray-300 hover:bg-white/5' }}">
                {{ $category }}
                @if($selectedCategory == $category)
                <span
                    class="absolute bottom-0 left-0 w-full h-0.5 bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.8)]"></span>
                @endif
            </a>
            @endforeach
            @else
            <div class="px-6 py-4 text-gray-500 font-space font-bold text-sm">No hay categorías registradas aún.</div>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/5">
                <thead class="bg-black/40">
                    <tr>
                        <th
                            class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase font-space tracking-wider">
                            Persona Inscrita</th>
                        <th
                            class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase font-space tracking-wider">
                            Programa</th>
                        <th
                            class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase font-space tracking-wider">
                            Contacto</th>
                        <th
                            class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase font-space tracking-wider">
                            Documentos</th>
                        <th
                            class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase font-space tracking-wider">
                            Estado</th>
                        <th
                            class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase font-space tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($enrollments as $enrollment)
                    <tr class="hover:bg-white/5 transition-colors group">

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="font-bold text-gray-200 group-hover:text-white transition-colors">
                                {{ $enrollment->full_name }}</div>
                            <div class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                <span
                                    class="bg-white/10 px-1.5 py-0.5 rounded text-[10px] text-gray-400 font-space">{{ $enrollment->doc_type }}</span>
                                {{ $enrollment->doc_number }}
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="text-sm font-bold text-red-400 leading-tight">
                                {{ $enrollment->course->title ?? 'Curso Eliminado' }}
                            </div>
                            <div class="text-[11px] text-gray-500 mt-1.5 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ \Carbon\Carbon::parse($enrollment->created_at)->format('d M, Y') }}
                            </div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm text-gray-300 flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ $enrollment->personal_email }}
                            </div>
                            <div class="text-sm text-gray-400 mt-1.5 flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                {{ $enrollment->phone_number }}
                            </div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap text-center space-x-2">
                            @if($enrollment->id_document_path && $enrollment->id_document_path !== 'N/A')
                            <a href="{{ asset($enrollment->id_document_path) }}" target="_blank"
                                class="inline-block text-[10px] font-space font-bold bg-white/10 hover:bg-white/20 text-gray-300 border border-white/10 hover:text-white py-1.5 px-3 rounded-lg uppercase transition-all shadow-sm">
                                Cédula
                            </a>
                            @else
                            <span class="text-[10px] text-gray-600 italic bg-black/20 px-2 py-1 rounded">Sin
                                Cédula</span>
                            @endif

                            @if($enrollment->approval_document_path)
                            <a href="{{ asset($enrollment->approval_document_path) }}" target="_blank"
                                class="inline-block text-[10px] font-space font-bold bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 hover:text-red-300 hover:border-red-500/40 py-1.5 px-3 rounded-lg uppercase transition-all shadow-sm">
                                Aval
                            </a>
                            @endif
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap text-center">
                            @php
                            $statusColors = [
                            'Aprobado' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30
                            shadow-[0_0_10px_rgba(16,185,129,0.1)]',
                            'Rechazado' => 'bg-red-500/10 text-red-400 border-red-500/30
                            shadow-[0_0_10px_rgba(239,68,68,0.1)]',
                            'Pendiente' => 'bg-amber-500/10 text-amber-400 border-amber-500/30
                            shadow-[0_0_10px_rgba(245,158,11,0.1)]'
                            ];
                            $colorClass = $statusColors[$enrollment->status] ?? 'bg-gray-500/10 text-gray-400
                            border-gray-500/30';
                            @endphp

                            <span
                                class="px-4 py-1.5 inline-flex text-[11px] leading-5 font-space font-bold rounded-full border {{ $colorClass }}">
                                @if($enrollment->status === 'Aprobado') ✔
                                @elseif($enrollment->status === 'Rechazado') ✖
                                @else ⏳
                                @endif
                                &nbsp;{{ $enrollment->status }}
                            </span>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap text-center text-sm font-medium">
                            <a href="{{ route('admin.enrollments.show', $enrollment->id) }}"
                                class="inline-flex items-center gap-1.5 text-blue-400 hover:text-blue-300 font-space font-bold bg-blue-500/10 hover:bg-blue-500/20 px-3 py-1.5 rounded-lg border border-transparent hover:border-blue-500/30 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Revisar
                            </a>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-gray-500">
                            <div class="text-5xl mb-4 opacity-50 drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">📭</div>
                            <p class="font-space font-bold text-lg text-gray-400">No hay inscripciones</p>
                            <p class="text-sm mt-1 font-light">Aún no hay registros en la categoría de <span
                                    class="text-gray-300 font-medium">{{ $selectedCategory }}</span>.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 relative z-10 opacity-80 hover:opacity-100 transition-opacity">
        {{ $enrollments->links() }}
    </div>
</div>
@endsection
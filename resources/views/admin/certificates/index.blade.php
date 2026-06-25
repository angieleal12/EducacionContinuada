@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto relative z-10 animate-[fadeIn_0.5s_ease-in-out]">

    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h2 class="text-3xl font-bold text-white font-space tracking-wide flex items-center gap-3">
                <span class="text-amber-500 drop-shadow-[0_0_15px_rgba(245,158,11,0.5)]">🎓</span> Gestor de
                Certificados
            </h2>
            <p class="text-gray-400 text-sm mt-1 font-light">Administra los diplomas y certificados oficiales de los
                estudiantes.</p>
        </div>
        <a href="{{ route('admin.certificates.create') }}"
            class="px-6 py-3.5 bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400 text-white font-space font-bold uppercase tracking-wider text-sm rounded-xl transition-all shadow-[0_0_15px_rgba(245,158,11,0.3)] hover:shadow-[0_0_25px_rgba(245,158,11,0.5)] border border-amber-400/50 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Subir Certificado
        </a>
    </div>

    @if(session('success'))
    <div
        class="bg-emerald-500/10 border-l-4 border-emerald-500 p-5 mb-8 rounded-xl shadow-[0_0_15px_rgba(16,185,129,0.1)] backdrop-blur-md">
        <p class="text-emerald-400 font-space font-bold text-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </p>
    </div>
    @endif

    <div class="bg-[#18151a]/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/10 overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/5">
                <thead class="bg-black/40">
                    <tr>
                        <th
                            class="px-6 py-5 text-left text-[11px] font-bold text-gray-400 uppercase font-space tracking-wider">
                            Estudiante</th>
                        <th
                            class="px-6 py-5 text-left text-[11px] font-bold text-gray-400 uppercase font-space tracking-wider">
                            Documento</th>
                        <th
                            class="px-6 py-5 text-left text-[11px] font-bold text-gray-400 uppercase font-space tracking-wider">
                            Curso / Programa</th>
                        <th
                            class="px-6 py-5 text-left text-[11px] font-bold text-gray-400 uppercase font-space tracking-wider">
                            Código Único</th>
                        <th
                            class="px-6 py-5 text-left text-[11px] font-bold text-gray-400 uppercase font-space tracking-wider">
                            Fecha Subida</th>
                        <th
                            class="px-6 py-5 text-right text-[11px] font-bold text-gray-400 uppercase font-space tracking-wider">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($certificates as $cert)
                    <tr class="hover:bg-white/5 transition-colors group">

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="font-bold text-gray-200 group-hover:text-white transition-colors">
                                {{ $cert->student_name }}</div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm text-gray-400 font-mono">{{ $cert->doc_type }} {{ $cert->doc_number }}
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <span
                                class="block text-[10px] font-bold text-amber-400/80 uppercase tracking-widest font-space mb-1">
                                {{ $cert->course->category ?? 'Certificado Oficial' }}
                            </span>
                            <div class="text-sm text-gray-300 leading-tight">
                                {{ Str::limit($cert->course->title, 40) }}
                            </div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div
                                class="bg-black/40 border border-white/10 px-3 py-1.5 rounded-lg inline-block shadow-inner">
                                <span
                                    class="font-mono text-xs font-bold text-amber-200/80 tracking-widest">{{ $cert->verification_code }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-xs text-gray-500 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ $cert->created_at->format('d M Y') }}
                            </div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap text-right">
                            <div class="flex justify-end items-center gap-2">

                                <a href="{{ route('admin.certificates.showPdf', $cert->id) }}"
                                    onclick="window.open(this.href, 'VisorPDF', 'width=800,height=800,left=300,top=100'); return false;"
                                    class="text-[11px] uppercase tracking-wider font-space font-bold text-blue-400 bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/30 hover:border-blue-500/50 px-3 py-2 rounded-lg transition-all flex items-center gap-1.5 shadow-sm"
                                    title="Ver PDF">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    Ver PDF
                                </a>

                                <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST"
                                    onsubmit="return confirm('¿Estás segura de eliminar este certificado? El PDF también se borrará del sistema.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-400 bg-red-500/10 hover:bg-red-500/20 border border-transparent hover:border-red-500/30 p-2 rounded-lg transition-all"
                                        title="Eliminar certificado">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-gray-500">
                            <div class="text-5xl mb-4 opacity-50 drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">📜</div>
                            <p class="font-space font-bold text-lg text-gray-400">No hay certificados subidos</p>
                            <p class="text-sm mt-1 font-light">Haz clic en el botón superior dorado para subir el primer
                                diploma.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($certificates->hasPages())
        <div class="p-5 border-t border-white/5 bg-black/20">
            {{ $certificates->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
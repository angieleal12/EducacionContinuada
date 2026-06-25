@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto relative z-10 animate-[fadeIn_0.5s_ease-in-out]">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white font-space tracking-wide flex items-center gap-3">
                <span class="text-amber-500 drop-shadow-[0_0_15px_rgba(245,158,11,0.5)]">🎓</span> Subir Nuevo
                Certificado
            </h1>
        </div>
        <a href="{{ route('admin.certificates.index') }}"
            class="bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white border border-white/10 px-5 py-2.5 rounded-xl font-space font-bold transition-all shadow-sm flex items-center gap-2 text-sm">
            ← Volver al listado
        </a>
    </div>

    <div
        class="bg-[#18151a]/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/10 p-8 mb-8 relative overflow-hidden">

        <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-500/10 rounded-full blur-[40px] pointer-events-none">
        </div>

        <label
            class="block text-[11px] font-bold text-amber-400 uppercase tracking-widest font-space mb-3 relative z-10">
            1. Buscar Estudiante Aprobado por Documento
        </label>

        <div class="flex flex-col sm:flex-row gap-4 relative z-10">
            <input type="text" id="search_doc" placeholder="Ingrese el número de cédula..."
                class="flex-1 bg-black/30 border border-white/10 p-4 rounded-xl text-white focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 outline-none transition-all font-space placeholder-gray-600">

            <button type="button" id="btn_search"
                class="bg-white/5 hover:bg-white/10 text-amber-400 border border-amber-500/30 hover:border-amber-400 font-space font-bold px-8 py-4 rounded-xl transition-all flex items-center justify-center gap-2 shadow-[0_0_15px_rgba(245,158,11,0.1)]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Buscar
            </button>
        </div>
        <p id="search_message" class="text-red-400 text-sm mt-4 font-bold font-space hidden relative z-10"></p>
    </div>

    <div class="bg-[#18151a]/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/10 p-8 hidden animate-[fadeIn_0.4s_ease-out]"
        id="certificate_form_container">
        <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf

            <div
                class="grid grid-cols-1 md:grid-cols-4 gap-6 bg-black/40 p-6 rounded-2xl border border-white/5 relative overflow-hidden">
                <div class="col-span-1">
                    <label
                        class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 font-space">Tipo</label>
                    <input type="text" name="doc_type" id="form_doc_type" readonly
                        class="w-full bg-transparent border-0 font-bold text-gray-300 p-0 focus:ring-0 text-sm">
                </div>
                <div class="col-span-1">
                    <label
                        class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 font-space">Documento</label>
                    <input type="text" name="doc_number" id="form_doc_number" readonly
                        class="w-full bg-transparent border-0 font-bold text-gray-300 p-0 focus:ring-0 text-sm">
                </div>
                <div class="col-span-2">
                    <label
                        class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 font-space">Correo
                        Asociado</label>
                    <input type="email" name="email" id="form_email" readonly
                        class="w-full bg-transparent border-0 font-bold text-gray-300 p-0 focus:ring-0 text-sm">
                </div>
                <div class="col-span-4 border-t border-white/5 pt-4 mt-2">
                    <label
                        class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 font-space">Nombre
                        Completo</label>
                    <input type="text" name="student_name" id="form_name" readonly
                        class="w-full bg-transparent border-0 font-black text-amber-100 text-xl md:text-2xl p-0 focus:ring-0 font-space tracking-wide">
                </div>
            </div>

            <div class="group">
                <label
                    class="block text-[11px] font-bold text-gray-400 mb-2 uppercase tracking-widest font-space group-focus-within:text-amber-400 transition-colors">Seleccionar
                    Programa Cursado *</label>
                <div class="relative">
                    <select name="course_id" id="form_course" required
                        class="w-full bg-black/30 border border-white/10 p-4 rounded-xl text-gray-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 outline-none transition-all appearance-none cursor-pointer">
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group">
                <label
                    class="block text-[11px] font-bold text-gray-400 mb-2 uppercase tracking-widest font-space group-hover:text-amber-400 transition-colors">Archivo
                    del Certificado (Solo PDF, Máx 5MB) *</label>
                <input type="file" name="pdf_file" accept=".pdf" required
                    class="w-full text-sm text-gray-400 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-space file:font-bold file:bg-amber-500/10 file:text-amber-400 hover:file:bg-amber-500/20 file:transition-all cursor-pointer border border-white/10 p-2 rounded-xl bg-black/30 hover:border-white/20 transition-all">
            </div>

            <div class="pt-4 flex justify-end border-t border-white/5">
                <button type="submit"
                    class="px-8 py-4 bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400 text-white font-space font-bold uppercase tracking-wider text-sm rounded-xl transition-all shadow-[0_0_15px_rgba(245,158,11,0.3)] hover:shadow-[0_0_25px_rgba(245,158,11,0.5)] border border-amber-400/50 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                    Guardar y Proteger Certificado
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
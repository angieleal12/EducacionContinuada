@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6 pt-32 mb-20">

    <div class="text-center mb-10">
        <h1 class="text-4xl font-black text-gray-900 mb-4 tracking-tight">Consulta de Certificados</h1>
        <p class="text-gray-500">Ingresa tus datos de identificación para descargar los certificados de tus cursos
            finalizados.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8 md:p-10 mb-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full -mr-10 -mt-10 opacity-50"></div>

        <form action="{{ route('certificates.find') }}" method="POST"
            class="relative z-10 grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
            @csrf

            <div class="md:col-span-4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Tipo de Documento</label>
                <select name="doc_type" required
                    class="w-full border-gray-200 border-2 p-3.5 rounded-xl focus:border-red-800 focus:ring-0 outline-none transition-colors bg-gray-50 focus:bg-white">

                    <option value="" disabled {{ !isset($certificates) ? 'selected' : '' }}>Seleccione...</option>

                    <option value="CC" {{ request('doc_type') == 'CC' ? 'selected' : '' }}>
                        Cédula de Ciudadanía (CC)
                    </option>

                    <option value="TI" {{ request('doc_type') == 'TI' ? 'selected' : '' }}>
                        Tarjeta de Identidad (TI)
                    </option>

                    <option value="CE" {{ request('doc_type') == 'CE' ? 'selected' : '' }}>
                        Cédula de Extranjería (CE)
                    </option>

                    <option value="PPT" {{ request('doc_type') == 'PPT' ? 'selected' : '' }}>
                        Permiso de Protección Temporal (PPT)
                    </option>

                    <option value="PEP" {{ request('doc_type') == 'PEP' ? 'selected' : '' }}>
                        Permiso Especial de Permanencia (PEP)
                    </option>
                    <option value="PA" {{ request('doc_type') == 'PA' ? 'selected' : '' }}>
                        Pasaporte (PA)
                    </option>
                </select>
            </div>

            <div class="md:col-span-5">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Número de Identificación</label>
                <input type="text" name="doc_number" value="{{ request('doc_number') }}" required
                    placeholder="Ej: 111000222"
                    class="w-full border-gray-200 border-2 p-3.5 rounded-xl focus:border-red-800 focus:ring-0 outline-none transition-colors bg-gray-50 focus:bg-white">
            </div>
            <div class="md:col-span-12 mt-2">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Correo Electrónico (Registrado en la
                    inscripción)</label>
                <input type="email" name="email" value="{{ request('email') }}" required
                    placeholder="Ej: estudiante@ut.edu.co"
                    class="w-full border-gray-200 border-2 p-3.5 rounded-xl focus:border-red-800 focus:ring-0 outline-none transition-colors bg-gray-50 focus:bg-white">
            </div>

            <div class="md:col-span-3">
                <button type="submit"
                    class="w-full py-4 bg-red-800 text-white font-black uppercase tracking-widest rounded-xl hover:bg-red-900 shadow-md transition-all transform hover:-translate-y-0.5">
                    Consultar
                </button>
            </div>
        </form>
    </div>

    @if(isset($certificates))
    @if($certificates->count() > 0)

    <div class="animate-fade-in">
        <div class="flex items-center gap-3 mb-6 border-b-2 border-red-800 pb-4 inline-flex">
            <h2 class="text-2xl font-black text-gray-800">
                Hola, <span class="text-red-800">{{ $certificates->first()->student_name }}</span>
            </h2>
        </div>

        <p class="text-sm text-gray-500 mb-6 font-medium">Hemos encontrado {{ $certificates->count() }} certificado(s)
            asociado(s) a tu documento.</p>

        <div class="grid grid-cols-1 gap-6">
            @foreach($certificates as $cert)
            <div
                class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 transition-all flex flex-col md:flex-row md:items-center justify-between gap-6 group">

                <div class="flex-1">

                    <span
                        class="inline-block px-3 py-1 bg-gray-100 text-gray-600 font-bold text-[10px] uppercase tracking-widest rounded-full mb-3">
                        {{ $cert->course->category ?? 'Certificado Oficial' }}
                    </span>
                    <h3
                        class="text-lg font-bold text-gray-900 leading-tight mb-2 group-hover:text-red-800 transition-colors">
                        {{ $cert->course->title }}
                    </h3>
                    <div class="flex items-center gap-4 text-xs text-gray-400 font-medium">
                        <span class="flex items-center gap-1">
                            📅 Emitido: {{ $cert->created_at->format('d M Y') }}
                        </span>
                        <span class="flex items-center gap-1">
                            🔐 Código: <span
                                class="font-mono text-gray-600 font-bold">{{ $cert->verification_code }}</span>
                        </span>
                    </div>
                </div>

                <div class="md:flex-shrink-0">
                    <a href="{{ route('certificates.download', $cert->verification_code) }}" target="_blank"
                        class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-red-800 transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Descargar PDF
                    </a>
                </div>

            </div>
            @endforeach
        </div>
    </div>

    @else
    <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-3xl p-12 text-center animate-fade-in">
        <div
            class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm text-gray-400 text-2xl">
            📄
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Aún no tienes certificados disponibles</h3>
        <p class="text-gray-500 max-w-md mx-auto text-sm">
            Revisa que tu número de documento esté escrito correctamente. Si recientemente finalizaste un curso, es
            posible que tu certificado aún esté en proceso de emisión.
        </p>
    </div>
    @endif
    @endif
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.4s ease-out forwards;
}
</style>
@endsection
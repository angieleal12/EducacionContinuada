@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-8">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-800">Gestor de Certificados</h1>
            <p class="text-sm text-gray-500 mt-1">Administra los diplomas y certificados de los estudiantes.</p>
        </div>
        <a href="{{ route('admin.certificates.create') }}"
            class="px-6 py-3 bg-red-800 text-white font-bold rounded-xl hover:bg-red-900 shadow-md transition-all flex items-center gap-2">
            <span class="text-xl leading-none">+</span> Subir Certificado
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-md flex items-center">
        <span class="text-green-800 font-bold text-sm">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-widest border-b border-gray-200">
                        <th class="p-4 font-bold">Estudiante</th>
                        <th class="p-4 font-bold">Documento</th>
                        <th class="p-4 font-bold">Curso / Programa</th>
                        <th class="p-4 font-bold">Código Único</th>
                        <th class="p-4 font-bold">Fecha Subida</th>
                        <th class="p-4 font-bold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($certificates as $cert)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="p-4 font-bold text-gray-800">{{ $cert->student_name }}</td>
                        <td class="p-4 text-gray-600">{{ $cert->doc_type }} {{ $cert->doc_number }}</td>
                        <td class="p-4 text-gray-600">
                            <span
                                class="block font-bold text-xs text-red-800 mb-1">{{ $cert->course->category->label ?? 'General' }}</span>
                            {{ Str::limit($cert->course->title, 40) }}
                        </td>
                        <td class="p-4">
                            <span
                                class="bg-gray-100 text-gray-600 font-mono text-xs font-bold px-2 py-1 rounded border border-gray-200">
                                {{ $cert->verification_code }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-500 text-xs">{{ $cert->created_at->format('d M Y') }}</td>
                        <td class="p-4 text-right flex justify-end gap-2">

                            <a href="{{ route('admin.certificates.showPdf', $cert->id) }}"
                                onclick="window.open(this.href, 'VisorPDF', 'width=800,height=700,left=300,top=100'); return false;"
                                class="px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 font-bold text-xs rounded-lg transition"
                                title="Ver PDF en ventana">
                                Ver PDF
                            </a>

                            <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás segura de eliminar este certificado? El PDF también se borrará del sistema.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 font-bold text-xs rounded-lg transition"
                                    title="Eliminar">
                                    Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center text-gray-400">
                            <p class="text-lg font-bold mb-2">No hay certificados subidos aún.</p>
                            <p class="text-sm">Haz clic en el botón superior para subir el primer diploma.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100">
            {{ $certificates->links() }}
        </div>
    </div>
</div>
@endsection
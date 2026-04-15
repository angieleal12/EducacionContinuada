@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto mb-20 mt-10 px-4">
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100 relative">

        <a href="{{ route('public.oferta') }}"
            class="absolute top-5 right-5 text-gray-400 hover:text-[#88b8a9] hover:bg-[#88b8a9]/10 transition-all duration-300 rounded-full w-10 h-10 flex items-center justify-center text-xl z-10"
            title="Salir y volver a la oferta">
            ✕
        </a>

        {{-- Encabezado con el nuevo color --}}
        <div class="bg-[#88b8a9] p-8 text-white relative">
            <div class="relative z-10">
                <h2 class="text-3xl font-extrabold tracking-tight">Formulario de Inscripción</h2>
                <p class="text-white/90 mt-2 flex items-center gap-2">
                    <span
                        class="bg-white/20 px-3 py-1 rounded-full text-xs uppercase tracking-wider font-bold">Curso</span>
                    <span class="text-lg font-medium">{{ $course->title }}</span>
                </p>
            </div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        </div>

        @if(session('success'))
        <div class="mx-8 mt-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl animate-fade-in">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-emerald-500 text-white rounded-full p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <p class="ml-3 text-sm text-emerald-800 font-semibold">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mx-8 mt-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-xl animate-bounce-short">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-rose-500 text-white rounded-full p-1 text-xs font-bold">!</div>
                <p class="ml-3 text-sm text-rose-800 font-semibold">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <form action="{{ route('enrollments.store') }}" method="POST" class="p-8 lg:p-12 space-y-10">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="course_name" value="{{ $course->title }}">

            <section>
                <div class="flex items-center gap-4 mb-6">
                    <span
                        class="flex items-center justify-center bg-[#88b8a9]/20 text-[#88b8a9] font-bold rounded-full w-8 h-8 text-sm">1</span>
                    <h3 class="text-xl font-bold text-gray-800">Datos Personales</h3>
                    <div class="flex-1 h-px bg-gray-100"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">Nombre
                            Completo *</label>
                        <input type="text" name="student_name" required
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all placeholder-gray-300"
                            placeholder="Ej: Juan Pérez">
                    </div>
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">Correo
                            Electrónico *</label>
                        <input type="email" name="student_email" required
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all"
                            placeholder="usuario@ejemplo.com">
                    </div>
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">Celular
                            *</label>
                        <input type="text" name="phone" required
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all"
                            placeholder="300 123 4567">
                    </div>
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">Dirección
                            de Residencia *</label>
                        <input type="text" name="address" required
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all"
                            placeholder="Calle, Carrera, Barrio">
                    </div>
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">Tipo
                            de Documento *</label>
                        <select name="doc_type" required
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all appearance-none bg-no-repeat bg-[right_1rem_center] bg-[length:1em_1em]"
                            style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22 fill=%22none%22 viewBox=%220 0 20 20%22%3E%3Cpath stroke=%22%236b7280%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%221.5%22 d=%22m6 8 4 4 4-4%22%2F%3E%3C%2Fsvg%3E');">
                            <option value="" disabled selected>Seleccione...</option>
                            <option>Cédula de Ciudadanía</option>
                            <option>Tarjeta de Identidad</option>
                            <option>Cédula de Extranjería</option>
                        </select>
                    </div>
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">Número
                            de Documento *</label>
                        <input type="text" name="doc_number" required
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all">
                    </div>
                </div>
            </section>

            <section>
                <div class="flex items-center gap-4 mb-6">
                    <span
                        class="flex items-center justify-center bg-[#88b8a9]/20 text-[#88b8a9] font-bold rounded-full w-8 h-8 text-sm">2</span>
                    <h3 class="text-xl font-bold text-gray-800">Perfil Académico y Laboral</h3>
                    <div class="flex-1 h-px bg-gray-100"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">¿Estudia
                            actualmente? *</label>
                        <select name="studying_now" required
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all">
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Sí">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">¿En
                            qué universidad?</label>
                        <input type="text" name="current_university"
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all">
                    </div>
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">¿Posee
                            título universitario? *</label>
                        <select name="has_degree" required
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all">
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Sí">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">Título
                            obtenido</label>
                        <input type="text" name="degree_title"
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all">
                    </div>
                </div>

                <div class="mt-6 space-y-6">
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">¿Egresado
                            de la Universidad del Tolima? *</label>
                        <select name="is_ut_graduate" required
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all">
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Sí">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1 group-focus-within:text-[#88b8a9] transition-colors">Campo
                            laboral predominante</label>
                        <select name="work_field"
                            class="w-full border-gray-200 border-2 p-3 rounded-xl focus:border-[#88b8a9] focus:ring-4 focus:ring-[#88b8a9]/10 outline-none transition-all">
                            <option value="" selected>Seleccione una opción...</option>
                            <option>Salud</option>
                            <option>Educación</option>
                            <option>Empresa privada</option>
                            <option>Microempresario</option>
                            <option>Trabajador informal</option>
                            <option>Sector cultural</option>
                            <option>Otro</option>
                        </select>
                    </div>
                </div>
            </section>

            <div class="pt-10 flex flex-col-reverse md:flex-row gap-4">
                <a href="{{ route('public.oferta') }}"
                    class="flex-1 text-gray-500 font-bold py-4 rounded-xl hover:bg-gray-50 transition-all text-center border-2 border-transparent hover:border-gray-200">
                    Cancelar
                </a>

                <button type="submit"
                    class="flex-[2] bg-[#88b8a9] text-white font-bold py-4 rounded-xl hover:bg-[#76a394] transition-all shadow-xl shadow-[#88b8a9]/20 hover:shadow-[#88b8a9]/40 transform hover:-translate-y-1 active:scale-95 text-lg">
                    Enviar Inscripción
                </button>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-[11px] text-center text-gray-400 leading-relaxed uppercase tracking-tighter">
                    Protección de datos: Al enviar este formulario, autorizas a la <strong>Oficina de Educación
                        Continuada</strong> para el tratamiento de tus datos según la Ley 1581 de 2012.
                </p>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out forwards;
}
</style>
@endsection
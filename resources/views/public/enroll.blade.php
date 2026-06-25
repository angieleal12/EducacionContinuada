@extends('layouts.public')

@section('content')
<!-- Contenedor principal con imagen de fondo ajustada y fija -->
<div class="min-h-screen w-full flex flex-col md:flex-row overflow-hidden relative bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image: url('{{ asset('images/formulario.png') }}');">

    <!-- Capa oscura opcional para que el formulario resalte sobre el fondo -->
    <div class="absolute inset-0 bg-black/20 z-0"></div>

    <!-- Contenedor del formulario alineado a la izquierda -->
    <div class="w-full md:w-[65%] p-4 md:p-8 lg:p-12 flex items-center justify-start relative z-10">
        <div class="w-full max-w-[800px] bg-white shadow-2xl rounded p-6 md:p-10 relative z-20">

            <h2 class="text-2xl md:text-[28px] font-bold text-black mb-1">{{ $course->title }}</h2>
            <span class="text-xs md:text-sm font-bold text-[#8B0000] block mb-8">
                Modalidad: {{ $course->mode ?? 'Virtual' }} | Categoría: <span
                    id="course-category">{{ $course->category }}</span>
            </span>

            <div
                class="flex justify-between bg-gray-100 p-3 rounded mb-8 text-[10px] md:text-sm font-bold text-gray-400">
                <span id="badge-1" class="text-[#8B0000]">Paso 1: Identidad</span>
                <span id="badge-2">Paso 2: Perfil Académico</span>
                <span id="badge-3">Paso 3: Requisitos</span>
            </div>

            <form action="{{ route('enrollments.store') }}" method="POST" enctype="multipart/form-data"
                id="enrollmentForm">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div id="step-1" class="step-section block">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                        <div class="md:col-span-2 flex flex-col">
                            <label class="text-[13px] font-semibold text-black mb-2">Nombre Completo *</label>
                            <input type="text" name="full_name" required placeholder="Nombres y apellidos completos"
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60]">
                        </div>

                        <div class="flex flex-col">
                            <label class="text-[13px] font-semibold text-black mb-2">Tipo de Documento *</label>
                            <select name="doc_type" id="doc_type" required
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60]">
                                <option value="">Seleccione una opción</option>
                                <option value="CC">Cédula de Ciudadanía (CC)</option>
                                <option value="TI">Tarjeta de Identidad (TI)</option>
                                <option value="CE">Cédula de Extranjería (CE)</option>
                                <option value="PPT">Permiso de Protección Temporal (PPT)</option>
                                <option value="PPT">Permiso Especial de Permanencia (PEP)</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                        </div>

                        <div class="flex flex-col">
                            <label class="text-[13px] font-semibold text-black mb-2">Número de Documento *</label>
                            <input type="text" name="doc_number" required placeholder="Ej: 1110000000"
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60]">
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 border rounded">
                            <div class="md:col-span-3 text-[12px] font-bold text-gray-500 uppercase">Lugar de Nacimiento
                                *</div>
                            <select id="birth_country"
                                class="w-full bg-white border border-gray-300 p-2 text-[13px] rounded outline-none"
                                required>
                                <option value="">País</option>
                            </select>
                            <select id="birth_state"
                                class="w-full bg-white border border-gray-300 p-2 text-[13px] rounded outline-none"
                                required disabled>
                                <option value="">Departamento</option>
                            </select>
                            <select id="birth_city"
                                class="w-full bg-white border border-gray-300 p-2 text-[13px] rounded outline-none"
                                required disabled>
                                <option value="">Municipio</option>
                            </select>
                            <input type="hidden" name="birth_place" id="birth_place_final">
                        </div>

                        <div class="flex flex-col relative">
                            <label class="text-[13px] font-semibold text-black mb-2">Fecha de Nacimiento *</label>
                            <input type="date" name="birth_date" id="birth_date" required
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60]">
                            <input type="hidden" name="age" id="age_hidden">
                        </div>

                        <div class="flex flex-col relative">
                            <label class="text-[13px] font-semibold text-black mb-2">Fecha de Expedición *</label>
                            <input type="date" name="expedition_date" id="expedition_date" required disabled
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60] disabled:opacity-50">
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 border rounded">
                            <div class="md:col-span-3 text-[12px] font-bold text-gray-500 uppercase">Lugar de Expedición
                                del Documento *</div>
                            <select id="exp_country"
                                class="w-full bg-white border border-gray-300 p-2 text-[13px] rounded outline-none"
                                required>
                                <option value="">País</option>
                            </select>
                            <select id="exp_state"
                                class="w-full bg-white border border-gray-300 p-2 text-[13px] rounded outline-none"
                                required disabled>
                                <option value="">Departamento</option>
                            </select>
                            <select id="exp_city"
                                class="w-full bg-white border border-gray-300 p-2 text-[13px] rounded outline-none"
                                required disabled>
                                <option value="">Municipio</option>
                            </select>
                            <input type="hidden" name="expedition_place" id="expedition_place_final">
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 p-4 border rounded">
                            <div class="md:col-span-3 text-[12px] font-bold text-gray-500 uppercase">Lugar de Residencia
                                *</div>
                            <select id="res_country"
                                class="w-full bg-white border border-gray-300 p-2 text-[13px] rounded outline-none"
                                required>
                                <option value="">País</option>
                            </select>
                            <select id="res_state"
                                class="w-full bg-white border border-gray-300 p-2 text-[13px] rounded outline-none"
                                required disabled>
                                <option value="">Departamento</option>
                            </select>
                            <select id="res_city"
                                class="w-full bg-white border border-gray-300 p-2 text-[13px] rounded outline-none"
                                required disabled>
                                <option value="">Municipio</option>
                            </select>
                            <input type="hidden" name="city" id="city_final">
                        </div>

                        <div class="md:col-span-2 flex flex-col">
                            <label class="text-[13px] font-semibold text-black mb-2">Dirección Exacta *</label>
                            <input type="text" name="address" required placeholder="Ej: Calle 42 #3-12"
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60]">
                        </div>

                        <div class="flex flex-col">
                            <label class="text-[13px] font-semibold text-black mb-2">Correo Personal *</label>
                            <input type="email" name="personal_email" required placeholder="ejemplo@correo.com"
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60]">
                        </div>

                        <div class="flex flex-col">
                            <label class="text-[13px] font-semibold text-black mb-2">Celular / WhatsApp *</label>
                            <input type="text" name="phone_number" required placeholder="Ej: 315XXXXXXX"
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60]">
                        </div>

                        <div class="flex flex-col">
                            <label class="text-[13px] font-semibold text-black mb-2">Tipo de Sangre *</label>
                            <select name="blood_type" required
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60]">
                                <option value="">Seleccione...</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>

                        <div class="flex flex-col">
                            <label class="text-[13px] font-semibold text-black mb-2">Sexo *</label>
                            <select name="gender" required
                                class="w-full bg-[#d8d8d8] border-none p-3 text-[14px] text-[#555] outline-none rounded-sm focus:ring-2 focus:ring-[#4CAF60]">
                                <option value="">Seleccione una opción</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Masculino">Masculino</option>
                                <option value="No Binario">No Binario</option>
                                <option value="Prefiero no decir">Prefiero no decir</option>
                            </select>
                        </div>

                        <div class="md:col-span-2 flex flex-col bg-gray-50 p-4 border rounded">
                            <label class="text-[13px] font-semibold text-black mb-2">Copia de Documento de Identidad
                                (PDF) *</label>
                            <span class="text-[11px] text-[#666] mb-2">Adjunte una copia legible. (Máx. 5MB)</span>
                            <input type="file" name="id_document" accept=".pdf" required
                                class="w-full p-2 bg-white border border-[#ccc] rounded text-[14px]">
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <a href="{{ route('courses.show', $course->id) }}"
                            class="bg-[#555] text-white font-bold text-[14px] px-6 py-3 rounded hover:opacity-90 transition">Cancelar</a>
                        <button type="button" onclick="window.nextStep(2)"
                            class="bg-[#8B0000] text-white font-bold text-[14px] px-6 py-3 rounded hover:opacity-90 transition">Siguiente
                            Paso ➔</button>
                    </div>
                </div>

                <div id="step-2" class="step-section hidden">
                    <div class="mb-6 p-5 border rounded bg-gray-50">
                        <p class="font-semibold text-[14px] mb-3">¿Actualmente es estudiante activo(a) de la Universidad
                            del Tolima?</p>
                        <div class="flex gap-4 mb-4">
                            <label class="flex items-center gap-2 cursor-pointer text-[14px]"><input type="radio"
                                    name="extra_details[is_ut_student]" value="yes" id="is_student_yes"> Sí</label>
                            <label class="flex items-center gap-2 cursor-pointer text-[14px]"><input type="radio"
                                    name="extra_details[is_ut_student]" value="no" id="is_student_no" checked>
                                No</label>
                        </div>

                        <div id="ut_student_fields"
                            class="hidden grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 pt-4 border-t border-gray-200">
                            <div class="flex flex-col">
                                <label class="text-[13px] font-semibold text-[#8B0000] mb-2">Correo Institucional
                                    *</label>
                                <input type="email" name="institutional_email" id="institutional_email"
                                    placeholder="usuario@ut.edu.co"
                                    class="w-full bg-white border border-gray-300 p-3 text-[14px] rounded outline-none focus:border-[#8B0000]">
                            </div>
                            <div class="flex flex-col">
                                <label class="text-[13px] font-semibold text-black mb-2">Código Estudiantil *</label>
                                <input type="text" name="extra_details[student_code]" id="student_code"
                                    class="w-full bg-white border border-gray-300 p-3 text-[14px] rounded outline-none">
                            </div>
                            <div class="flex flex-col">
                                <label class="text-[13px] font-semibold text-black mb-2">Programa Académico *</label>
                                <input type="text" name="extra_details[academic_program]" id="academic_program"
                                    class="w-full bg-white border border-gray-300 p-3 text-[14px] rounded outline-none">
                            </div>
                            <div class="flex flex-col">
                                <label class="text-[13px] font-semibold text-black mb-2">Semestre Actual *</label>
                                <select name="extra_details[semester]" id="semester"
                                    class="w-full bg-white border border-gray-300 p-3 text-[14px] rounded outline-none">
                                    <option value="">Seleccione...</option>
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}° Semestre</option>
                                        @endfor
                                        <option value="Egresado No Graduado">Egresado(a) No Graduado(a)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 p-5 border rounded bg-gray-50">
                        <p class="font-semibold text-[14px] mb-3">¿Cuenta con algún título de educación superior
                            finalizado?</p>
                        <div class="flex gap-4 mb-4">
                            <label class="flex items-center gap-2 cursor-pointer text-[14px]"><input type="radio"
                                    name="has_degree" value="yes" id="has_degree_yes"> Sí</label>
                            <label class="flex items-center gap-2 cursor-pointer text-[14px]"><input type="radio"
                                    name="has_degree" value="no" id="has_degree_no" checked> No</label>
                        </div>

                        <div id="degree_fields" class="hidden mt-4 pt-4 border-t border-gray-200">
                            <div id="titles_container" class="flex flex-col gap-3 mb-4"></div>
                            <button type="button" id="add_title_btn"
                                class="bg-[#555] text-white text-[12px] px-4 py-2 rounded hover:bg-black transition">+
                                Agregar título obtenido</button>

                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <p class="font-semibold text-[13px] mb-2 text-[#8B0000]">¿Es persona graduada de la
                                    Universidad del Tolima?</p>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer text-[13px]"><input
                                            type="radio" name="extra_details[is_ut_graduate]" value="yes"> Sí</label>
                                    <label class="flex items-center gap-2 cursor-pointer text-[13px]"><input
                                            type="radio" name="extra_details[is_ut_graduate]" value="no" checked>
                                        No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" onclick="window.prevStep(1)"
                            class="bg-[#ccc] text-black font-bold text-[14px] px-6 py-3 rounded hover:bg-gray-400 transition">⬅
                            Anterior</button>
                        <button type="button" onclick="window.nextStep(3)"
                            class="bg-[#8B0000] text-white font-bold text-[14px] px-6 py-3 rounded hover:opacity-90 transition">Siguiente
                            Paso ➔</button>
                    </div>
                </div>

                <div id="step-3" class="step-section hidden">
                    <div class="p-6 bg-[#f9f9f9] border border-gray-200 rounded text-center mb-6">
                        @if($course->category === 'DIPLOMADOS DE OPCION DE GRADO')
                        <div class="flex flex-col items-center">
                            <h4 class="text-md font-bold mb-2 text-[#8B0000]">Aval de Opción de Grado</h4>
                            <p class="text-[13px] text-gray-600 mb-4">Es indispensable adjuntar el documento de aval
                                firmado.</p>
                            <div class="w-full text-left bg-white p-4 border rounded border-[#8B0000]">
                                <label class="text-[13px] font-semibold text-[#8B0000] mb-2 block">Adjuntar Aval (PDF)
                                    *</label>
                                <input type="file" name="approval_document" accept=".pdf" id="approval_document"
                                    class="w-full p-2 text-[14px] border border-gray-300 rounded">
                            </div>
                        </div>
                        @elseif($course->category === 'SEMINARIOS DE INGLES')
                        <div class="flex flex-col items-center">
                            <h4 class="text-md font-bold mb-2 text-green-600">Requisitos Completos</h4>
                            <p class="text-[13px] text-gray-600">No se requiere documentación adicional ni selección de
                                horarios para este seminario.</p>
                        </div>
                        @else
                        <div class="flex flex-col items-center text-left w-full">
                            <h4 class="text-md font-bold mb-4 text-center w-full">Selección de Horario</h4>
                            <div class="w-full max-w-md mx-auto">
                                <label class="text-[13px] font-semibold text-black mb-2 block">Horarios Disponibles
                                    *</label>
                                <select name="schedule" id="course_schedule"
                                    class="w-full bg-white border border-gray-300 p-3 text-[14px] rounded focus:border-[#4CAF60]">
                                    <option value="">Seleccione un horario...</option>
                                    @php
                                    $horarios = is_string($course->schedules) ? json_decode($course->schedules, true) :
                                    $course->schedules;
                                    @endphp
                                    @if(!empty($horarios) && is_array($horarios))
                                    @foreach($horarios as $horario)
                                    <option value="{{ $horario }}">{{ $horario }}</option>
                                    @endforeach
                                    @else
                                    <option value="" disabled>No hay horarios configurados</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="flex justify-between mt-[35px]">
                        <button type="button" onclick="window.prevStep(2)"
                            class="bg-[#ccc] text-black font-bold text-[14px] px-6 py-3 rounded hover:bg-gray-400 transition">⬅
                            Anterior</button>
                        <button type="submit"
                            class="bg-[#8B0000] text-white font-bold text-[14px] px-6 py-3 rounded hover:opacity-90 transition">Finalizar
                            Inscripción ✔</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/enroll.js') }}?v=1.0"></script>
@endpush
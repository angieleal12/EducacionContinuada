document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. LÓGICA CONDICIONAL: ESTUDIANTE Y TÍTULOS (Paso 2) ---
    function toggleRequired(containerId, isRequired) {
        const container = document.getElementById(containerId);
        if(!container) return;
        const inputs = container.querySelectorAll('input, select');
        inputs.forEach(input => {
            if(isRequired) {
                input.setAttribute('required', 'required');
            } else {
                input.removeAttribute('required');
                input.classList.remove('ring-2', 'ring-red-600');
                input.style.border = '';
            }
        });
    }

    const utStudentYes = document.getElementById('is_student_yes');
    const utStudentNo = document.getElementById('is_student_no');
    const utFields = document.getElementById('ut_student_fields');
    
    function handleUtStudentToggle() {
        if (utStudentYes && utStudentYes.checked) {
            utFields.classList.remove('hidden');
            toggleRequired('ut_student_fields', true);
        } else {
            utFields.classList.add('hidden');
            toggleRequired('ut_student_fields', false);
        }
    }

    if (utStudentYes && utStudentNo) {
        utStudentYes.addEventListener('change', handleUtStudentToggle);
        utStudentNo.addEventListener('change', handleUtStudentToggle);
    }

    const degreeYes = document.getElementById('has_degree_yes');
    const degreeNo = document.getElementById('has_degree_no');
    const degreeFields = document.getElementById('degree_fields');
    const titlesContainer = document.getElementById('titles_container');
    
    function handleDegreeToggle() {
        if (degreeYes && degreeYes.checked) {
            degreeFields.classList.remove('hidden');
        } else {
            degreeFields.classList.add('hidden');
            if(titlesContainer) titlesContainer.innerHTML = ''; 
        }
    }

    if (degreeYes && degreeNo) {
        degreeYes.addEventListener('change', handleDegreeToggle);
        degreeNo.addEventListener('change', handleDegreeToggle);
    }

    // --- BLOQUEO DE TÍTULOS REPETIDOS ---
    window.updateDegreeAvailability = function() {
        const selects = document.querySelectorAll('.degree-level');
        const selectedLevels = [];

        selects.forEach(select => {
            if (select.value !== '') {
                selectedLevels.push(select.value);
            }
        });

        selects.forEach(select => {
            const options = select.querySelectorAll('option');
            options.forEach(option => {
                if (option.value !== '') {
                    if (selectedLevels.includes(option.value) && select.value !== option.value) {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                }
            });
        });
    };

    const addTitleBtn = document.getElementById('add_title_btn');
    let titleCount = 0;
    
    if (addTitleBtn && titlesContainer) {
        addTitleBtn.addEventListener('click', function() {
            const currentSelects = document.querySelectorAll('.degree-level').length;
            if(currentSelects >= 4) {
                alert('Solo se permite registrar un título por cada nivel académico (máximo 4).');
                return;
            }

            titleCount++;
            const div = document.createElement('div');
            div.className = 'flex gap-2 items-center bg-white p-3 border border-gray-300 rounded shadow-sm';
            div.innerHTML = `
                <select name="extra_details[degrees][${titleCount}][level]" required onchange="window.updateDegreeAvailability()" class="degree-level w-1/3 border border-gray-300 bg-gray-50 p-2 text-[13px] outline-none rounded focus:border-[#8B0000]">
                    <option value="">Nivel...</option>
                    <option value="Pregrado">Pregrado</option>
                    <option value="Especialización">Especialización</option>
                    <option value="Maestría">Maestría</option>
                    <option value="Doctorado">Doctorado</option>
                </select>
                <input type="text" name="extra_details[degrees][${titleCount}][program]" required placeholder="Nombre del programa académico" class="w-2/3 border border-gray-300 bg-gray-50 p-2 text-[13px] outline-none rounded focus:border-[#8B0000]">
                <button type="button" class="bg-[#8B0000] text-white px-3 py-2 rounded text-[12px] font-bold hover:bg-red-900 transition" onclick="this.parentElement.remove(); window.updateDegreeAvailability();">X</button>
            `;
            titlesContainer.appendChild(div);
            window.updateDegreeAvailability(); 
        });
    }

    // --- 2. EL CANDADO: OPCIÓN DE GRADO ---
    const categoryElement = document.getElementById('course-category');
    if (categoryElement) {
        const categoria = categoryElement.innerText.trim();
        if (categoria === 'DIPLOMADOS DE OPCION DE GRADO') {
            if (utStudentYes && utStudentNo) {
                utStudentYes.checked = true;
                utStudentNo.disabled = true; 
                handleUtStudentToggle();
            }
        }
    }

    // --- 3. VALIDACIÓN DE FECHAS ---
    const birthDateInput = document.getElementById('birth_date');
    const expeditionDateInput = document.getElementById('expedition_date');
    const ageHiddenInput = document.getElementById('age_hidden');
    
    if (birthDateInput && expeditionDateInput) {
        const today = new Date();
        const maxYear = today.getFullYear() - 14;
        let maxMonth = today.getMonth() + 1;
        let maxDay = today.getDate();
        
        if(maxMonth < 10) maxMonth = '0' + maxMonth;
        if(maxDay < 10) maxDay = '0' + maxDay;
        
        birthDateInput.setAttribute('max', `${maxYear}-${maxMonth}-${maxDay}`);

        birthDateInput.addEventListener('change', function() {
            if (this.value) {
                expeditionDateInput.removeAttribute('disabled');
                expeditionDateInput.setAttribute('min', this.value);
                expeditionDateInput.setAttribute('max', `${today.getFullYear()}-${maxMonth}-${maxDay}`);

                if(expeditionDateInput.value && expeditionDateInput.value < this.value) {
                    expeditionDateInput.value = '';
                }

                const birth = new Date(this.value);
                let computedAge = today.getFullYear() - birth.getFullYear();
                const monthDiff = today.getMonth() - birth.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                    computedAge--;
                }
                ageHiddenInput.value = computedAge >= 0 ? computedAge : 0;
            } else {
                expeditionDateInput.setAttribute('disabled', 'disabled');
                expeditionDateInput.value = '';
            }
        });
    }

    // --- 4. API MUNDIAL DE LUGARES (3 Cascadas) ---
    const apiBase = "https://countriesnow.space/api/v0.1/countries";

    fetch(apiBase)
        .then(res => res.json())
        .then(data => {
            const countries = data.data;
            let options = '<option value="">Seleccione País</option>';
            options += '<option value="Colombia">Colombia</option>'; 
            countries.forEach(c => {
                if(c.country !== 'Colombia') options += `<option value="${c.country}">${c.country}</option>`;
            });
            
            document.getElementById('birth_country').innerHTML = options;
            document.getElementById('exp_country').innerHTML = options;
            document.getElementById('res_country').innerHTML = options;
        })
        .catch(err => console.error("Error cargando países", err));

    function setupCascading(countryId, stateId, cityId, hiddenId) {
        const cSelect = document.getElementById(countryId);
        const sSelect = document.getElementById(stateId);
        const ciSelect = document.getElementById(cityId);
        const hiddenFinal = document.getElementById(hiddenId);

        if(!cSelect || !sSelect || !ciSelect || !hiddenFinal) return;

        function updateHidden() {
            const country = cSelect.value;
            const state = sSelect.value;
            const city = ciSelect.value;
            if(country && state && city) {
                hiddenFinal.value = `${city}, ${state}, ${country}`;
            } else {
                hiddenFinal.value = '';
            }
        }

        cSelect.addEventListener('change', function() {
            sSelect.innerHTML = '<option value="">Cargando...</option>';
            sSelect.setAttribute('disabled', 'disabled');
            ciSelect.innerHTML = '<option value="">Seleccione Depto primero</option>';
            ciSelect.setAttribute('disabled', 'disabled');
            updateHidden();

            if(!this.value) return;

            fetch(`${apiBase}/states`, {
                method: 'POST',
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify({country: this.value})
            })
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">Seleccione Departamento</option>';
                if(data.data && data.data.states.length > 0) {
                    data.data.states.forEach(s => {
                        let cleanName = s.name.replace(' Department', '').replace(' Province', '').trim();
                        
                        if (cleanName.includes('Archipelago of Saint')) {
                            cleanName = 'San Andrés y Providencia';
                        } else if (cleanName === 'Bogota D.C.') {
                            cleanName = 'Bogotá D.C.';
                        } else if (cleanName === 'Valle del Cauca') {
                            cleanName = 'Valle del Cauca'; 
                        }

                        // AQUÍ ESTÁ EL TRUCO: Guardamos el nombre original en data-original
                        options += `<option value="${cleanName}" data-original="${s.name}">${cleanName}</option>`;
                    });
                } else {
                    options += `<option value="N/A">No aplica / Único</option>`;
                }
                sSelect.innerHTML = options;
                sSelect.removeAttribute('disabled');
            });
        });

        sSelect.addEventListener('change', function() {
            ciSelect.innerHTML = '<option value="">Cargando...</option>';
            ciSelect.setAttribute('disabled', 'disabled');
            updateHidden();

            if(!this.value || this.value === 'N/A') {
                ciSelect.innerHTML = '<option value="N/A">No aplica</option>';
                ciSelect.removeAttribute('disabled');
                updateHidden();
                return;
            }

            // AQUÍ RECUPERAMOS EL NOMBRE FEO PARA ENVIARLO A LA API
            const selectedOption = this.options[this.selectedIndex];
            const apiStateName = selectedOption.getAttribute('data-original') || this.value;

            fetch(`${apiBase}/state/cities`, {
                method: 'POST',
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify({country: cSelect.value, state: apiStateName})
            })
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">Seleccione Municipio</option>';
                if(data.data && data.data.length > 0) {
                    data.data.forEach(city => {
                        options += `<option value="${city}">${city}</option>`;
                    });
                } else {
                    options += `<option value="N/A">Ciudad Única</option>`;
                }
                ciSelect.innerHTML = options;
                ciSelect.removeAttribute('disabled');
            });
        });

        ciSelect.addEventListener('change', updateHidden);
    }

    setupCascading('birth_country', 'birth_state', 'birth_city', 'birth_place_final');
    setupCascading('exp_country', 'exp_state', 'exp_city', 'expedition_place_final');
    setupCascading('res_country', 'res_state', 'res_city', 'city_final');

    // --- 4.5 LÓGICA INTELIGENTE: AUTO-SELECCIÓN DE COLOMBIA ---
    const docTypeSelect = document.getElementById('doc_type');
    const birthCountrySelect = document.getElementById('birth_country');
    const expCountrySelect = document.getElementById('exp_country');

    if (docTypeSelect) {
        docTypeSelect.addEventListener('change', function() {
            if (this.value === 'CC' || this.value === 'TI') {
                if (birthCountrySelect && birthCountrySelect.querySelector('option[value="Colombia"]')) {
                    birthCountrySelect.value = 'Colombia';
                    birthCountrySelect.dispatchEvent(new Event('change'));
                }
                if (expCountrySelect && expCountrySelect.querySelector('option[value="Colombia"]')) {
                    expCountrySelect.value = 'Colombia';
                    expCountrySelect.dispatchEvent(new Event('change'));
                }
            }
        });
    }
});

// --- 5. NAVEGACIÓN Y VALIDACIÓN INTELIGENTE ---
window.nextStep = function(stepNumber) {
    const currentStep = document.querySelector('.step-section:not(.hidden)');
    const requiredFields = currentStep.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (field.offsetParent !== null) { 
            if (!field.value) {
                isValid = false;
                field.classList.add('ring-2', 'ring-red-600');
                field.style.border = '2px solid #8B0000';
            } else {
                field.classList.remove('ring-2', 'ring-red-600');
                field.style.border = '';
            }
        }
    });

    if (!isValid) {
        alert('Por favor complete todos los campos obligatorios antes de continuar.');
        return;
    }

    const instEmailInput = document.getElementById('institutional_email');
    if (instEmailInput && instEmailInput.offsetParent !== null && instEmailInput.value) {
        if (!instEmailInput.value.endsWith('@ut.edu.co')) {
            alert('Atención: Si es estudiante, el correo institucional debe terminar en "@ut.edu.co"');
            instEmailInput.style.border = '2px solid #8B0000';
            return; 
        } else {
            instEmailInput.style.border = '';
        }
    }

    changeStep(stepNumber);
};

window.prevStep = function(stepNumber) {
    changeStep(stepNumber);
};

function changeStep(stepNumber) {
    document.querySelectorAll('.step-section').forEach(section => {
        section.classList.add('hidden');
        section.classList.remove('block');
    });
    
    document.querySelectorAll('[id^="badge-"]').forEach(badge => {
        badge.classList.remove('text-[#8B0000]');
        badge.classList.add('text-gray-400');
    });

    document.getElementById('step-' + stepNumber).classList.remove('hidden');
    document.getElementById('step-' + stepNumber).classList.add('block');
    
    document.getElementById('badge-' + stepNumber).classList.remove('text-gray-400');
    document.getElementById('badge-' + stepNumber).classList.add('text-[#8B0000]');
}
// --- 6. INTERCEPTAR ENVÍO Y MOSTRAR RESUMEN DE CONFIRMACIÓN ---
document.addEventListener('DOMContentLoaded', function() {
    const enrollForm = document.getElementById('enrollmentForm');
    
    if(enrollForm) {
        enrollForm.addEventListener('submit', function(e) {
            // Pausamos el envío real del formulario
            e.preventDefault();
            
            // Recolectamos los datos clave para que los revise
            const name = document.querySelector('input[name="full_name"]').value;
            const doc = document.querySelector('input[name="doc_number"]').value;
            const email = document.querySelector('input[name="personal_email"]').value;
            const phone = document.querySelector('input[name="phone_number"]').value;

            Swal.fire({
                title: 'Verifica tus datos',
                html: `
                    <div style="text-align: left; font-size: 14px; margin-top: 10px;">
                        <p><b>Nombre:</b> ${name}</p>
                        <p><b>Documento:</b> ${doc}</p>
                        <p><b>Correo:</b> ${email}</p>
                        <p><b>Teléfono:</b> ${phone}</p>
                        <br>
                        <p style="color: #8B0000; font-size: 12px;"><i>¿Estás seguro de que la información y los archivos adjuntos son correctos?</i></p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, enviar inscripción',
                cancelButtonText: 'Revisar de nuevo'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si confirma, mostramos pantalla de carga y enviamos el formulario
                    Swal.fire({
                        title: 'Procesando...',
                        text: 'Estamos subiendo tus documentos y guardando tu inscripción. Por favor no cierres esta ventana.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Se reanuda el envío oficial hacia el controlador
                    enrollForm.submit();
                }
            });
        });
    }
});
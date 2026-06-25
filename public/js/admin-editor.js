// ==========================================
// LÓGICA PARA AGREGAR HORARIOS (Oferta Académica)
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    const addScheduleBtn = document.getElementById('add-schedule-btn');
    const schedulesContainer = document.getElementById('schedules-container');

    if (addScheduleBtn && schedulesContainer) {
        addScheduleBtn.addEventListener('click', function() {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-3 mt-3 animate-[fadeIn_0.3s_ease-in-out]';
            
            // Detecta si estamos en la vista de edición (busca si hay bordes azules) o creación (rojos)
            const isEditMode = document.querySelector('.focus\\:border-blue-500') !== null;
            const focusClass = isEditMode ? 'focus:border-blue-500' : 'focus:border-red-500';

            div.innerHTML = `
                <input type="text" name="schedules[]" placeholder="Ej: Sábados 07:00 a 10:00" 
                    class="w-full bg-white/5 border border-white/20 p-3.5 rounded-xl text-base text-white placeholder-gray-500 ${focusClass} focus:bg-white/10 outline-none transition-all">
                <button type="button" onclick="this.parentElement.remove()" 
                    class="bg-red-500/10 border border-red-500/30 text-red-400 px-5 py-3.5 rounded-xl text-base font-space font-bold hover:bg-red-500/20 transition-all">
                    X
                </button>
            `;
            schedulesContainer.appendChild(div);
        });
    }
});

// ==========================================
// LÓGICA PARA LAS PESTAÑAS (Módulo Publicidad)
// ==========================================
window.openTab = function(tabId, btn) {
    // 1. Ocultar todos los contenedores de texto
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
        tab.classList.remove('block');
    });
    
    // 2. Reiniciar los estilos de todos los botones (estado inactivo)
    document.querySelectorAll('.tab-btn').forEach(button => {
        button.classList.remove('bg-white/10', 'text-purple-400', 'border-white/5', 'shadow-sm');
        button.classList.add('text-gray-500', 'border-transparent');
    });
    
    // 3. Mostrar el contenedor activo
    const activeTab = document.getElementById(tabId);
    if (activeTab) {
        activeTab.classList.remove('hidden');
        activeTab.classList.add('block');
    }
    
    // 4. Aplicar estilos de estado activo al botón clickeado
    if (btn) {
        btn.classList.remove('text-gray-500', 'border-transparent');
        btn.classList.add('bg-white/10', 'text-purple-400', 'border-white/5', 'shadow-sm');
    }
};

// ==========================================
// INICIALIZACIÓN DE TINYMCE (Editor Visual)
// ==========================================
if (typeof tinymce !== 'undefined') {
    tinymce.init({
        selector: '#editor_about, #editor_types, #editor_discounts',
        skin: 'oxide-dark',      // Tema oscuro para los bordes y botones
        content_css: 'dark',     // Tema oscuro para el fondo donde escribes
        height: 350,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
            'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'table', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | code',
        setup: function (editor) {
            // Sincroniza el contenido del editor con el textarea real antes de guardar
            editor.on('change', function () {
                tinymce.triggerSave(); 
            });
        }
    });
}

// LÓGICA DE BÚSQUEDA Y SUBIDA DE CERTIFICADOS

document.addEventListener('DOMContentLoaded', function() {
    const btnSearch = document.getElementById('btn_search');
    const inputSearch = document.getElementById('search_doc');
    const messageLabel = document.getElementById('search_message');
    const formContainer = document.getElementById('certificate_form_container');
    const courseSelect = document.getElementById('form_course');

    // Verificamos que los elementos existan (para que no de error en otras páginas)
    if (btnSearch && inputSearch) {
        btnSearch.addEventListener('click', function() {
            const doc = inputSearch.value.trim();
            if (!doc) return;

            // Estado de carga con el nuevo diseño
            btnSearch.innerHTML = `<svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Buscando...`;
            messageLabel.classList.add('hidden');
            formContainer.classList.add('hidden');

            fetch(`/admin/api/estudiante-aprobado/${doc}`)
                .then(res => res.json())
                .then(data => {
                    // Restaurar botón
                    btnSearch.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg> Buscar`;
                    
                    if (!data.success) {
                        messageLabel.textContent = data.message;
                        messageLabel.classList.remove('hidden');
                        return;
                    }

                    // Autocompletar datos inmutables
                    document.getElementById('form_doc_type').value = data.doc_type;
                    document.getElementById('form_doc_number').value = doc;
                    document.getElementById('form_email').value = data.email;
                    document.getElementById('form_name').value = data.student_name;

                    // Llenar cursos
                    courseSelect.innerHTML = '';
                    data.courses.forEach(course => {
                        courseSelect.innerHTML += `<option value="${course.id}" class="bg-[#18151a] text-gray-200">${course.title}</option>`;
                    });

                    // Mostrar formulario con animación
                    formContainer.classList.remove('hidden');
                })
                .catch(err => {
                    // Restaurar botón
                    btnSearch.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg> Buscar`;
                    messageLabel.textContent = 'Error de conexión. Intente nuevamente.';
                    messageLabel.classList.remove('hidden');
                });
        });
        
        // Permitir buscar presionando "Enter"
        inputSearch.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                btnSearch.click();
            }
        });
    }
});
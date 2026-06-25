// Lógica para agregar horarios dinámicos en el formulario de cursos
document.addEventListener('DOMContentLoaded', function() {
    const addScheduleBtn = document.getElementById('add-schedule-btn');
    const schedulesContainer = document.getElementById('schedules-container');

    if (addScheduleBtn && schedulesContainer) {
        addScheduleBtn.addEventListener('click', function() {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-3 mt-3 animate-[fadeIn_0.3s_ease-in-out]';
            div.innerHTML = `
                <input type="text" name="schedules[]" placeholder="Ej: Sábados 07:00 a 10:00" 
                    class="w-full bg-[#0f0c13] border border-white/5 p-3.5 rounded-xl text-sm text-gray-200 placeholder-gray-700 focus:border-red-900/50 focus:ring-1 focus:ring-red-900/30 outline-none transition-all">
                <button type="button" onclick="this.parentElement.remove()" 
                    class="bg-[#1a1014] border border-red-900/20 text-red-500/70 px-5 py-3.5 rounded-xl text-sm font-space font-bold hover:bg-[#2a1620] hover:text-red-400 hover:border-red-900/40 transition-all">
                    X
                </button>
            `;
            schedulesContainer.appendChild(div);
        });
    }
});
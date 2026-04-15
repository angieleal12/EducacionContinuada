function openTab(evt, tabName) {
    // 1. Ocultar todos los contenidos de las pestañas principales
    let contents = document.getElementsByClassName("tab-content");
    for (let i = 0; i < contents.length; i++) {
        contents[i].classList.add("hidden");
        contents[i].classList.remove("block");
    }

    // 2. Reiniciar los colores de los botones de pestañas
    let buttons = document.getElementsByClassName("tab-button");
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("bg-white", "text-red-700", "border-red-700");
        buttons[i].classList.add("bg-gray-50", "text-gray-600", "border-transparent");
    }

    // 3. Restaurar la clase line-clamp-4 y el texto "Ver más ↓" al cambiar de pestaña
    let textContainers = document.querySelectorAll('[id^="texto-"]');
    for (let i = 0; i < textContainers.length; i++) {
        textContainers[i].classList.add('line-clamp-4');
    }
    
    let toggleBtns = document.getElementsByClassName("toggle-btn");
    for (let i = 0; i < toggleBtns.length; i++) {
        toggleBtns[i].innerHTML = "Ver más ↓";
    }

    // 4. Mostrar la pestaña actual
    document.getElementById(tabName).classList.remove("hidden");
    document.getElementById(tabName).classList.add("block");

    // 5. Colorear el botón de la pestaña actual
    evt.currentTarget.classList.remove("bg-gray-50", "text-gray-600", "border-transparent");
    evt.currentTarget.classList.add("bg-white", "text-red-700", "border-red-700");
}

// Función del botón "Ver más / Ver menos" para texto dinámico
function toggleText(targetId, btn) {
    let content = document.getElementById(targetId);
    
    // Si tiene la clase que corta el texto a 4 líneas, se la quitamos
    if (content.classList.contains('line-clamp-4')) {
        content.classList.remove('line-clamp-4');
        btn.innerHTML = 'Ver menos ↑';
    } else {
        // Si no la tiene, se la volvemos a poner para comprimirlo
        content.classList.add('line-clamp-4');
        btn.innerHTML = 'Ver más ↓';
    }
}
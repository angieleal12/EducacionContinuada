document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    const mainContent = document.getElementById('main-content');
    const navContainer = document.getElementById('nav-container');
    const logoUt = document.getElementById('logo-ut');
    const logoIdead = document.getElementById('logo-idead');
    const menuWrapper = document.getElementById('menu-wrapper');

    // Función para calcular el espacio exacto del menú gigante y aplicarlo al main
    const setInitialPadding = () => {
        if (mainContent && navbar) {
            // Solo medimos si estamos en la parte superior (menú expandido)
            if (window.scrollY <= 40) {
                mainContent.style.paddingTop = navbar.offsetHeight + 'px';
            } else if (!mainContent.style.paddingTop) {
                // Medida de seguridad por si el usuario recarga a mitad de la página
                mainContent.style.paddingTop = window.innerWidth >= 768 ? '220px' : '160px';
            }
        }
    };

    // Ejecutar inmediatamente y también cuando todo (incluyendo imágenes) termine de cargar
    setInitialPadding();
    window.addEventListener('load', setInitialPadding);

    window.addEventListener('resize', () => {
        if (window.scrollY <= 40) {
            setInitialPadding();
        }
    });

    let isScrolled = false;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 80 && !isScrolled) {
            isScrolled = true;
            
            // Acomodar contenedor: De columna a fila
            navContainer.classList.remove('flex-col', 'py-6', 'md:py-8', 'justify-center');
            navContainer.classList.add('flex-row', 'justify-between', 'py-2', 'md:py-3'); 

            // Acomodar menú: Quitar margen superior y alinear a la derecha
            menuWrapper.classList.remove('mt-4', 'md:mt-6', 'w-full', 'justify-center');
            menuWrapper.classList.add('mt-0', 'w-auto', 'justify-end');

            // Achicar logos
            logoUt.classList.remove('h-16', 'md:h-24');
            logoUt.classList.add('h-10', 'md:h-12');

            logoIdead.classList.remove('h-16', 'md:h-24');
            logoIdead.classList.add('h-10', 'md:h-12');

            // Nota: Ya NO recalculamos el padding aquí. Esto evita el salto de la imagen.

        } else if (window.scrollY <= 40 && isScrolled) {
            isScrolled = false;
            
            // Volver al estado gigante y centrado
            navContainer.classList.add('flex-col', 'py-6', 'md:py-8', 'justify-center');
            navContainer.classList.remove('flex-row', 'justify-between', 'py-2', 'md:py-3');

            menuWrapper.classList.add('mt-4', 'md:mt-6', 'w-full', 'justify-center');
            menuWrapper.classList.remove('mt-0', 'w-auto', 'justify-end');

            logoUt.classList.add('h-16', 'md:h-24');
            logoUt.classList.remove('h-10', 'md:h-12');

            logoIdead.classList.add('h-16', 'md:h-24');
            logoIdead.classList.remove('h-10', 'md:h-12');
        }
    });
});
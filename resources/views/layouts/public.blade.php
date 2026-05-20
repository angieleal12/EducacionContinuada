<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educación Continuada - Universidad del Tolima</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
    }
    </style>
</head>

<body class="bg-[#F4F4F4] flex flex-col min-h-screen">

    <nav id="navbar"
        class="fixed top-0 w-full bg-white text-gray-800 shadow-[0_8px_30px_rgb(0,0,0,0.08)] z-50 transition-all duration-500">

        <div id="nav-container"
            class="container mx-auto px-6 py-6 md:py-8 flex flex-col items-center justify-center transition-all duration-500">

            <div id="logos-wrapper" class="flex items-center justify-center gap-4 md:gap-8 transition-all duration-500">
                <img id="logo-ut" src="{{ asset('images/UT.png') }}" alt="Universidad del Tolima"
                    class="h-16 md:h-24 object-contain transition-all duration-500">

                <img id="logo-idead" src="{{ asset('images/IDEAD.png') }}" alt="IDEAD"
                    class="h-16 md:h-24 object-contain transition-all duration-500">
            </div>

            <div id="menu-wrapper"
                class="w-full mt-4 md:mt-6 flex flex-wrap justify-center gap-6 md:gap-8 text-sm md:text-base font-medium transition-all duration-500 items-center">

                <a href="{{ route('public.oferta') }}"
                    class="text-gray-700 hover:text-red-800 transition tracking-wide font-bold">Inicio</a>

                <a href="#" class="text-gray-700 hover:text-red-800 transition tracking-wide font-bold">Contacto</a>
                <a href="{{ route('certificates.search') }}"
                    class="text-gray-700 hover:text-red-800 transition tracking-wide font-bold">Certificados</a>

                <a href="https://tuaulavirtual.ut.edu.co/"
                    class="text-gray-700 hover:text-red-800 transition tracking-wide font-bold">Tu Aula Virtual</a>

                <a href="http://mantis.ut.edu.co:8080/tolima/hermesoft/vortal/login/login.jsp"
                    class="text-gray-700 hover:text-red-800 transition tracking-wide font-bold">Academusoft</a>
            </div>

        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white pt-12 pb-6 mt-auto border-t-4 border-red-800">
        <div class="container mx-auto px-6 text-center">
            <div class="mb-6 opacity-40 grayscale hover:grayscale-0 transition duration-500">
                <h2 class="text-2xl font-black tracking-widest text-gray-600">UNIVERSIDAD DEL TOLIMA</h2>
            </div>
            <p class="text-gray-500 text-sm mb-8">
                &copy; {{ date('Y') }} Oficina de Educación Continuada.<br>Ibagué - Colombia
            </p>

            <div class="border-t border-gray-800 pt-4 flex justify-center">
                <a href="{{ route('login') }}"
                    class="text-[10px] text-gray-700 hover:text-red-600 transition-colors duration-300 cursor-pointer select-none font-bold tracking-widest">
                    ● Acceso Administrativo
                </a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/navbar.js') }}"></script>
</body>

</html>
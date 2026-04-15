<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad del Tolima - Educación Continuada</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-gray-900 text-white p-4 sticky top-0 z-50 shadow-md">
        <div class="container mx-auto flex justify-between items-center">

            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded bg-red-700 flex items-center justify-center font-bold text-lg border border-red-600">
                    UT</div>
                <div>
                    <h1 class="font-bold text-lg leading-none">Panel Admin</h1>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Gestión de Educación Continuada</p>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="hidden md:flex gap-4 text-sm font-medium">
                    <a href="{{ route('public.oferta') }}"
                        class="hover:text-red-400 transition {{ request()->routeIs('public.oferta') ? 'text-red-400' : 'text-gray-300' }}">
                        Ver Oferta
                    </a>
                    <a href="{{ route('courses.index') }}"
                        class="hover:text-red-400 transition {{ request()->routeIs('courses.index') ? 'text-red-400' : 'text-gray-300' }}">
                        Admin Cursos
                    </a>
                    <a href="{{ route('home.content.edit') }}"
                        class="hover:text-red-400 transition {{ request()->routeIs('home.content.edit') ? 'text-red-400' : 'text-gray-300' }}">
                        Textos Inicio
                    </a>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-700 hover:bg-red-800 text-white text-xs font-bold px-4 py-2 rounded transition shadow-sm flex items-center gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>

                        Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6 py-8">
        @yield('content')
    </main>

</body>

</html>
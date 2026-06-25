<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Educación Continuada</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
</head>

<body
    class="bg-gradient-to-br from-[#0f0c13] via-[#1a0f14] to-[#0f0c13] text-gray-300 min-h-screen flex overflow-hidden">

    <aside
        class="w-72 bg-white/5 backdrop-blur-xl border-r border-white/10 flex flex-col h-screen relative z-20 shadow-[4px_0_24px_rgba(0,0,0,0.5)] transition-all duration-500">

        <div class="p-5 border-b border-white/10 shrink-0">
            <a href="{{ route('admin.dashboard') }}"
                class="flex flex-col items-center gap-3 group cursor-pointer text-center">
                <div class="w-full flex justify-center">
                    <img src="{{ asset('images/logo-NSLG-blc_.png') }}" alt="Universidad del Tolima"
                        class="h-16 w-auto object-contain transition-all duration-500 group-hover:scale-105 group-hover:drop-shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                </div>
                <div>
                    <h1
                        class="font-space font-bold text-sm text-white tracking-widest uppercase group-hover:text-red-400 transition-colors duration-300">
                        Administración
                    </h1>
                    <p class="text-[9px] text-gray-400 uppercase tracking-widest font-medium mt-0.5">
                        Edu. Continuada
                    </p>
                </div>
            </a>
        </div>

        <div class="flex-1">
            <nav class="p-4 space-y-2" style="font-family: 'Inter', sans-serif;">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-red-900/40 text-red-400 border-l-4 border-red-500 shadow-[inset_4px_0_0_rgba(220,38,38,1)]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    Panel Principal
                </a>

                <a href="{{ route('courses.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 {{ request()->routeIs('courses.*') ? 'bg-red-900/40 text-red-400 border-l-4 border-red-500 shadow-[inset_4px_0_0_rgba(220,38,38,1)]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477-4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Oferta Académica
                </a>

                <a href="{{ route('admin.enrollments.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.enrollments.*') ? 'bg-red-900/40 text-red-400 border-l-4 border-red-500 shadow-[inset_4px_0_0_rgba(220,38,38,1)]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Inscripciones
                </a>

                <a href="{{ route('admin.home_content.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.home_content.index', 'home.content.*', 'admin.popups.*') ? 'bg-red-900/40 text-red-400 border-l-4 border-red-500 shadow-[inset_4px_0_0_rgba(220,38,38,1)]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                        </path>
                    </svg>
                    Publicidad
                </a>

                <a href="{{ route('admin.certificates.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.certificates.*') ? 'bg-red-900/40 text-red-400 border-l-4 border-red-500 shadow-[inset_4px_0_0_rgba(220,38,38,1)]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                        </path>
                    </svg>
                    Certificados
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-white/10 space-y-2 shrink-0 bg-[#0f0c13]/50 backdrop-blur-md"
            style="font-family: 'Inter', sans-serif;">
            <a href="{{ route('public.oferta') }}" target="_blank"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-white/5 hover:text-white transition-all duration-300 font-space">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                ir Cursos
            </a>

            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-red-600/10 text-red-500 hover:bg-red-600 hover:text-white border border-red-600/20 hover:border-red-500 transition-all duration-300 font-space shadow-[0_0_10px_rgba(220,38,38,0.1)] hover:shadow-[0_0_20px_rgba(220,38,38,0.4)]">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 h-screen overflow-y-auto relative">
        <div
            class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-red-900/20 rounded-full blur-[120px] pointer-events-none z-0">
        </div>
        <div
            class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-purple-900/10 rounded-full blur-[100px] pointer-events-none z-0">
        </div>

        <div class="container mx-auto p-8 relative z-10 animate-[fadeIn_0.5s_ease-in-out]">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('js/admin-editor.js') }}"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo - UT</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/admin-login.js') }}"></script>
</head>

<body class="bg-[#09070f] min-h-screen flex items-center justify-center p-4 sm:p-8 relative overflow-hidden font-sans">

    <div
        class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-red-900/10 rounded-full blur-[120px] pointer-events-none z-0">
    </div>
    <div
        class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-900/10 rounded-full blur-[100px] pointer-events-none z-0">
    </div>

    <div
        class="w-full max-w-5xl bg-gradient-to-br from-[#16111a] to-[#0f0c13] rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 relative overflow-hidden flex flex-col md:flex-row z-10 animate-fadeInUp">

        <div
            class="absolute top-10 left-10 w-64 h-16 border-2 border-purple-500/10 rounded-full -rotate-45 pointer-events-none hidden md:block">
        </div>
        <div
            class="absolute bottom-20 right-1/2 w-80 h-20 bg-gradient-to-r from-red-600/5 to-transparent rounded-full rotate-12 blur-xl pointer-events-none hidden md:block">
        </div>
        <div
            class="absolute top-1/3 left-1/4 w-32 h-32 border border-white/5 rounded-full pointer-events-none hidden md:block">
        </div>

        <div class="w-full md:w-1/2 p-10 md:p-16 flex flex-col justify-center relative z-20">

            <div class="mb-10">
                <img src="{{ asset('images/logo-NSLG-blc_.png') }}" alt="Universidad del Tolima"
                    class="h-16 w-auto object-contain drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">
            </div>

            <h1 class="text-4xl md:text-5xl font-bold text-white font-space tracking-tight mb-4">
                ¡Bienvenido!
            </h1>

            <div class="w-12 h-1 bg-gradient-to-r from-red-500 to-red-800 rounded-full mb-6"></div>

            <p class="text-gray-400 text-sm font-light leading-relaxed mb-10 max-w-sm">
                Ingresa al panel de control de Educación Continuada para gestionar cursos, inscripciones, certificados y
                todo el contenido de la plataforma.
            </p>

            <div>
                <a href="{{ route('public.oferta') }}"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 text-white text-xs font-space uppercase tracking-wider transition-all duration-300 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform text-red-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a la Oferta
                </a>
            </div>
        </div>

        <div
            class="w-full md:w-1/2 p-6 md:p-12 flex items-center justify-center relative z-20 bg-black/20 md:bg-transparent">

            <div
                class="w-full max-w-sm bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-10 shadow-[0_8px_32px_rgba(0,0,0,0.3)] relative overflow-hidden">

                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-red-500/10 rounded-full blur-[40px] pointer-events-none">
                </div>

                <h2 class="text-2xl font-bold text-white font-space text-center mb-8">
                    Iniciar Sesión
                </h2>

                <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label
                            class="block text-[11px] font-bold text-gray-400 mb-1.5 uppercase tracking-widest font-space">
                            Correo Institucional
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full bg-black/40 border border-white/10 text-white px-4 py-3 rounded-xl focus:border-red-500 focus:bg-[#140f1a] focus:ring-1 focus:ring-red-500/30 outline-none transition-all placeholder-gray-600 text-sm shadow-inner"
                            placeholder="usuario@ut.edu.co">

                        @error('email')
                        <p class="text-red-400 text-xs mt-1.5 font-bold flex items-center gap-1 font-space">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label
                            class="block text-[11px] font-bold text-gray-400 mb-1.5 uppercase tracking-widest font-space">
                            Contraseña
                        </label>
                        <input type="password" name="password" required
                            class="w-full bg-black/40 border border-white/10 text-white px-4 py-3 rounded-xl focus:border-red-500 focus:bg-[#140f1a] focus:ring-1 focus:ring-red-500/30 outline-none transition-all placeholder-gray-600 text-sm shadow-inner"
                            placeholder="••••••••••••">
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-red-600 to-red-800 hover:from-red-500 hover:to-red-700 text-white font-space font-bold py-3.5 rounded-full shadow-[0_4px_15px_rgba(220,38,38,0.3)] transition-all duration-300 transform hover:-translate-y-0.5 mt-4 text-sm uppercase tracking-wider border border-red-500/50">
                        Ingresar
                    </button>

                </form>
            </div>

        </div>

    </div>

</body>

</html>
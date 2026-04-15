<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo - UT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border-t-4 border-red-800">

        <div class="text-center mb-8">
            <div
                class="w-16 h-16 bg-red-800 text-white font-black text-2xl flex items-center justify-center rounded-lg mx-auto mb-4 shadow-lg">
                UT
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Panel Administrativo</h2>
            <p class="text-gray-500 text-sm">Ingresa tus credenciales seguras</p>
        </div>

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Correo Institucional</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-red-800 focus:ring-2 focus:ring-red-200 outline-none transition"
                    placeholder="usuario@ut.edu.co">
                @error('email')
                <p class="text-red-600 text-xs mt-1 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-red-800 focus:ring-2 focus:ring-red-200 outline-none transition"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-red-800 hover:bg-red-900 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
                Ingresar al Sistema
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('public.oferta') }}" class="text-sm text-gray-400 hover:text-red-800 transition">
                ← Volver a la Oferta Académica
            </a>
        </div>
    </div>

</body>

</html>
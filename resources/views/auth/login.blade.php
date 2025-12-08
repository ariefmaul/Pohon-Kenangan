<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Login | Kebun Opah' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gradient-to-br from-green-100 to-green-300 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <!-- Logo / Judul -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-green-700">Kebun Opah</h1>
            <p class="text-sm text-gray-500 mt-1">Silakan login untuk melanjutkan</p>
        </div>

        <!-- Error Message -->
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 text-red-600 p-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="email@example.com"
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <input id="password" type="password" name="password" required placeholder="••••••••"
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                    <span>Ingat saya</span>
                </label>

                <a href="#" class="text-green-700 hover:underline">
                    Lupa password?
                </a>
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-xl transition duration-300 shadow-md">
                Login
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-6 text-center text-xs text-gray-400">
            © {{ date('Y') }} Kebun Opah. All rights reserved.
        </div>
    </div>

</body>

</html>

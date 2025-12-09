<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kebun SMKN 2 Tasikmalaya' }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- ✅ Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')
    <style>
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideUp 0.25s ease-out;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 antialiased">

    {{-- ================= NAVBAR ================= --}}
    <nav class="bg-white/90 backdrop-blur shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-green-700 font-extrabold text-lg">
                    <img src="{{ asset('favicon.ico') }}" alt="Logo Kebun Opah" class="h-8 w-8">
                </a>

                <!-- Menu -->
                <div class="flex items-center gap-6 text-sm font-medium">

                    <a href="{{ url('/trees') }}"
                        class="hover:text-green-600 transition {{ Request::is('trees') ? 'text-green-700' : '' }}">
                        Jenis Pohon
                    </a>
                    <a href="{{ url('/members') }}"
                        class="hover:text-green-600 transition {{ Request::is('members') ? 'text-green-700' : '' }}">
                        Anggota
                    </a>
                    <a href="{{ url('/sejarah') }}"
                        class="hover:text-green-600 transition {{ Request::is('sejarah') ? 'text-green-700' : '' }}">
                        Sejarah
                    </a>

                    @auth
                        @if (auth()->user()->role === 'admin')
                            <span class="border-l h-5 mx-2"></span>
                            <a href="{{ url('/admin/trees') }}"
                                class="hover:text-green-600 transition {{ Request::is('admin/trees') ? 'text-green-700' : '' }}">
                                Kelola Pohon
                            </a>

                            <a href="{{ url('/admin/members') }}"
                                class="hover:text-green-600 transition {{ Request::is('admin/members') ? 'text-green-700' : '' }}">
                                Kelola Anggota
                            </a>
                            <a href="{{ url('/admin/qrcode') }}"
                                class="hover:text-green-600 transition {{ Request::is('admin/qrcode') ? 'text-green-700' : '' }}">
                                QR Code
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-green-600 text-white px-4 py-1.5 rounded-full hover:bg-green-700 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-green-600 text-white px-4 py-1.5 rounded-full hover:bg-green-700 transition">
                            Login
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    {{-- ================= CONTENT ================= --}}
    <main class="py-10 min-h-[70vh]">
        <div class="max-w-7xl mx-auto px-4">
            @yield('content')
        </div>
    </main>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-gradient-to-r from-green-700 to-green-600 text-white">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm">
            <p class="font-semibold">🌿 Kebun SMKN2TSM</p>
            <p class="opacity-80 mt-1">
                &copy; {{ date('Y') }} Kebun SMKN2TSM. Semua Hak Dilindungi.
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}"
            });
        </script>
    @endif

    @stack('scripts')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: `
                <ul style="text-align:left">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            });
        </script>
    @endif

</body>

</html>

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
    <style>
        /* Fade-in animasi */
        .fade-in {
            opacity: 0;
            animation: fadeIn 1.2s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Card hover animasi */
        .card-hover {
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 35px rgba(0, 0, 0, .15);
        }

        /* Efek daun melayang */
        .leaf {
            position: absolute;
            width: 18px;
            height: 18px;
            background: #9dbb6a;
            border-radius: 3px 50% 50% 50%;
            opacity: .3;
            animation: floatLeaf 6s infinite ease-in-out;
        }

        @keyframes floatLeaf {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-25px) rotate(25deg);
            }

            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        /* PARALLAX */
        .parallax-modern {
            position: relative;
            height: 380px;
            overflow: hidden;
        }

        .parallax-modern img {
            width: 100%;
            height: 100%;
            /* object-fit: cover; */
            transform: translateY(0);
            transition: transform 0.15s ease-out;
            will-change: transform;
        }

        /* SCROLL ANIMATION */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* CARD HOVER */
        .card-hover {
            transition: transform .2s, box-shadow .2s;
        }

        .card-hover:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.15);
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
                <img src="{{ asset('favicon.ico') }}" class="h-8 w-8">
                <span class="sm:block">Kebun SMKN2TSM</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-6 text-sm font-medium">

                <a href="{{ url('/trees') }}"
                    class="{{ Request::is('trees') ? 'text-green-700' : '' }} hover:text-green-600">
                    Semua Pohon
                </a>

                <a href="{{ url('/members') }}"
                    class="{{ Request::is('members') ? 'text-green-700' : '' }} hover:text-green-600">
                    Anggota
                </a>

                <a href="{{ url('/sejarah') }}"
                    class="{{ Request::is('sejarah') ? 'text-green-700' : '' }} hover:text-green-600">
                    Sejarah
                </a>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <span class="border-l h-5"></span>

                        <a href="{{ url('/admin/trees') }}" class="hover:text-green-600">
                            Kelola Pohon
                        </a>

                        <a href="{{ url('/admin/members') }}" class="hover:text-green-600">
                            Kelola Anggota
                        </a>

                        <a href="{{ url('/admin/qrcode') }}" class="hover:text-green-600">
                            QR Code
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="bg-green-600 text-white px-4 py-1.5 rounded-full hover:bg-green-700">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-green-600 text-white px-4 py-1.5 rounded-full hover:bg-green-700">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Mobile Button -->
            <button id="menuBtn" class="md:hidden text-green-700 focus:outline-none">
                ☰
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
        <div class="px-4 py-4 space-y-3 text-sm">

            <a href="{{ url('/trees') }}" class="block">Semua Pohon</a>
            <a href="{{ url('/members') }}" class="block">Anggota</a>
            <a href="{{ url('/sejarah') }}" class="block">Sejarah</a>

            @auth
                @if (auth()->user()->role === 'admin')
                    <hr>
                    <a href="{{ url('/admin/trees') }}" class="block">Kelola Pohon</a>
                    <a href="{{ url('/admin/members') }}" class="block">Kelola Anggota</a>
                    <a href="{{ url('/admin/qrcode') }}" class="block">QR Code</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left text-red-600">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block bg-green-600 text-white text-center py-2 rounded">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>


    {{-- ================= CONTENT ================= --}}
    <main class="py-10 min-h-[70vh]">
        <div class="max-w-7xl mx-auto px-4">
            @yield('content')
        </div>
    </main>
<div id="loading"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-[9999]">
    <div class="bg-white px-6 py-4 rounded-lg shadow text-center">
        <div class="animate-spin rounded-full h-10 w-10 border-4 border-green-600 border-t-transparent mx-auto"></div>
        <p class="mt-3 text-sm font-semibold text-gray-700">Memproses...</p>
    </div>
</div>

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
    <script>
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', () => {
            document.getElementById('loading').classList.remove('hidden');
            document.getElementById('loading').classList.add('flex');
        });
    });
</script>

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
    <script>
        document.addEventListener("scroll", () => {
            const img = document.querySelector(".parallax-modern img");
            if (img) {
                img.style.transform = `translateY(${window.scrollY * 0.20}px)`;
            }

            document.querySelectorAll('.reveal').forEach(el => {
                const top = el.getBoundingClientRect().top;
                if (top < window.innerHeight - 80) {
                    el.classList.add('visible');
                }
            });
        });
    </script>
<script>
    document.getElementById('menuBtn').addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });
</script>

</body>

</html>

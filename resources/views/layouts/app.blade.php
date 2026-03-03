<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kebun ANTARES' }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


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
    <style>
        /* desktop and mobile nav styling now use Tailwind utility classes; custom CSS removed */
    </style>

</head>

<body class="bg-gray-100 text-gray-800 antialiased">

    {{-- ================= NAVBAR ================= --}}
    <nav class="bg-white/90 backdrop-blur shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-green-700 font-extrabold text-lg">
                    <img src="{{ asset('favicon.ico') }}" class="h-8 w-8">
                    <span>Kebun ANTARES</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-6 text-sm font-medium">

                    @if (request()->routeIs('home'))
                        <a href="#home"
                            class="nav-link relative pb-1 transition-colors duration-300 text-gray-700 hover:text-green-600 group">
                            Home
                            <span
                                class="absolute left-0 bottom-0 h-0.5 w-0 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="#tentang_angkatan"
                            class="nav-link relative pb-1 transition-colors duration-300 text-gray-700 hover:text-green-600 group">
                            Tentang
                            <span
                                class="absolute left-0 bottom-0 h-0.5 w-0 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="#galeri_angkatan"
                            class="nav-link relative pb-1 transition-colors duration-300 text-gray-700 hover:text-green-600 group">
                            Galeri
                            <span
                                class="absolute left-0 bottom-0 h-0.5 w-0 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="#video_angkatan"
                            class="nav-link relative pb-1 transition-colors duration-300 text-gray-700 hover:text-green-600 group">
                            Video
                            <span
                                class="absolute left-0 bottom-0 h-0.5 w-0 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                        </a>


                        <a href="{{ route('pohon') }}"
                            class="bg-green-600 text-white px-4 py-1.5 rounded-full hover:bg-green-700 transition">
                            🌳 Semua Pohon →
                        </a>
                    @elseif(request()->routeIs('pohon'))
                        <a href="{{ route('home') }}"
                            class="bg-green-600 text-white px-4 py-1.5 rounded-full hover:bg-green-700 transition">
                            ← 🏠 Kembali
                        </a>
                    @else
                        <a href="{{ route('kelas.siswa', request()->route('id')) }}"
                            class="nav-link relative pb-1 transition-colors duration-300 text-gray-700 hover:text-green-600 group">
                            Siswa
                            <span
                                class="absolute left-0 bottom-0 h-0.5 w-0 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="{{ route('kelas.moments', request()->route('id')) }}"
                            class="nav-link relative pb-1 transition-colors duration-300 text-gray-700 hover:text-green-600 group">
                            Gambar
                            <span
                                class="absolute left-0 bottom-0 h-0.5 w-0 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="{{ route('pohon') }}"
                            class="bg-green-600 text-white px-4 py-1.5 rounded-full hover:bg-green-700 transition">
                            ← 🌳 Kembali
                        </a>
                    @endif

                    <span class="border-l h-5"></span>

                    @auth
                        @if (auth()->user()->role === 'admin')
                            <span class="border-l h-5"></span>

                            <a href="{{ url('/admin/trees') }}" class="hover:text-green-600">
                                Tentang Angkatan
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
                            <button class="bg-green-600 text-white px-4 py-1.5 rounded-full hover:bg-green-700">
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
                <button id="menuBtn" class="md:hidden text-green-700 text-2xl">
                    ☰
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="hidden md:hidden bg-white border-t shadow-sm">
            <div class="px-4 py-4 space-y-2 text-sm">

                @if (request()->routeIs('home'))
                    <a href="#home"
                        class="mobile-link nav-link block px-3 py-3 rounded-lg transition-colors duration-200 text-gray-700 hover:bg-green-100">
                        Home
                    </a>
                    <a href="#tentang_angkatan"
                        class="mobile-link nav-link block px-3 py-3 rounded-lg transition-colors duration-200 text-gray-700 hover:bg-green-100">
                        Tentang
                    </a>
                    <a href="#galeri_angkatan"
                        class="mobile-link nav-link block px-3 py-3 rounded-lg transition-colors duration-200 text-gray-700 hover:bg-green-100">
                        Galeri
                    </a>
                    <a href="#video_angkatan"
                        class="mobile-link nav-link block px-3 py-3 rounded-lg transition-colors duration-200 text-gray-700 hover:bg-green-100">
                        Video
                    </a>

                    <div class="pt-3">
                        <a href="{{ route('pohon') }}"
                            class="block bg-green-600 text-white text-center py-2 rounded-lg hover:bg-green-700 transition">
                            🌳 Semua Pohon →
                        </a>
                    </div>
                @elseif(request()->routeIs('pohon'))
                    <a href="{{ route('home') }}" class="block bg-green-600 text-white text-center py-2 rounded-lg">
                        ← 🏠 Kembali
                    </a>
                @else
                        <a href="{{ route('kelas.siswa', request()->route('id')) }}"
                            class="mobile-link nav-link block px-3 py-3 rounded-lg transition-colors duration-200 text-gray-700 hover:bg-green-100">
                            Siswa
                        </a>
                        <a href="{{ route('kelas.moments', request()->route('id')) }}"
                            class="mobile-link nav-link block px-3 py-3 rounded-lg transition-colors duration-200 text-gray-700 hover:bg-green-100">
                            Gambar
                        </a>
                    <a href="{{ route('pohon') }}"
                        class="block bg-green-600 text-white text-center py-2 rounded-lg hover:bg-green-700 transition">
                        ← 🌳 Semua Pohon
                    </a>
                @endif

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
                    <a href="{{ route('login') }}" class="block bg-green-600 text-white text-center py-2 rounded">
                        Login
                    </a>
                @endauth


            </div>
        </div>
    </nav>


    {{-- ================= CONTENT ================= --}}
    <main class="">
        <div class="">
            @yield('content')
        </div>
    </main>
    <div id="loading" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-[9999]">
        <div class="bg-white px-6 py-4 rounded-lg shadow text-center">
            <div class="animate-spin rounded-full h-10 w-10 border-4 border-green-600 border-t-transparent mx-auto">
            </div>
            <p class="mt-3 text-sm font-semibold text-gray-700">Memproses...</p>
        </div>
    </div>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-gradient-to-r from-green-700 to-green-600 text-white">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm">
            <p class="font-semibold">🌿 ANTARES STM</p>
            <p class="opacity-80 mt-1">
                &copy; {{ date('Y') }} Kebun ANTARES. Semua Hak Dilindungi.
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
        function revealOnScroll() {
            document.querySelectorAll('.reveal').forEach(el => {
                const top = el.getBoundingClientRect().top;
                if (top < window.innerHeight - 80) {
                    el.classList.add('visible');
                }
            });
        }

        /* Jalan saat load */
        window.addEventListener("load", revealOnScroll);

        /* Jalan saat scroll */
        window.addEventListener("scroll", revealOnScroll);
    </script>
    <script>
        const sections = document.querySelectorAll("section[id]");
        const navLinks = document.querySelectorAll(".nav-link");

        function setActiveLink() {

            let current = "home"; // default pertama

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 160;
                const sectionHeight = section.offsetHeight;

                if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
                    current = section.getAttribute("id");
                }
            });

            navLinks.forEach(link => {
                // clear previous styles
                link.classList.remove("text-green-600", "font-semibold", "bg-green-100");
                const underline = link.querySelector('span');
                if (underline) underline.classList.remove('w-full');

                if (link.getAttribute("href") === "#" + current) {
                    link.classList.add("text-green-600", "font-semibold");
                    if (underline) underline.classList.add('w-full');
                    if (link.classList.contains('mobile-link')) {
                        link.classList.add('bg-green-100');
                    }
                }
            });
        }

        window.addEventListener("scroll", setActiveLink);
        window.addEventListener("load", setActiveLink);
    </script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script>
        /* ================= MOBILE MENU TOGGLE ================= */
        const menuBtn = document.getElementById("menuBtn");
        const mobileMenu = document.getElementById("mobileMenu");

        menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        /* Tutup menu setelah klik link */
        document.querySelectorAll("#mobileMenu a").forEach(link => {
            link.addEventListener("click", () => {
                mobileMenu.classList.add("hidden");
            });
        });

        /* ================= SMOOTH SCROLL ================= */
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();

                const target = document.querySelector(this.getAttribute("href"));

                if (target) {
                    target.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                }
            });
        });
    </script>
    

</body>

</html>

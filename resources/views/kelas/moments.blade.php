@extends('layouts.app')

@section('content')

    <!-- ================= HERO CINEMATIC ================= -->
    <section class="relative h-[85vh] flex items-center justify-center overflow-hidden bg-black">

        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . ($kelas->moment_bg ?? 'default-bg.jpg')) }}"
                class="w-full h-full object-cover opacity-40 scale-110 animate-slowZoom">

            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black"></div>
        </div>

        <div class="relative text-center text-white z-10 px-6">

            <h1 class="text-4xl md:text-6xl font-bold tracking-wide drop-shadow-xl animate-fadeUp">
                🌳 Pohon Kenangan
            </h1>

            <p class="mt-4 text-lg text-gray-200 animate-fadeUp delay-200">
                {{ $kelas->nama_kelas }}
            </p>

        </div>

    </section>



    <!-- ================= GRID MOMENT ================= -->
    <section class="max-w-7xl mx-auto px-6 py-16">

        <h2 class="text-2xl font-bold mb-12 text-center text-gray-800">
            📸 Galeri Kenangan
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($moments as $moment)

                    <div class="group relative cursor-pointer reveal" onclick="openModal(
                    '{{ asset('storage/' . $moment->nama_gambar) }}',
                    '{{ $moment->judul }}',
                    `{{ $moment->deskripsi }}`
                )">

                        <div class="overflow-hidden rounded-2xl shadow-xl">

                            <img src="{{ asset('storage/' . $moment->nama_gambar) }}"
                                class="w-full h-48 md:h-60 object-cover group-hover:scale-110 transition duration-700">

                        </div>

                        <!-- OVERLAY HANYA DESKTOP -->
                        <div
                            class="absolute inset-0 bg-black/60 opacity-0 md:group-hover:opacity-100 transition hidden md:flex items-end p-4 rounded-2xl">

                            <div class="text-white">

                                <div class="font-semibold text-lg">
                                    {{ $moment->judul }}
                                </div>

                                <div class="text-sm text-gray-300 line-clamp-2">
                                    {{ $moment->deskripsi }}
                                </div>

                            </div>

                        </div>

                        <!-- TEXT UNTUK MOBILE -->
                        <div class="md:hidden mt-2">

                            <div class="font-semibold text-sm text-gray-800">
                                {{ $moment->judul }}
                            </div>

                            <div class="text-xs text-gray-500 line-clamp-2">
                                {{ $moment->deskripsi }}
                            </div>

                        </div>

                    </div>

            @endforeach

        </div>

    </section>



    <!-- ================= MODAL ================= -->
    <div id="momentModal" class="fixed inset-0 bg-black/90 hidden items-center justify-center z-50 p-6">

        <div class="max-w-5xl w-full relative">

            <button onclick="closeModal()" class="absolute -top-8 right-0 text-white text-3xl">
                ✕
            </button>

            <img id="modalImage" class="w-full max-h-[70vh] object-contain rounded-xl shadow-2xl">

            <div class="mt-6 text-center text-white">

                <h3 id="modalJudul" class="text-2xl font-bold">
                </h3>

                <p id="modalDeskripsi" class="text-gray-300 mt-2 max-w-2xl mx-auto">
                </p>

            </div>

        </div>

    </div>



    <!-- ================= SCRIPT ================= -->
    <script>

        function openModal(img, judul, deskripsi) {

            const modal = document.getElementById('momentModal')

            modal.classList.remove('hidden')
            modal.classList.add('flex')

            document.getElementById('modalImage').src = img
            document.getElementById('modalJudul').innerText = judul
            document.getElementById('modalDeskripsi').innerText = deskripsi
        }

        function closeModal() {

            const modal = document.getElementById('momentModal')

            modal.classList.add('hidden')
            modal.classList.remove('flex')
        }

        document.getElementById('momentModal').addEventListener('click', function (e) {

            if (e.target.id === 'momentModal') {
                closeModal()
            }

        })

        document.addEventListener('keydown', function (e) {

            if (e.key === "Escape") {
                closeModal()
            }

        })

    </script>



    <!-- ================= STYLE ================= -->
    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .animate-fadeUp {
            animation: fadeUp 1s ease forwards
        }

        .animate-fadeUp.delay-200 {
            animation-delay: .2s
        }

        @keyframes slowZoom {
            from {
                transform: scale(1.05)
            }

            to {
                transform: scale(1.15)
            }
        }

        .animate-slowZoom {
            animation: slowZoom 20s linear infinite alternate
        }

        .reveal {
            opacity: 0;
            transform: translateY(60px);
            transition: all .8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

@endsection
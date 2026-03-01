@extends('layouts.app')

@section('content')

{{-- ================= HERO ================= --}}
<section id="home" class="min-h-screen flex items-center bg-gray-100 scroll">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            <!-- TEXT -->
            <div class="reveal">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight">
                    Website Kenangan
                    <span class="text-indigo-600">ANTARES</span>
                    2026
                </h1>

                <p class="mt-6 text-lg text-gray-600">
                    Tempat menyimpan cerita, tawa, dan perjuangan
                    angkatan ANTARES 2026.
                </p>

                <div class="mt-8">
                    <a href="{{ url('/pohon') }}"
                        class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300">
                        🌳 Lihat semua kelas (pohon) →
                    </a>
                </div>
            </div>

            <!-- IMAGE -->
            <div class="flex justify-center reveal">
                <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c"
                    class="rounded-2xl shadow-2xl w-full max-w-lg object-cover">
            </div>

        </div>
    </div>
</section>


{{-- ================= TENTANG ================= --}}
<section id="tentang_angkatan" class="py-24 bg-gray-50 scroll">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-16 items-center">

            <div class="flex justify-center reveal">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1603415526960-f8f0b1c7f6c7"
                        class="w-72 h-72 object-cover rounded-3xl shadow-2xl">

                    <div
                        class="absolute -bottom-4 -right-4 bg-green-600 text-white px-4 py-2 rounded-xl shadow-lg text-sm font-semibold">
                        Ketua Pelaksana
                    </div>
                </div>
            </div>

            <div class="reveal">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                    Tentang Angkatan ANTARES 2026
                </h2>

                <blockquote
                    class="mt-8 text-lg text-gray-600 italic leading-relaxed border-l-4 border-green-600 pl-6">
                    “Perjalanan ini bukan hanya tentang akhir,
                    tetapi tentang setiap tawa, perjuangan,
                    dan kebersamaan yang kita lalui bersama.”
                </blockquote>

                <p class="mt-6 font-semibold text-green-700">
                    — Muhammad Amin, Ketua Pelaksana
                </p>
            </div>

        </div>
    </div>
</section>


{{-- ================= GALERI ================= --}}
<section id="galeri_angkatan" class="py-24 bg-white scroll">
    <div class="max-w-6xl mx-auto px-6 space-y-24">

        <!-- ITEM 1 -->
        <div class="grid md:grid-cols-2 gap-12 items-center reveal">
            <div>
                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac"
                    class="gallery-img rounded-2xl shadow-xl cursor-pointer hover:scale-105 transition duration-300">
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Momen Kebersamaan</h2>
                <p class="mt-4 text-gray-600">
                    Kenangan indah saat kita berkumpul bersama sebagai satu angkatan.
                </p>
            </div>
        </div>

        <!-- ITEM 2 -->
        <div class="grid md:grid-cols-2 gap-12 items-center reveal">
            <div class="md:order-2">
                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7"
                    class="gallery-img rounded-2xl shadow-xl cursor-pointer hover:scale-105 transition duration-300">
            </div>
            <div class="md:order-1">
                <h2 class="text-3xl font-bold text-gray-800">Perjalanan Belajar</h2>
                <p class="mt-4 text-gray-600">
                    Hari-hari penuh semangat dalam belajar dan berkembang bersama.
                </p>
            </div>
        </div>

        <!-- ITEM 3 -->
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c"
                        class="gallery-img rounded-2xl shadow-xl cursor-pointer hover:scale-105 transition duration-300"
                        alt="Kenangan 3">
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Kenangan Terakhir</h2>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Sebuah penutup perjalanan yang penuh makna. Angkatan ANTARES
                        akan selalu menjadi bagian dari cerita hidup kita.
                    </p>
                </div>
            </div>

    </div>
</section>


{{-- ================= VIDEO ================= --}}
<section id="video_angkatan"
    class="py-24 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 text-white scroll">

    <div class="max-w-6xl mx-auto px-6 text-center reveal">

        <h2 class="text-3xl md:text-4xl font-bold">
            Instagram ANTARES 2026
        </h2>

        <p class="mt-4 max-w-2xl mx-auto text-white/90">
            Lihat momen terbaik angkatan melalui Instagram resmi.
        </p>

        <div class="mt-12 flex justify-center">
            <iframe
                class="rounded-xl shadow-2xl w-full max-w-xl h-[500px]"
                src="https://www.instagram.com/reel/DVSe5_0Eezd/embed"
                allowfullscreen>
            </iframe>
        </div>

    </div>
</section>


{{-- ================= LIGHTBOX ================= --}}
<div id="lightbox"
    class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[9999]">
    <img id="lightbox-img"
        class="max-w-[90%] max-h-[90%] rounded-xl shadow-2xl cursor-pointer">
</div>

@endsection


@push('scripts')
<script>
/* ================= LIGHTBOX ================= */
const galleryImages = document.querySelectorAll('.gallery-img');
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');

galleryImages.forEach(img => {
    img.addEventListener('click', () => {
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        lightboxImg.src = img.src;
    });
});

lightbox.addEventListener('click', () => {
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
});

/* ================= REVEAL ANIMATION ================= */
window.addEventListener("scroll", () => {
    document.querySelectorAll('.reveal').forEach(el => {
        const top = el.getBoundingClientRect().top;
        if (top < window.innerHeight - 80) {
            el.classList.add('visible');
        }
    });
});
</script>
@endpush
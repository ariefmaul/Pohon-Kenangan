@extends('layouts.app')

@section('content')

<!-- ================= HERO ================= -->
<section class="relative h-[80vh] flex items-center justify-center bg-black overflow-hidden">

    <div class="absolute inset-0">
        <img src="{{ asset('storage/moment/'.$moments->first()?->nama_gambar) }}"
             class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <div class="relative z-10 text-center text-white px-6">
        <h1 class="text-5xl md:text-7xl font-bold tracking-wide mb-6">
            🌳 Pohon Kenangan
        </h1>
        <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto">
            {{ $kelas->nama_kelas }}
        </p>
    </div>
</section>


<!-- ================= TREE TIMELINE ================= -->
<section class="relative bg-gradient-to-b from-black to-gray-900 py-24 px-4 md:px-6">

    <div class="max-w-6xl mx-auto relative">

        <!-- BACKGROUND POHON -->
        <img src="{{ asset('moment/tree.png') }}"
             class="absolute inset-0 w-full h-full object-cover opacity-10 pointer-events-none">

        <!-- BATANG POHON -->
        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-2 bg-green-600 h-full rounded-full"></div>

        <div class="space-y-20 relative z-10 p-10">

            @foreach($moments as $index => $moment)

                @php
                    $isLeft = $index % 2 === 0;
                @endphp

                <div class="flex flex-col md:flex-row items-center relative">

                    @if($isLeft)

                        <!-- TEXT KIRIddddd -->
                        <div class="md:w-1/2 md:pr-16 text-right text-white">
                            <h3 class="text-2xl font-semibold mb-3">
                                {{ $moment->judul }}
                            </h3>
                            <p class="text-gray-400">
                                {{ $moment->deskripsi }}
                            </p>
                        </div>

                        <!-- BULATAN -->
                        <div class="hidden md:block w-10 h-10 bg-green-500 rounded-full border-4 border-black relative z-10"></div>

                        <!-- GAMBAR KANAN -->
                        <div class="md:w-1/2 mt-6 md:mt-0 md:pl-16">
                            <img src="{{ asset('storage/moment/'.$moment->nama_gambar) }}"
                                 class="rounded-3xl shadow-2xl hover:scale-105 transition duration-500 w-full md:h-80 object-cover">
                        </div>

                    @else

                        <!-- GAMBAR KIRI -->
                        <div class="md:w-1/2 order-2 md:order-1 mt-6 md:mt-0 md:pr-16">
                            <img src="{{ asset('storage/moment/'.$moment->nama_gambar) }}"
                                 class="rounded-3xl shadow-2xl hover:scale-105 transition duration-500 w-full md:h-80 object-cover">
                        </div>

                        <!-- BULATAN -->
                        <div class="hidden md:block w-10 h-10 bg-green-500 rounded-full border-4 border-black relative z-10"></div>

                        <!-- TEXT KANAN -->
                        <div class="md:w-1/2 md:pl-16 text-left text-white order-1 md:order-2">
                            <h3 class="text-2xl font-semibold mb-3">
                                {{ $moment->judul }}
                            </h3>
                            <p class="text-gray-400">
                                {{ $moment->deskripsi }}
                            </p>
                        </div>

                    @endif

                </div>

            @endforeach

        </div>
    </div>
</section>


<!-- ================= PENUTUP ================= -->
<section class="py-20 bg-black text-center text-white px-6">
    <h2 class="text-4xl font-bold mb-6">
        🌳 Pohon Ini Akan Terus Tumbuh
    </h2>
    <p class="text-gray-400 max-w-3xl mx-auto text-lg">
        Walaupun waktu berlalu,
        akar kenangan kita akan selalu tertanam kuat.
    </p>
</section>

@endsection
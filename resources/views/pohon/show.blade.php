@extends('layouts.app')

@section('content')
    {{-- HERO PARALLAX MODERN --}}
    <div class="parallax-modern relative">
        <img src="{{ asset('storage/' . $tree->gambar) }}">

        {{-- Gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/40 to-black/60"></div>

        {{-- Nama pohon --}}
        <div class="absolute bottom-10 left-10 reveal">
            <div
                class="backdrop-blur-lg bg-white/20 text-white px-8 py-4 rounded-2xl shadow-xl text-4xl font-extrabold tracking-wide">
                {{ strtoupper($tree->nama_pohon) }}
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="bg-gray-100 pb-20 pt-12">

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- TAKSONOMI CARD --}}
            <div class="bg-white rounded-2xl p-6 shadow-md border reveal card-hover">
                <h2 class="text-xl font-bold text-gray-700 mb-4 border-b pb-2 flex items-center gap-2">
                    <span class="text-green-600">📘</span> Taksonomi
                </h2>

                <ul class="text-gray-700 space-y-3">
                    <li><strong>Ordo:</strong> {{ $tree->ordo ?? '-' }}</li>
                    <li><strong>Famili:</strong> {{ $tree->famili ?? '-' }}</li>
                    <li><strong>Genus:</strong> {{ $tree->genus ?? '-' }}</li>
                    <li><strong>Spesies:</strong> {{ $tree->spesies ?? '-' }}</li>
                </ul>
            </div>

            {{-- DESKRIPSI --}}
            <div class="md:col-span-2 bg-white rounded-2xl p-8 shadow-md border reveal card-hover">
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Deskripsi</h3>
                <div class="text-gray-700 leading-relaxed">
                    {!! nl2br(e($tree->deskripsi)) !!}
                </div>

                @if ($tree->manfaat)
                    <div class="mt-6 pt-4 border-t">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Manfaat</h3>
                        <div class="text-gray-700">
                            {!! nl2br(e($tree->manfaat)) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- FOTO LOKASI --}}
        @if ($tree->foto_lokasi)
            <div class="max-w-6xl mx-auto mt-12 px-4 reveal">
                <img src="{{ asset('storage/' . $tree->foto_lokasi) }}"
                    class="rounded-3xl shadow-xl w-full object-cover card-hover">
            </div>
        @endif

    </div>
@endsection

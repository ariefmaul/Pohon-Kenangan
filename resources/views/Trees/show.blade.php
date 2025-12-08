@extends('layouts.app')

@section('content')
    {{-- HERO --}}
    <div class="relative">
        <img src="{{ asset('storage/' . $tree->gambar) }}" class="w-full h-[380px] object-cover">

        <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/40 to-black/50">

            {{-- Nama Pohon --}}
            <div class="absolute top-6 right-6">
                <div
                    class="bg-[#8fa96b]/90 backdrop-blur
                    text-white px-6 py-3 rounded-xl
                    text-xl md:text-2xl font-semibold shadow-lg">
                    {{ strtoupper($tree->nama_pohon) }}
                </div>
            </div>

        </div>
    </div>

    {{-- CONTENT --}}
    <div class="bg-[#7c8f57] pb-16">
        <div
            class="max-w-6xl mx-auto -mt-24 relative z-10
            bg-[#e7efd6] p-8 rounded-3xl shadow-xl
            grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- TAKSONOMI --}}
            <div class="bg-white/60 rounded-2xl p-6 border border-[#cbd8b2]">
                <h2 class="text-xl font-bold text-[#4b5e2d] mb-4 uppercase">
                    Taksonomi
                </h2>

                <ul class="space-y-3 text-sm text-[#2f3c1f]">
                    <li><strong>Ordo</strong> : {{ $tree->ordo ?? '-' }}</li>
                    <li><strong>Famili</strong> : {{ $tree->famili ?? '-' }}</li>
                    <li><strong>Genus</strong> : {{ $tree->genus ?? '-' }}</li>
                    <li><strong>Spesies</strong> : {{ $tree->spesies ?? '-' }}</li>
                </ul>
            </div>

            {{-- DESKRIPSI --}}
            <div class="md:col-span-2 bg-white/70 rounded-2xl p-6 leading-relaxed text-justify">
                {!! nl2br(e($tree->deskripsi)) !!}

                @if ($tree->manfaat)
                    <div class="mt-6 pt-4 border-t border-[#c5d1ac]">
                        <h3 class="text-lg font-semibold text-[#4b5e2d] mb-2">
                            Manfaat
                        </h3>
                        {!! nl2br(e($tree->manfaat)) !!}
                    </div>
                @endif
            </div>

        </div>

        {{-- FOTO LAPANGAN --}}
        @if ($tree->foto_lokasi)
            <div class="max-w-6xl mx-auto mt-10 px-4">
                <img src="{{ asset('storage/' . $tree->foto_lokasi) }}"
                    class="rounded-3xl shadow-xl w-full border border-[#d0dbb7]">
            </div>
        @endif
    </div>
@endsection

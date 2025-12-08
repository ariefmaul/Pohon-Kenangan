@extends('layouts.app')

@section('content')
    <div class="bg-[#7c8f57] min-h-screen text-[#2f3c1f]">




        <!-- HERO IMAGE -->
        <!-- HERO IMAGE -->
        <div class="relative">
            <img src="{{ asset('storage/' . $tree->gambar) }}" class="w-full h-[360px] object-cover">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/30 to-black/40">

                <!-- Nama Pohon -->
                <div class="absolute top-6 right-6">
                    <div
                        class="bg-[#8fa96b]/90 backdrop-blur
                       text-white px-6 py-3
                       rounded-xl shadow-lg
                       text-xl md:text-2xl
                       font-semibold tracking-wide">
                        {{ strtoupper($tree->nama_pohon) }}
                    </div>
                </div>

            </div>
        </div>


        <!-- CONTENT -->
        <div
            class="max-w-6xl mx-auto -mt-20 relative z-10
                bg-[#e7efd6] p-8 rounded-3xl shadow-xl
                grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- TAKSONOMI -->
            <div class="bg-white/50 rounded-2xl p-6 border border-[#cbd8b2]">
                <h2 class="text-xl font-bold text-[#4b5e2d] mb-4 uppercase tracking-wide">
                    Taksonomi
                </h2>

                <ul class="space-y-3 text-sm">
                    <li><span class="font-semibold">Ordo</span> : {{ $tree->ordo ?? '-' }}</li>
                    <li><span class="font-semibold">Famili</span> : {{ $tree->famili ?? '-' }}</li>
                    <li><span class="font-semibold">Genus</span> : {{ $tree->genus ?? '-' }}</li>
                    <li><span class="font-semibold">Spesies</span> : {{ $tree->spesies ?? '-' }}</li>
                </ul>
            </div>

            <!-- DESKRIPSI -->
            <div
                class="md:col-span-2 bg-white/60 rounded-2xl p-6
                    leading-relaxed text-justify shadow-sm">
                {!! nl2br(e($tree->deskripsi)) !!}

                @if ($tree->manfaat)
                    <div class="mt-6 pt-5 border-t border-[#c5d1ac]">
                        <h3 class="font-semibold text-lg mb-2 text-[#4b5e2d]">
                            Manfaat
                        </h3>
                        {!! nl2br(e($tree->manfaat)) !!}
                    </div>
                @endif
            </div>

        </div>

        <!-- FOTO LAPANGAN -->
        @if ($tree->foto_lokasi)
            <div class="max-w-6xl mx-auto px-8 py-10">
                <img src="{{ asset('storage/' . $tree->foto_lokasi) }}"
                    class="rounded-3xl shadow-xl w-full border border-[#d0dbb7]">
            </div>
        @endif

    </div>
@endsection

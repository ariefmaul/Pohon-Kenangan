@extends('layouts.app')

@section('content')

{{-- HERO --}}
{{-- HERO SECTION --}}
<div class="relative rounded-3xl overflow-hidden mb-10 reveal">

    {{-- Background Image --}}
    <img src="{{ asset('utama.jpg') }}"
         class="w-full h-[420px] object-cover scale-105">

    {{-- Dark Overlay --}}
    <div class="absolute inset-0 bg-black/45"></div>

    {{-- Text Content --}}
    <div class="absolute inset-0 flex items-end">
        <div class="p-6 md:p-10 max-w-xl">
            <h1 class="text-white text-4xl md:text-5xl font-extrabold leading-tight drop-shadow-lg">
                Sejarah Satgas <br>
                Lingkungan Hidup
            </h1>
        </div>
    </div>

</div>


{{-- NARASI --}}
<div class="space-y-6 text-lg leading-relaxed reveal">
    <p>
        Satgas Lingkungan Hidup didirikan pada
        <span class="font-semibold text-green-700">1 Agustus 2024</span>
        sebagai bagian dari Program Kerja OSIS SMK Negeri 2 Tasikmalaya
        Periode 2024–2025 yang dipimpin oleh
        <span class="font-semibold">Arief Maulana Rizki</span>
        selaku Ketua OSIS.
    </p>

    <p>
        Setelah itu dibentuklah Satgas Lingkungan Hidup yang dipimpin oleh
        <span class="font-semibold">Muhammad Fikri Muafi</span>
        sebagai Ketua Satgas, dengan
        <span class="font-semibold">Marwah Khoerunnisa</span>
        sebagai Wakil Ketua dan
        <span class="font-semibold">M. Irsyad Mubarok</span>
        sebagai Sekretaris.
    </p>

    <p>
        Satgas kemudian menjalin kerja sama dengan para guru dan ditunjuk
        untuk bekerja bersama Tim Lingkungan Hidup sekolah yang dipimpin oleh
        <span class="font-semibold">Ibu Hj. Ade</span>.
        Kolaborasi ini membuat program kerja Satgas berjalan lebih terarah
        dan berkelanjutan.
    </p>

    <p>
        Dalam menjalankan kegiatannya, Satgas juga membentuk beberapa
        koordinator bidang agar setiap program dapat dijalankan secara fokus
        dan maksimal.
    </p>
</div>

{{-- DIVIDER --}}
<div class="my-14 border-t border-dashed border-gray-300"></div>

{{-- TOKOH --}}
<h2 class="text-3xl font-bold text-center mb-8 text-green-700 reveal">
    Tokoh Utama Satgas
</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 reveal">

    @php
        $tokoh = [
            ['img'=>'ade.jpg','nama'=>'Ibu Hj. Ade Sri Mutiara, S.Pd.','jabatan'=>'Ketua Tim Lingkungan Hidup Sekolah'],
            ['img'=>'ai.jpg','nama'=>'Ibu Ai Siti Hasanah, S.Pd.','jabatan'=>'Staf Tim Lingkungan Hidup'],
            ['img'=>'arief.jpg','nama'=>'Arief Maulana Rizki','jabatan'=>'Ketua OSIS 2024–2025'],
            ['img'=>'fikri.jpg','nama'=>'Muhammad Fikri Muafi','jabatan'=>'Ketua Satgas Lingkungan Hidup'],
            ['img'=>'marwah.jpg','nama'=>'Marwah Khoerunnisa','jabatan'=>'Wakil Ketua Satgas'],
            ['img'=>'irsyad.png','nama'=>'M. Irsyad Mubarok','jabatan'=>'Sekretaris Satgas'],
            ['img'=>'nadaa.jpeg','nama'=>'Nadaa Fitria Herwandi','jabatan'=>'Bendahara Satgas'],
        ];
    @endphp

    @foreach ($tokoh as $t)
        <div class="bg-white/70 backdrop-blur rounded-2xl overflow-hidden shadow card-hover">
            <img src="{{ asset($t['img']) }}" class="h-56 w-full object-cover">
            <div class="p-4 text-center">
                <h3 class="font-bold text-lg">{{ $t['nama'] }}</h3>
                <p class="text-gray-600">{{ $t['jabatan'] }}</p>
            </div>
        </div>
    @endforeach

</div>

{{-- DIVIDER --}}
<div class="my-14 border-t border-dashed border-gray-300"></div>

{{-- KOORDINATOR --}}
<h2 class="text-3xl font-bold text-center mb-8 text-green-700 reveal">
    Koordinator Program Kerja
</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 reveal">

    @php
        $koordinator = [
            ['img'=>'ibnu.jpg','nama'=>'Ibnu Fakih','jabatan'=>'Koordinator Penanggulangan Sampah'],
            ['img'=>'zaidan.jpeg','nama'=>'Zaidan Rizqulloh','jabatan'=>'Koordinator Lingkungan'],
            ['img'=>'alwi.jpg','nama'=>'M. Alwi Alfarizi','jabatan'=>'Koordinator Wirausaha'],
        ];
    @endphp

    @foreach ($koordinator as $k)
        <div class="bg-white/70 backdrop-blur rounded-2xl overflow-hidden shadow card-hover">
            <img src="{{ asset($k['img']) }}" class="h-56 w-full object-cover">
            <div class="p-4 text-center">
                <h3 class="font-bold text-lg">{{ $k['nama'] }}</h3>
                <p class="text-gray-600">{{ $k['jabatan'] }}</p>
            </div>
        </div>
    @endforeach

</div>

@endsection

@extends('layouts.app')

@section('content')

    {{-- ================= BACKGROUND GAMBAR ================= --}}
    <div class="relative bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('images/kelas.jpeg') }}');">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative z-10">

            {{-- HEADER --}}
            <section class="h-screen flex items-center justify-center text-center">
                <h1 class="text-white text-6xl font-bold">
                    KELAS {{ $kelas->nama_kelas }}
                </h1>
            </section> 

            {{-- CARD SISWA --}}
            <section class="py-16">
                <div class="max-w-7xl mx-auto px-4">

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                        @foreach ($kelas->siswa as $siswa)
                            <div
                                class="bg-white rounded-xl shadow-lg p-4 text-center 
                                                                                                hover:scale-105 transition duration-300">

                                <img src="{{ asset('storage/' . $siswa->foto) }}"
                                    class="w-32 h-32 mx-auto object-cover rounded-full mb-4">

                                <h3 class="font-semibold text-lg">
                                    {{ $siswa->nama_siswa }}
                                </h3>

                            </div>
                        @endforeach

                    </div>

                </div>
            </section>
        </div>
    </div>
    {{-- ================= END BACKGROUND GAMBAR ================= --}}




@endsection
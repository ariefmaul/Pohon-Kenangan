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

            <section class="py-16">
                <div class="max-w-6xl mx-auto px-4">
                    <video class="w-full min-h-[500px] object-cover rounded-xl shadow-2xl" controls>
                        <source src="/docs/videos/flowbite.mp4" type="video/mp4">
                    </video>
                </div>
            </section>


            <section class="pb-16">

                <div class="max-w-6xl mx-auto px-2">

                    <div
                        class="w-full text-center bg-neutral-primary-soft p-6 border border-default rounded-base shadow-xs">
                        <h5 class="mb-3 text-2xl tracking-tight font-semibold text-heading">Sosial Media {{ $kelas->nama_kelas }}</h5>
                        <p class="mb-6 text-base text-body sm:text-lg"> Kepoin SOSMED kami yuk <br>Tekan link dibawah.</p>
                        <div
                            class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                            <a href="#"
                                class="w-full sm:w-auto bg-dark hover:bg-dark-strong focus:ring-4 focus:outline-none focus:ring-neutral-quaternary text-white rounded-base inline-flex items-center justify-center px-4 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 me-2">
                                    <path
                                        d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5z" />
                                    <path
                                        d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7z" />
                                    <circle cx="17.5" cy="6.5" r="1.5" />
                                </svg>
                                <div class="text-left rtl:text-right">
                                    <div class="text-sm font-bold">Instagram</div>
                                    <div class="text-xs">Kunjungi Instagram {{ $kelas->nama_kelas }}</div>
                                </div>
                            </a>
                            <a href="#"
                                class="w-full sm:w-auto bg-dark hover:bg-dark-strong focus:ring-4 focus:outline-none focus:ring-neutral-quaternary text-white rounded-base inline-flex items-center justify-center px-4 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6 me-2">
                                    <path
                                        d="M19.589 6.686a4.793 4.793 0 0 1-3.77-1.877V14.3a5.308 5.308 0 1 1-5.307-5.308c.157 0 .312.01.464.022v2.72a2.587 2.587 0 1 0 1.664 2.566V2h2.79a4.8 4.8 0 0 0 4.159 4.686v0z" />
                                </svg>
                                <div class="text-left rtl:text-right">
                                    <div class="text-sm font-bold">TikTok</div>
                                    <div class="text-xs">Kunjungi TikTok {{ $kelas->nama_kelas }}</div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
    {{-- ================= END BACKGROUND GAMBAR ================= --}}




@endsection
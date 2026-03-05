@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                🌳 Daftar Kelas
            </h1>
        </div>
        <input type="text" id="searchInputs" placeholder="Cari kelas..."
            class="border px-3 py-2 rounded-lg w-64 focus:ring focus:ring-green-300 mb-3">
        <!-- Grid Card -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" id="treeLists">
            @foreach ($kelas as $kelasItem)
                <div class="group bg-white rounded-2xl shadow hover:shadow-xl transition duration-300 overflow-hidden">

                    <!-- Image -->
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $kelasItem->nama_kelas) }}" alt="{{ $kelasItem->nama_kelas }}"
                            class="h-full w-full object-cover group-hover:scale-105 transition duration-300">
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                            {{ $kelasItem->nama_kelas }}
                        </h2>

                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                            <!-- {{ Str::limit($kelasItem->deskripsi, 110) }} -->
                        </p>

                        <!-- Action -->
                        <div class="flex justify-between items-center">
                            @php
                                $routeName = 'kelas.siswa';

                                if(auth()->check() && auth()->user()->role === 'km') {
                                    $routeName = 'km.kelas.show';
                                }
                            @endphp

                            <a href="{{ route($routeName, $kelasItem->id) }}"
                            class="inline-flex items-center gap-2 text-green-600 font-medium hover:underline">
                                Detail
                            </a>

                            <span class="text-xs text-gray-400">
                                Wali Kelas: {{ $kelasItem->nama_wakel }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $kelas->links() }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Client-side search functionality
        document.getElementById("searchInputs").addEventListener("keyup", function() {
            let keyword = this.value.toLowerCase();
            let cards = document.querySelectorAll("#treeLists .group");

            cards.forEach(card => {
                let title = card.querySelector("h2").innerText.toLowerCase();

                if (title.includes(keyword)) {
                    card.style.display = "block"; // tampil
                } else {
                    card.style.display = "none"; // sembunyi
                }
            });
        });
    </script>
@endpush

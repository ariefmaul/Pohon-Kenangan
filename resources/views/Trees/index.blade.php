@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                🌳 Daftar Pohon
            </h1>
        </div>

        <!-- Grid Card -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($trees as $tree)
                <div class="group bg-white rounded-2xl shadow hover:shadow-xl transition duration-300 overflow-hidden">

                    <!-- Image -->
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $tree->gambar) }}" alt="{{ $tree->nama_pohon }}"
                            class="h-full w-full object-cover group-hover:scale-105 transition duration-300">
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                            {{ $tree->nama_pohon }}
                        </h2>

                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                            {{ Str::limit($tree->deskripsi, 110) }}
                        </p>

                        <!-- Action -->
                        <div class="flex justify-between items-center">
                            <a href="{{ route('trees.show', $tree->id) }}"
                                class="inline-flex items-center gap-2 text-green-600 font-medium hover:underline">
                                Detail
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <span class="text-xs text-gray-400">
                                ID: {{ $tree->id }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $trees->links() }}
        </div>
    </div>
@endsection

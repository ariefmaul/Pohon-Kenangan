@extends('layouts.app');
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                👥 Daftar Anggota
            </h1>
        </div>
        <!-- Grid Card -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3
">
            @foreach ($members as $member)
                <div class="group bg-white rounded-2xl shadow hover:shadow-xl transition duration-300 overflow-hidden">

                    <!-- Image -->
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $member->foto) }}" alt="{{ $member->nama }}"
                            class="h-full w-full object-cover group-hover:scale-105 transition duration-300">
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                            {{ $member->nama }}
                        </h2>

                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                            {{ Str::limit($member->jabatan, 110) }}
                        </p>


                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-10">
            {{ $members->links() }}
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                🌳 Daftar Pohon
            </h1>
        </div>
        <button onclick="openCreateModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            + Tambah Pohon
        </button>

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
                            <button onclick='openEditModal(@json($tree))'
                                class="px-3 py-1 bg-yellow-500 text-white rounded">
                                Edit
                            </button>

                            <button onclick="confirmDelete({{ $tree->id }})"
                                class="px-3 py-1 bg-red-600 text-white rounded">
                                Hapus
                            </button>

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
    <div id="treeModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-end sm:items-center justify-center">

        <!-- Modal Box -->
        <div
            class="bg-white w-full sm:max-w-2xl rounded-t-2xl sm:rounded-2xl
               max-h-screen sm:max-h-[90vh]
               flex flex-col overflow-hidden
               animate-slide-up">

            <!-- Header -->
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h2 id="modalTitle" class="text-lg sm:text-xl font-bold">
                    Tambah Pohon
                </h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-black text-xl">
                    ✕
                </button>
            </div>

            <!-- Body (Scrollable) -->
            <div class="px-6 py-4 overflow-y-auto">
                <form id="treeForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod">

                    <!-- Nama Pohon -->
                    <div>
                        <label class="font-medium">Nama Pohon</label>
                        <input type="text" name="nama_pohon" id="nama_pohon" class="w-full border rounded px-3 py-2"
                            required>
                    </div>

                    <!-- Taksonomi -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label>Ordo</label>
                            <input type="text" name="ordo" id="ordo" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Famili</label>
                            <input type="text" name="famili" id="famili" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Genus</label>
                            <input type="text" name="genus" id="genus" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Spesies</label>
                            <input type="text" name="spesies" id="spesies" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="w-full border rounded px-3 py-2" rows="4"></textarea>
                    </div>

                    <!-- Manfaat -->
                    <div>
                        <label>Manfaat</label>
                        <textarea name="manfaat" id="manfaat" class="w-full border rounded px-3 py-2" rows="3"></textarea>
                    </div>

                    <!-- Upload -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label>Gambar Utama (Hero)</label>
                            <input type="file" name="gambar" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Foto Lokasi / Lapangan</label>
                            <input type="file" name="foto_lokasi" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="pt-4 flex justify-end gap-3">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded">
                            Batal
                        </button>
                        <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const modal = document.getElementById('treeModal');
        const form = document.getElementById('treeForm');

        function openCreateModal() {
            modal.classList.remove('hidden');
            form.action = "{{ route('trees.store') }}";
            form.reset();
            document.getElementById('formMethod').value = '';
            document.getElementById('modalTitle').innerText = 'Tambah Pohon';
        }

        function openEditModal(tree) {
            modal.classList.remove('hidden');
            form.action = `/admin/trees/${tree.id}`;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('modalTitle').innerText = 'Edit Pohon';

            document.getElementById('nama_pohon').value = tree.nama_pohon;
            document.getElementById('deskripsi').value = tree.deskripsi ?? '';
            document.getElementById('ordo').value = tree.ordo ?? '';
            document.getElementById('famili').value = tree.famili ?? '';
            document.getElementById('genus').value = tree.genus ?? '';
            document.getElementById('spesies').value = tree.spesies ?? '';
            document.getElementById('manfaat').value = tree.manfaat ?? '';

        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        // ✅ SweetAlert Loading on submit
        form.addEventListener('submit', () => {
            Swal.fire({
                title: 'Menyimpan...',
                html: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        });

        // ✅ Delete dengan SweetAlert
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus pohon?',
                text: 'Data tidak bisa dikembalikan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    const f = document.createElement('form');
                    f.method = 'POST';
                    f.action = `/admin/trees/${id}`;
                    f.innerHTML = `
                @csrf
                <input type="hidden" name="_method" value="DELETE">
            `;
                    document.body.appendChild(f);
                    f.submit();
                }
            });
        }
    </script>
@endpush

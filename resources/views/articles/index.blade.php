@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-green-700">Daftar Artikel Pohon</h1>

            @auth
                @if (auth()->user()->role === 'admin')
                    <button onclick="openCreateModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        + Tambah Artikel
                    </button>
                @endif
            @endauth
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($articles as $article)
                <div class="bg-white shadow rounded-lg overflow-hidden">

                    @if ($article->gambar)
                        <img src="{{ asset('storage/' . $article->gambar) }}" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-5">
                        <h2 class="text-xl font-semibold text-green-600">
                            {{ $article->judul }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            Tentang: {{ $article->tree->nama_pohon }}
                        </p>

                        <p class="mt-3 text-gray-700">
                            {{ Str::limit($article->isi, 150) }}
                        </p>

                        @if (auth()->check() && auth()->user()->role === 'admin')
                            <div class="mt-4 flex gap-2">
                                <button type="button" onclick='openEditModal({!! $article->toJson() !!})'
                                    class="px-3 py-1 bg-yellow-500 text-white rounded">
                                    Edit
                                </button>

                                <button type="button" onclick="confirmDelete({{ $article->id }})"
                                    class="px-3 py-1 bg-red-600 text-white rounded">
                                    Hapus
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $articles->links() }}</div>
    </div>

    {{-- MODAL --}}
    <div id="articleModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-lg p-6">
            <h2 id="modalTitle" class="text-xl font-bold mb-4">Tambah Artikel</h2>

            <form id="articleForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="formMethod" name="_method">
                <div class="mb-3">
                    <label class="font-medium">Pohon</label>
                    <select name="tree_id" id="tree_id" class="w-full border rounded-lg px-3 py-2" required>
                        <option value="">-- Pilih Pohon --</option>
                        @foreach ($trees as $tree)
                            <option value="{{ $tree->id }}">{{ $tree->nama_pohon }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="font-medium">Judul</label>
                    <input type="text" name="judul" id="judul" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="mb-3">
                    <label class="font-medium">Isi Artikel</label>
                    <textarea name="isi" id="isi" rows="4" class="w-full border rounded-lg px-3 py-2"></textarea>
                </div>

                <div class="mb-3">
                    <label class="font-medium">Gambar</label>
                    <input type="file" name="gambar" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-lg">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const modal = document.getElementById('articleModal');
        const form = document.getElementById('articleForm');

        function openCreateModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            form.action = "{{ url('admin/articles') }}";
            document.getElementById('formMethod').value = '';
            document.getElementById('modalTitle').innerText = 'Tambah Artikel';
            form.reset();
        }



        function openEditModal(article) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            form.action = `/admin/articles/${article.id}`;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('modalTitle').innerText = 'Edit Artikel';

            document.getElementById('judul').value = article.judul;
            document.getElementById('isi').value = article.isi;
            document.getElementById('tree_id').value = article.tree_id;
        }



        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }


        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus?',
                text: 'Data tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/articles/${id}`;

                    form.innerHTML = `
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endpush

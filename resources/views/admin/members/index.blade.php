@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">👥 Daftar Anggota</h1>
            <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Tambah Anggota
            </button>
        </div>

        <!-- Table -->
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Foto</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Jabatan</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr class="border-t">
                            <td class="p-3">
                                <img src="{{ asset('storage/' . $member->foto) }}" class="h-14 w-14 rounded object-cover">
                            </td>
                            <td class="p-3 font-medium">{{ $member->nama }}</td>
                            <td class="p-3">{{ $member->jabatan }}</td>
                            <td class="p-3 space-x-2">
                                <button onclick="openEditModal({{ $member }})"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded">
                                    Edit
                                </button>
                                <button onclick="hapusMember({{ $member->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>

                            </td>
                        </tr>
                    @endforeach

                    @if ($members->count() == 0)
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                Belum ada data
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $members->links() }}
        </div>
    </div>

    <!-- MODAL -->
    <div id="memberModal" class="fixed inset-0 hidden bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-md p-6">
            <h2 id="modalTitle" class="text-xl font-bold mb-4">Tambah Anggota</h2>

            <form id="memberForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="_method" name="_method">

                <div class="mb-3">
                    <label class="block text-sm mb-1">Nama</label>
                    <input type="text" name="nama" id="nama" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm mb-1">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm mb-1">Foto</label>
                    <input type="file" name="foto" class="w-full border rounded px-3 py-2" accept=".jpg, .png">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 rounded bg-gray-400 text-white">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <form id="deleteForm-{{ $member->id }}" action="{{ route('admin.members.destroy', $member->id) }}" method="POST"
        class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openAddModal() {
            document.getElementById('memberModal').classList.remove('hidden');
            document.getElementById('modalTitle').innerText = 'Tambah Anggota';
            document.getElementById('memberForm').action = "{{ route('admin.members.store') }}";
            document.getElementById('_method').value = '';
            document.getElementById('memberForm').reset();
        }

        function openEditModal(member) {
            document.getElementById('memberModal').classList.remove('hidden');
            document.getElementById('modalTitle').innerText = 'Edit Anggota';
            document.getElementById('memberForm').action = `/admin/members/${member.id}`;
            document.getElementById('_method').value = 'PUT';

            document.getElementById('nama').value = member.nama;
            document.getElementById('jabatan').value = member.jabatan;
        }

        function closeModal() {
            document.getElementById('memberModal').classList.add('hidden');
        }

        function hapusMember(id) {
            Swal.fire({
                title: 'Yakin hapus?',
                text: 'Data tidak bisa dikembalikan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Menghapus...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    document.getElementById(`deleteForm-${id}`).submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
@endsection

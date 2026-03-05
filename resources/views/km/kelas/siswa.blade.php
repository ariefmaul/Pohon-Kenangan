@extends('layouts.app')

@section('content')

{{-- ================= MODAL EDIT FOTO ================= --}}
<div id="editModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">

    <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-2xl w-full max-w-md p-6 relative animate-scaleIn">

        <h2 class="text-2xl font-bold mb-5 text-center">
            ✏️ Edit Foto Siswa
        </h2>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- FOTO --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Foto</label>

                <input type="file" name="foto"
                    class="w-full text-sm border rounded-lg p-2 bg-gray-50">
            </div>

            {{-- JABATAN --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Jabatan</label>

                <select name="jabatan"
                    class="w-full px-3 py-2 border rounded-lg bg-gray-50">

                    <option value="">-- Pilih Jabatan --</option>
                    <option value="Ketua Murid">Ketua Murid</option>
                    <option value="Wakil Ketua">Wakil Ketua</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Anggota">Anggota</option>

                </select>
            </div>

            {{-- KATA KATA --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-2">Motivasi</label>

                <textarea name="kata_kata" rows="3"
                    class="w-full p-3 border rounded-lg bg-gray-50"
                    placeholder="Tulis kata motivasi..."></textarea>
            </div>

            <div class="flex justify-end gap-3">

                <button type="button"
                    onclick="closeModal()"
                    class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Simpan
                </button>

            </div>

        </form>

        <button onclick="closeModal()"
            class="absolute top-3 right-3 text-gray-400 hover:text-black text-xl">
            ✕
        </button>

    </div>
</div>


{{-- ================= BACKGROUND ================= --}}
<div class="relative min-h-screen bg-cover bg-center bg-fixed"
    style="background-image: url('{{ asset('storage/' . ($kelas->siswa_bg ?? 'default-bg.jpg')) }}');">

    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

    <div class="relative z-10">


        {{-- HERO --}}
        <section class="min-h-[70vh] flex flex-col items-center justify-center text-center px-6">

            <h1 class="text-white text-4xl md:text-6xl font-bold drop-shadow-lg">
                👋 Hai, KM dari
            </h1>

            <h2 class="text-blue-300 text-3xl md:text-5xl font-semibold mt-3">
                {{ $kelas->nama_kelas }}
            </h2>

            <button onclick="openBgModal()"
                class="mt-8 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-lg transition">
                🎨 Ganti Background
            </button>

        </section>


        {{-- ================= SISWA GRID ================= --}}
        <section class="pb-20">

            <div class="max-w-7xl mx-auto px-6">

                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                    @foreach ($kelas->siswa as $siswa)

                        @php
                            $warna = match (strtolower($siswa->jabatan)) {
                                'ketua murid' => 'bg-red-100 text-red-700',
                                'wakil ketua' => 'bg-blue-100 text-blue-700',
                                'sekretaris' => 'bg-green-100 text-green-700',
                                'bendahara' => 'bg-yellow-100 text-yellow-700',
                                default => 'bg-gray-100 text-gray-700'
                            };
                        @endphp


                        <div class="group bg-white/90 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden transition hover:-translate-y-2 hover:shadow-2xl">

                            {{-- FOTO --}}
                            <div class="relative">

                                <img src="{{ asset('storage/' . $siswa->foto) }}"
                                    class="w-full h-56 object-cover">

                                {{-- EDIT BUTTON --}}
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">

                                    <button onclick="openModal(
                                        {{ $siswa->id }},
                                        '{{ route('km.siswa.update', $siswa->id) }}',
                                        '{{ $siswa->jabatan }}',
                                        `{{ $siswa->kata_kata }}`
                                    )"

                                    class="bg-white text-blue-600 p-3 rounded-full shadow-lg hover:scale-110 transition">

                                        ✏️

                                    </button>

                                </div>

                            </div>


                            {{-- INFO --}}
                            <div class="p-4 text-center">

                                <h3 class="font-semibold text-lg">
                                    {{ $siswa->nama_siswa }}
                                </h3>

                                @if($siswa->jabatan)
                                <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold rounded-full {{ $warna }}">
                                    {{ $siswa->jabatan }}
                                </span>
                                @endif

                                @if($siswa->kata_kata)
                                <p class="mt-3 text-sm text-gray-600 italic line-clamp-3">
                                    "{{ $siswa->kata_kata }}"
                                </p>
                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    </div>
</div>


{{-- ================= MODAL BG ================= --}}
<div id="bgModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative animate-scaleIn">

        <h2 class="text-xl font-bold mb-4 text-center">
            🎨 Update Background
        </h2>

        <form action="{{ route('km.kelas.updateSiswaBg', $kelas->id) }}"
            method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <input type="file" name="siswa_bg"
                class="w-full mb-4 border p-2 rounded-lg">

            <div class="flex justify-end gap-3">

                <button type="button"
                    onclick="closeBgModal()"
                    class="px-4 py-2 bg-gray-400 text-white rounded-lg">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Simpan
                </button>

            </div>

        </form>

        <button onclick="closeBgModal()"
            class="absolute top-3 right-3 text-gray-400 hover:text-black">
            ✕
        </button>

    </div>
</div>


{{-- ================= SCRIPT ================= --}}
@push('scripts')

<script>

function openBgModal(){
    const modal = document.getElementById('bgModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeBgModal(){
    const modal = document.getElementById('bgModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function openModal(id,url,jabatan='',kata_kata=''){

    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');

    form.action = url;

    form.querySelector('select[name="jabatan"]').value = jabatan ?? '';
    form.querySelector('textarea[name="kata_kata"]').value = kata_kata ?? '';

    modal.classList.remove('hidden');
    modal.classList.add('flex');

}

function closeModal(){

    const modal = document.getElementById('editModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');

}

</script>

@endpush


{{-- ================= ANIMATION ================= --}}
<style>

@keyframes scaleIn{
from{
opacity:0;
transform:scale(0.9);
}
to{
opacity:1;
transform:scale(1);
}
}

.animate-scaleIn{
animation:scaleIn .3s ease;
}

</style>

@endsection
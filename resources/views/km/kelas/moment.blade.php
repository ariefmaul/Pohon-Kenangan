@extends('layouts.app')

@section('content')

<!-- ================= HERO KM ================= -->
<section class="relative h-[60vh] flex items-center justify-center bg-black overflow-hidden">

    <div class="absolute inset-0">
        <img src="{{ asset('storage/' . ($kelas->moment_bg ?? 'default-bg.jpg')) }}"
            class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <div class="relative z-10 text-center text-white px-6">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">
            🌳 Kelola Pohon Kenangan
        </h1>

        <p class="text-gray-300 text-lg">
            {{ $kelas->nama_kelas }}
        </p>

        <div class="flex flex-wrap justify-center gap-4 mt-6">

            <!-- Tambah Moment -->
            <button data-modal-target="momentModal"
                data-modal-toggle="momentModal"
                onclick="setCreateMode()"
                class="px-6 py-3 bg-green-600 hover:bg-green-700 rounded-xl shadow-lg transition">

                + Tambah Moment
            </button>

            <!-- Ganti Background -->
            <button data-modal-target="bgModal"
                data-modal-toggle="bgModal"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl shadow-lg transition">

                🎨 Ganti Latar
            </button>

        </div>
    </div>
</section>


<!-- ================= LIST MOMENT ================= -->
<section class="bg-gradient-to-b from-black to-gray-900 py-16 px-6">

    <div class="max-w-6xl mx-auto
        grid
        grid-cols-1
        sm:grid-cols-2
        lg:grid-cols-3
        gap-6">

        @foreach($moments as $moment)

        <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-xl hover:-translate-y-1 transition">

            <!-- IMAGE -->
            <img
                src="{{ asset('storage/' . $moment->nama_gambar) }}"
                onclick="openLightbox(this.src)"
                class="w-full h-52 md:h-60 object-cover cursor-pointer hover:scale-105 transition duration-300">

            <div class="p-6 text-white">

                <h3 class="text-xl font-semibold mb-2">
                    {{ $moment->judul }}
                </h3>

                <p class="text-gray-400 mb-4 text-sm">
                    {{ $moment->deskripsi }}
                </p>

                <!-- ACTION BUTTON -->
                <div class="flex flex-wrap gap-3">

                    <button
                        data-modal-target="momentModal"
                        data-modal-toggle="momentModal"
                        onclick="editMoment(
                            '{{ $moment->id }}',
                            '{{ $moment->judul }}',
                            '{{ $moment->deskripsi }}'
                        )"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-lg text-sm">

                        Edit
                    </button>

                    <button
                        onclick="openDeleteModal('{{ $moment->id }}','{{ $moment->judul }}')"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm">

                        Hapus
                    </button>

                </div>

            </div>
        </div>

        @endforeach

    </div>

</section>


<!-- ================= MODAL TAMBAH / EDIT ================= -->
<div id="momentModal"
class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4">

<div class="bg-gray-900 rounded-2xl w-full max-w-lg border border-gray-700">

<div class="flex justify-between items-center p-5 border-b border-gray-700">

<h3 id="modalTitle" class="text-white text-xl font-semibold">
Tambah Moment
</h3>

<button data-modal-hide="momentModal"
class="text-white text-xl">
✕
</button>

</div>


<div class="p-6">

<form id="momentForm"
action="{{ route('km.moments.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<input type="hidden" name="_method" id="methodField" value="POST">
<input type="hidden" name="kelas_id" value="{{ $kelas->id }}">


<!-- Judul -->
<div class="mb-4">

<label class="text-gray-300 text-sm">
Judul
</label>

<input
type="text"
name="judul"
id="judul"
class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700">

</div>


<!-- Deskripsi -->
<div class="mb-4">

<label class="text-gray-300 text-sm">
Deskripsi
</label>

<textarea
name="deskripsi"
id="deskripsi"
class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700"></textarea>

</div>


<!-- Upload -->
<div class="mb-4">

<label class="text-gray-300 text-sm">
Gambar
</label>

<input
type="file"
name="gambar"
id="gambarInput"
onchange="previewImage(event)"
class="block w-full text-sm text-gray-400
file:mr-4 file:py-2 file:px-4
file:rounded-lg file:border-0
file:bg-green-600 file:text-white
hover:file:bg-green-700">

<img
id="previewImg"
class="hidden mt-4 rounded-xl max-h-40">

</div>


<div class="flex justify-end gap-3">

<button
type="button"
data-modal-hide="momentModal"
class="px-4 py-2 bg-gray-600 rounded-lg text-white">

Batal

</button>

<button
type="submit"
class="px-6 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-white">

Simpan

</button>

</div>

</form>

</div>
</div>
</div>



<!-- ================= MODAL HAPUS ================= -->
<div id="deleteModal"
class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4">

<div class="bg-gray-900 rounded-2xl w-full max-w-md border border-gray-700 p-6">

<h3 class="text-xl text-white font-semibold mb-4">
Hapus Moment
</h3>

<p class="text-gray-400 mb-6">
Yakin ingin menghapus moment
<b id="deleteMomentTitle"></b> ?
</p>

<form id="deleteForm" method="POST">

@csrf
@method('DELETE')

<div class="flex justify-end gap-3">

<button
type="button"
onclick="closeDeleteModal()"
class="px-4 py-2 bg-gray-600 rounded-lg text-white">

Batal

</button>

<button
class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-white">

Hapus

</button>

</div>

</form>

</div>
</div>



<!-- ================= MODAL GANTI LATAR ================= -->
<div id="bgModal"
class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4">

<div class="bg-gray-900 rounded-2xl w-full max-w-md border border-gray-700 p-6">

<h3 class="text-white text-xl font-semibold mb-4">
🎨 Ganti Latar
</h3>

<form
action="{{ route('km.kelas.updateMomentBg', $kelas->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')

<input
type="file"
name="moment_bg"
class="block w-full text-sm text-gray-400
file:mr-4 file:py-2 file:px-4
file:rounded-lg file:border-0
file:bg-blue-600 file:text-white
hover:file:bg-blue-700 mb-4">

<div class="flex justify-end gap-3">

<button
type="button"
data-modal-hide="bgModal"
class="px-4 py-2 bg-gray-600 rounded-lg text-white">

Batal

</button>

<button
class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white">

Simpan

</button>

</div>

</form>

</div>
</div>



<!-- ================= LIGHTBOX ================= -->
<div id="lightbox"
class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4">

<button
onclick="closeLightbox()"
class="absolute top-6 right-6 text-white text-3xl">

✕

</button>

<img
id="lightboxImg"
class="max-h-[90vh] max-w-[95vw] rounded-xl shadow-2xl">

</div>



@push('scripts')

<script>


// LIGHTBOX

function openLightbox(src){

document.getElementById('lightboxImg').src = src

document.getElementById('lightbox')
.classList.remove('hidden')

}

function closeLightbox(){

document.getElementById('lightbox')
.classList.add('hidden')

}


// PREVIEW IMAGE

function previewImage(event){

const preview = document.getElementById('previewImg')

preview.src = URL.createObjectURL(event.target.files[0])

preview.classList.remove('hidden')

}


// CREATE MODE

function setCreateMode(){

const form = document.getElementById('momentForm')

document.getElementById('modalTitle').innerText = "Tambah Moment"

form.action = "{{ route('km.moments.store') }}"

document.getElementById('methodField').value = "POST"

document.getElementById('judul').value = ""

document.getElementById('deskripsi').value = ""

}


// EDIT MODE

function editMoment(id, judul, deskripsi){

const form = document.getElementById('momentForm')

document.getElementById('modalTitle').innerText = "Edit Moment"

form.action = "/ketua_murid/moments/" + id

document.getElementById('methodField').value = "PUT"

document.getElementById('judul').value = judul

document.getElementById('deskripsi').value = deskripsi

}


// DELETE MODAL

function openDeleteModal(id, judul){

document.getElementById('deleteMomentTitle').innerText = judul

const form = document.getElementById('deleteForm')

form.action = "/ketua_murid/moments/" + id

document.getElementById('deleteModal')
.classList.remove('hidden')

}

function closeDeleteModal(){

document.getElementById('deleteModal')
.classList.add('hidden')

}


</script>

@endpush


@endsection
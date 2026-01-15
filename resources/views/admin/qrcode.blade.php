@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-5 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Convert Link ke QR Code</h1>

        <form action="{{ route('admin.qrcode.generate') }}" method="POST">
            @csrf
            <input type="text" name="link" placeholder="Masukkan link" required class="border p-2 w-full">
            <button class="bg-blue-600 text-white px-3 py-2 mt-2">Generate QR</button>
        </form>

       @if (session('qr'))
    <div class="mt-6 text-center">
        <img
            src="data:image/png;base64,{{ session('qr') }}"
            alt="QR Code"
            class="mx-auto w-64 h-64"
        >

        <a
            href="data:image/png;base64,{{ session('qr') }}"
            download="qrcode.png"
            class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg"
        >
            Download QR
        </a>
    </div>
@endif


    </div>
@endsection

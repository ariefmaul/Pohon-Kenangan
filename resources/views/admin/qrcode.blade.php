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
            <div class="mt-4">
                <img src="{{ session('qr') }}" class="w-48">

            </div>

            <div class="mt-2">
                <a href="{{ session('qr') }}" download="qrcode.png"
                    class="bg-green-600 text-white px-4 py-2 mt-3 inline-block rounded hover:bg-green-700">
                    Download QR Code
                </a>
            </div>
        @endif

    </div>
@endsection

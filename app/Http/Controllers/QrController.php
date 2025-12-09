<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class QrController extends Controller
{
    public function index()
    {
        return view('admin.qrcode');
    }

    public function generate(Request $request)
    {
        $link = $request->link;

        // Logo (gunakan PNG, bukan ICO)
        $logo = public_path('logo.jpg'); // ubah favicon.ico ke PNG agar stabil

        // Output file
        $outputPath = 'qrcodes/qr-' . time() . '.png';
        $saveTo = storage_path('app/public/' . $outputPath);

        // Generate QR dengan logo
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($link)
            ->size(400)
            ->margin(10)
            ->logoPath($logo)     // logo
            ->logoResizeToWidth(80)
            ->logoPunchoutBackground(true)
            ->build();

        // simpan file
        $result->saveToFile($saveTo);

        return back()->with('qr', asset('storage/' . $outputPath));
    }
}

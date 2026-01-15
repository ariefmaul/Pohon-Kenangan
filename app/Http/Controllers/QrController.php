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
        $request->validate([
            'link' => 'required|url'
        ]);

        $logo = public_path('logo.jpg');

        // Generate QR
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($request->link)
            ->size(400)
            ->margin(10)
            ->logoPath($logo)
            ->logoResizeToWidth(80)
            ->logoPunchoutBackground(true)
            ->build();

        // ✅ Convert ke BASE64 (tidak disimpan)
        $qrBase64 = base64_encode($result->getString());

        return back()->with('qr', $qrBase64);
    }
}

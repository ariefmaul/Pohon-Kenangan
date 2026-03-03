<?php

namespace App\Http\Controllers;

use App\Models\Moment;
use Illuminate\Http\Request;
use App\Models\Kelas;

class MomentController extends Controller
{
    public function index($id)
    {
        $kelas = Kelas::findOrFail($id);

        $moments = $kelas->moments()
            ->latest()
            ->take(4)
            ->get();

        return view('kelas.moments', compact('kelas', 'moments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->storeAs('public/moments', $filename);

        Moment::create([
            'id_kelas' => $request->id_kelas,
            'nama_gambar' => $filename
        ]);

        return back()->with('success', 'Moment berhasil ditambahkan 🌿');
    }
}

<?php

namespace App\Http\Controllers\Km;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Moment;
use Illuminate\Support\Facades\Storage;

class MomentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW MOMENT PER KELAS
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);

        $moments = $kelas->moments()
            ->latest()
            ->get();

        return view('km.kelas.moment', compact('kelas', 'moments'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE MOMENT
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|max:2048',
        ]);

        $path = $request->file('gambar')->store('moment', 'public');

        Moment::create([
            'id_kelas' => $request->kelas_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'nama_gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Moment berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE MOMENT
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $moment = Moment::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($moment->nama_gambar && Storage::disk('public')->exists($moment->nama_gambar)) {
                Storage::disk('public')->delete($moment->nama_gambar);
            }

            $data['nama_gambar'] = $request->file('gambar')->store('moment', 'public');
        }

        $moment->update($data);

        return redirect()->back()->with('success', 'Moment berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE MOMENT
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request, $id)
    {
        $moment = Moment::findOrFail($id);

        // Hapus gambar dari storage
        if ($moment->nama_gambar && Storage::disk('public')->exists($moment->nama_gambar)) {
            Storage::disk('public')->delete($moment->nama_gambar);
        }

        $moment->delete();

        return redirect()->back()->with('success', 'Moment berhasil dihapus');
    }
}
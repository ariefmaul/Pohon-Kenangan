<?php

namespace App\Http\Controllers\Km;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("km.kelas.siswa");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kelas = Kelas::with('siswa')->findOrFail($id);
        return view('km.kelas.siswa', compact('kelas'));
    }

    /**
     * FORM UNTUK SISWA
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'jabatan' => 'nullable|string|max:50',
            'kata_kata' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }

            // Nama file unik
            $namaFile = Str::uuid() . '.' . $request->file('foto')->extension();

            // Simpan ke folder
            $path = $request->file('foto')->storeAs(
                'role/ketua_murid/siswa',
                $namaFile,
                'public'
            );

            $siswa->foto = $path;
        }

        $siswa->jabatan = $request->jabatan;
        $siswa->kata_kata = $request->kata_kata;

        $siswa->save();

        return back()->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateMomentBg(Request $request, $id)
    {
        $request->validate([
            'moment_bg' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $kelas = Kelas::findOrFail($id);

        if ($request->hasFile('moment_bg')) {

            // Hapus background lama jika ada
            if ($kelas->moment_bg && Storage::disk('public')->exists($kelas->moment_bg)) {
                Storage::disk('public')->delete($kelas->moment_bg);
            }

            $path = $request->file('moment_bg')->store('moment_bg', 'public');

            $kelas->moment_bg = $path;
            $kelas->save();
        }

        return back()->with('success', 'Background Pohon Kenangan berhasil diperbarui!');
    }

    public function updateSiswaBg(Request $request, $id)
    {
        $request->validate([
            'siswa_bg' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $kelas = Kelas::findOrFail($id);

        if ($request->hasFile('siswa_bg')) {

            if ($kelas->siswa_bg && Storage::disk('public')->exists($kelas->siswa_bg)) {
                Storage::disk('public')->delete($kelas->siswa_bg);
            }

            $path = $request->file('siswa_bg')->store('siswa_bg', 'public');

            $kelas->siswa_bg = $path;
            $kelas->save();
        }

        return back()->with('success', 'Background siswa berhasil diperbarui!');
    }
}

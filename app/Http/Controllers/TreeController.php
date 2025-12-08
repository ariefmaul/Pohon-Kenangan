<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TreeController extends Controller
{
    // User biasa: lihat daftar pohon
    public function index()
    {
        $trees = Tree::with('articles')->paginate(10);
        return view('trees.index', compact('trees'));
    }
    public function adminIndex()
    {
        $trees = Tree::latest()->paginate(10);
        return view('admin.trees.index', compact('trees'));
    }

    // User biasa: detail pohon
    public function show($id)
    {
        $tree = Tree::with('articles')->findOrFail($id);
        return view('trees.show', compact('tree'));
    }

    // Admin: form tambah pohon
    public function create()
    {
        return view('admin.trees.create');
    }

    // Admin: simpan pohon baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pohon'   => 'required|string|max:255',

            // Taksonomi
            'ordo'         => 'nullable|string|max:255',
            'famili'       => 'nullable|string|max:255',
            'genus'        => 'nullable|string|max:255',
            'spesies'      => 'nullable|string|max:255',

            // Konten
            'deskripsi'    => 'nullable|string',
            'manfaat'      => 'nullable|string',

            // Gambar
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_lokasi'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('trees', 'public');
        }
        if ($request->hasFile('foto_lokasi')) {
            $validated['foto_lokasi'] = $request->file('foto_lokasi')->store('trees', 'public');
        }

        Tree::create($validated);

        return redirect()->route('admin.trees.index')->with('success', 'Pohon berhasil ditambahkan!');
    }

    // Admin: edit pohon
    public function edit($id)
    {
        $tree = Tree::findOrFail($id);
        return view('admin.trees.edit', compact('tree'));
    }

    // Admin: update pohon
    public function update(Request $request, $id)
    {
        $tree = Tree::findOrFail($id);

        $validated = $request->validate([
            'nama_pohon'   => 'required|string|max:255',

            // Taksonomi
            'ordo'         => 'nullable|string|max:255',
            'famili'       => 'nullable|string|max:255',
            'genus'        => 'nullable|string|max:255',
            'spesies'      => 'nullable|string|max:255',

            // Konten
            'deskripsi'    => 'nullable|string',
            'manfaat'      => 'nullable|string',

            // Gambar
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_lokasi'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('trees', 'public');
        }
        if ($request->hasFile('foto_lokasi')) {
            $validated['foto_lokasi'] = $request->file('foto_lokasi')->store('trees', 'public');
        }

        $tree->update($validated);

        return redirect()->route('admin.trees.index')->with('success', 'Pohon berhasil diupdate!');
    }

    // Admin: hapus pohon

    public function destroy($id)
    {
        $tree = Tree::findOrFail($id);

        // ✅ Hapus gambar hero jika ada
        if ($tree->gambar && Storage::disk('public')->exists($tree->gambar)) {
            Storage::disk('public')->delete($tree->gambar);
        }

        // ✅ Hapus foto lokasi jika ada
        if ($tree->foto_lokasi && Storage::disk('public')->exists($tree->foto_lokasi)) {
            Storage::disk('public')->delete($tree->foto_lokasi);
        }

        // ✅ Hapus data dari database
        $tree->delete();

        return redirect()
            ->route('admin.trees.index')
            ->with('success', 'Pohon dan seluruh gambarnya berhasil dihapus!');
    }
}

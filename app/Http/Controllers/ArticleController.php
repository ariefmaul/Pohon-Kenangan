<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\TreeArticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Tampilkan daftar artikel
    public function index()
    {
        $articles = TreeArticle::with('tree')->paginate(10);
        $trees = Tree::all();
        return view('articles.index', compact('articles', 'trees'));
    }

    // Tampilkan detail artikel
    public function show($id)
    {
        $article = TreeArticle::with('tree')->findOrFail($id);
        return view('articles.show', compact('article'));
    }

    // Form tambah (admin)
    public function create()
    {
        return view('admin.articles.create');
    }

    // Simpan artikel baru (admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tree_id' => 'required|exists:trees,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('articles', 'public');
        }

        TreeArticle::create($validated);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Form edit (admin)
    public function edit($id)
    {
        $article = TreeArticle::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    // Update artikel (admin)
    public function update(Request $request, $id)
    {
        $article = TreeArticle::findOrFail($id);

        $validated = $request->validate([
            'tree_id' => 'required|exists:trees,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diupdate!');
    }

    // Hapus artikel (admin)
    public function destroy($id)
    {
        $article = TreeArticle::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}

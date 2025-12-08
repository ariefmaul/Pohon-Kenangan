<?php

namespace App\Http\Controllers;

use App\Models\TreeArticle;

class TreeArticleController extends Controller
{
    public function show($id)
    {
        $article = TreeArticle::with('tree')->findOrFail($id);
        return view('articles.show', compact('article'));
    }
}

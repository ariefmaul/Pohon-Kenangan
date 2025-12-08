<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreeArticle extends Model
{
    use HasFactory;
    protected $table = 'tree_articles';
    protected $fillable = ['tree_id', 'judul', 'isi', 'gambar'];

    public function tree()
    {
        return $this->belongsTo(Tree::class);
    }
}

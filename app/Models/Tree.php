<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;
    protected $table = 'trees';
    protected $guarded = ['id'];

    // Relasi ke artikel pohon
    public function articles()
    {
        return $this->hasMany(TreeArticle::class);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kelas;

class HomeController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('siswa')->paginate(10);
        return view('home', compact('kelas'));
    }
    public function pohon()
    {
        $kelas = Kelas::with('siswa')->paginate(10);
        return view('trees.index', compact('kelas'));
    }
}

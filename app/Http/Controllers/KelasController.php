<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('siswa')->paginate(10);
        return view('trees.index', compact('kelas'));
    }
    public function show($id)
    {
        $kelas = Kelas::with('siswa')->findOrFail($id);
        return view('kelas.siswa', compact('kelas'));
    }
    public function picture($id)
    {
        $kelas = Kelas::with('siswa')->findOrFail($id);
        return view('kelas.moments', compact('kelas'));
    }
    
}

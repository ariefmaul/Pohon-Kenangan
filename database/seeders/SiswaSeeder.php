<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 36; $i++) {
            Siswa::create([
                'nama_siswa' => 'Siswa ' . $i,
                'nisn' => '10000000' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'id_kelas' => 1,
            ]);
        }
    }
}

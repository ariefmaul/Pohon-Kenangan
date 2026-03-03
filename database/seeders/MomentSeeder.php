<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MomentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('moments')->insert([
            [
                'id_kelas' => 1,
                'judul' => 'Hari Pertama Masuk',
                'deskripsi' => 'Momen pertama kali kita masuk kelas dan masih canggung satu sama lain.',
                'nama_gambar' => 'fikri.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_kelas' => 1,
                'judul' => 'Lomba 17 Agustus',
                'deskripsi' => 'Keseruan lomba tarik tambang dan balap karung bareng teman-teman.',
                'nama_gambar' => 'moment2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_kelas' => 1,
                'judul' => 'Study Tour',
                'deskripsi' => 'Perjalanan penuh kenangan dan tawa selama study tour.',
                'nama_gambar' => 'moment3.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_kelas' => 1,
                'judul' => 'Perpisahan',
                'deskripsi' => 'Momen haru di hari terakhir kebersamaan kita.',
                'nama_gambar' => 'moment4.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
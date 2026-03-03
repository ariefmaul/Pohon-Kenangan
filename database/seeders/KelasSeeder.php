<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'nama_kelas' => 'Manja STM (PPLG)',
            'nama_wakel' => 'Budi',
            'quotes' => 'Kelas ini adalah kelas yang penuh dengan semangat dan kreativitas. Kami selalu berusaha untuk menjadi yang terbaik dalam segala hal yang kami lakukan. Bersama-sama, kami akan mencapai puncak kesuksesan dan membuat kenangan indah selama perjalanan kami di sekolah ini.',
        ]);
    }
}

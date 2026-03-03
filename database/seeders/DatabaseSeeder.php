<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Tree;
use App\Models\TreeArticle;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            KelasSeeder::class,
            SiswaSeeder::class,
            MomentSeeder::class,
        ]);

        User::create([
            'name' => 'Admin Kebun Opah',
            'email' => 'admin@kebunopah.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        Tree::create([
            'nama_pohon' => 'Mangga',
            'deskripsi' => 'Pohon mangga menghasilkan buah manis dan segar.',
            'gambar' => 'trees/mangga.jpg',
        ]);

        Tree::create([
            'nama_pohon' => 'Jati',
            'deskripsi' => 'Kayu jati terkenal kuat dan awet.',
            'gambar' => 'trees/jati.jpg',
        ]);


    }
}

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
        TreeArticle::create([
            'tree_id' => 1,
            'judul' => 'Manfaat Buah Mangga',
            'isi' => 'Mangga kaya vitamin C dan baik untuk kesehatan.',
            'gambar' => 'articles/mangga.jpg',
        ]);

        TreeArticle::create([
            'tree_id' => 2,
            'judul' => 'Kegunaan Kayu Jati',
            'isi' => 'Kayu jati digunakan untuk furniture berkualitas tinggi.',
            'gambar' => 'articles/jati.jpg',
        ]);
        Member::create([
            'nama' => 'Budi',
            'jabatan' => 'Ketua',
            'foto' => 'members/budi.jpg',
        ]);

        Member::create([
            'nama' => 'Siti',
            'jabatan' => 'Sekretaris',
            'foto' => 'members/siti.jpg',
        ]);
    }
}

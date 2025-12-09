# Kebun Opah (SMKN 2 Tasikmalaya)

Project web sederhana untuk menampilkan koleksi pohon, artikel terkait, dan manajemen anggota. Termasuk fitur admin untuk CRUD pohon, artikel, anggota, serta generator QR code.

## Fitur utama

- Daftar dan detail pohon (public)
- Artikel terkait setiap pohon (public)
- Halaman anggota tim (public)
- Panel admin untuk mengelola pohon, artikel, anggota
- Generator QR code yang menghasilkan file PNG (disimpan di `storage/app/public/qrcodes`)

## Teknologi

- PHP 8.2
- Laravel 12
- Tailwind CSS + Vite
- endroid/qr-code untuk pembuatan QR

## Persyaratan

- PHP >= 8.2
- Composer
- Node.js + npm
- Extensi PHP umum (mbstring, pdo, fileinfo, openssl)

## Instalasi (development)

1. Clone repository:

```bash
git clone <repo-url>
cd kebun-opah
```

2. Install PHP dependencies:

```bash
composer install
```

3. Salin `.env` dan konfigurasi environment:

```bash
cp .env.example .env
php artisan key:generate
# edit .env sesuai database Anda
```

4. Migrasi database (pastikan konfigurasi `.env` benar):

```bash
php artisan migrate
```

5. Buat symlink storage (untuk akses file di `storage/app/public`):

```bash
php artisan storage:link
```

6. Install frontend dependencies dan build (development):

```bash
npm install
npm run dev
```

7. Jalankan server lokal:

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## Struktur penting

- `app/Http/Controllers` — controller utama seperti `TreeController`, `ArticleController`, `MemberController`, `QrController`.
- `app/Models` — model: `Tree`, `TreeArticle`, `Member`, `User`.
- `resources/views` — blade view untuk public dan admin.
- `routes/web.php` — definisi route. Admin routes berada di bawah middleware `auth, admin` dan menggunakan path `/admin/*`.
- `storage/app/public/qrcodes` — output QR code.

## Routes singkat (penting)

- Public:
	- `GET /` — daftar pohon
	- `GET /trees/{id}` — detail pohon
	- `GET /articles/{id}` — lihat artikel
	- `GET /members` — daftar anggota

- Admin (membutuhkan login dan role `admin`):
	- `GET /admin/articles` — daftar artikel (admin)
	- `POST /admin/articles` — simpan artikel
	- `PUT /admin/articles/{id}` — update artikel
	- `DELETE /admin/articles/{id}` — hapus artikel
	- `GET /admin/trees` — daftar pohon (admin)
	- `POST /admin/trees` — simpan pohon
	- `PUT /admin/trees/{id}` — update pohon
	- `DELETE /admin/trees/{id}` — hapus pohon
	- `GET /admin/members` dan CRUD member
	- `GET /admin/qrcode` + `POST /admin/qrcode` — generator QR code

## Notes teknis / catatan developer

- Controller admin mengembalikan view di `resources/views/admin/*`.
- `ArticleController` menggunakan model `TreeArticle` (tabel `tree_articles`) dan menaruh file gambar di disk `public`.
- `TreeController` menyertakan logic untuk menghapus file gambar dari disk saat record dihapus.
- QR generator (`QrController`) menyimpan file PNG ke `storage/app/public/qrcodes` dan mengembalikan URL `asset('storage/qrcodes/...')`.

## Menjalankan test

Project saat ini tidak memiliki test otomatis (PHPUnit) yang dijalankan secara default. Jika Anda ingin menambahkan test, jalankan:

```bash
vendor/bin/phpunit
```

atau:

```bash
php artisan test
```

## Troubleshooting singkat

- Jika Anda mendapatkan error terkait file yang tidak bisa ditulis, pastikan folder `storage` dan `bootstrap/cache` memiliki permission yang benar.
- Jika gambar atau QR tidak muncul, jalankan `php artisan storage:link` lalu periksa file ada di `storage/app/public/qrcodes`.

## Contributing

Jika Anda ingin berkontribusi, silakan buat branch feature/fix, lakukan perubahan, dan buka pull request. Sertakan deskripsi singkat perubahan dan cara memverifikasi.

## License

MIT

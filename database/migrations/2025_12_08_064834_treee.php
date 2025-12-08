<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->id();

            $table->string('nama_pohon');
            $table->string('ordo')->nullable();
            $table->string('famili')->nullable();
            $table->string('genus')->nullable();
            $table->string('spesies')->nullable();

            $table->text('deskripsi')->nullable();
            $table->text('manfaat')->nullable();

            $table->string('gambar')->nullable();       // hero image
            $table->string('foto_lokasi')->nullable(); // foto lapangan

            $table->timestamps();
        });
        Schema::create('tree_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tree_id')->constrained('trees')->onDelete('cascade');
            $table->string('judul');
            $table->longText('isi');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tree_articles');
        Schema::dropIfExists('trees');
        Schema::dropIfExists('members');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nawaf_nilai_siswas', function (Blueprint $table) {
            $table->id();

            // Relasi ke siswa_kelas, bukan langsung siswa
            $table->foreignId('siswa_kelas_id')->constrained('nawaf_siswa_kelas')->onDelete('cascade');

            // Relasi ke mapel
            $table->foreignId('mapel_id')->constrained('nawaf_mapels')->onDelete('cascade');

            // Nilai + info semester
            $table->decimal('nilai', 5, 2);
            $table->string('semester')->nullable(); // Ganjil / Genap

            $table->timestamps();

            // Mencegah duplikat nilai untuk kombinasi yg sama
            $table->unique(['siswa_kelas_id', 'mapel_id', 'semester'], 'nilai_unik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nawaf_nilai_siswas');
    }
};

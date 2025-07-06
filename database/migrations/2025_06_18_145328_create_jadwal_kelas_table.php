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
        Schema::create('nawaf_jadwal_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            $table->foreign('kelas_id')->references('id')->on('nawaf_kelas')->onDelete('cascade');
            $table->foreign('mata_pelajaran_id')->references('id')->on('nawaf_mapels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nawaf_jadwal_kelas');
    }
};

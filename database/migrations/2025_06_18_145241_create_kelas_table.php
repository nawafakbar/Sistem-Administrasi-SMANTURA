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
        Schema::create('nawaf_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas'); // misal: "X IPA 1"
            $table->string('tingkat'); // X, XI, XII
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nawaf_kelas');
    }
};

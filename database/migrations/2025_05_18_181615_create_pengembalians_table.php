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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengembalian')->unique();
            $table->string('nama_pengembalian');
            $table->string('judul_buku');
            $table->string('tanggal_pinjam');
            $table->string('tanggal_kembali');
            $table->enum('status', ['tepatwaktu', 'terlambat'])->default('tepatwaktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
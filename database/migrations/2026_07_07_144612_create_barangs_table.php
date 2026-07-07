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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('kategori');
            $table->string('merk');
            $table->string('nomor_seri');
            $table->string('kondisi');
            $table->string('lokasi');
            $table->date('tanggal_masuk');
            $table->time('jam_input');
            $table->integer('jumlah');
            $table->string('foto')->nullable();
            $table->string('file_manual')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('admin');
            $table->date('tanggal_order');
            $table->date('tanggal_selesai');
            $table->string('jenis_pakaian');
            $table->string('bahan_utama');
            $table->string('bahan_tambahan')->nullable();
            $table->string('jenis_kancing');
            $table->string('penjahit'); //relasi dengan tabel karyawan mengambil jenih perkjaan 'Penjahit' dan ambil nama karyawannya
            $table->string('pemotong'); //relasi dengan tabel karyawan mengambil jenih perkjaan 'Pemotong' dan ambil nama karyawannya
            $table->string('size');
            $table->string('jumlah_potong');
            $table->string('harga_satuan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

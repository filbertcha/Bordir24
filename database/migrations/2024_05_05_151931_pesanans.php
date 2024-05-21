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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->nullable();
            $table->string('ukuran')->nullable();
            $table->integer('jumlah_pesanan')->nullable();
            $table->string('nama_gambar')->nullable();
            $table->string('deskripsi_tambahan')->nullable();
            $table->integer('pengiriman')->nullable();
            $table->string('pilih_kurir')->nullable();
            $table->string('servis')->nullable();
            $table->integer('hrg_brg')->nullable();
            $table->integer('hrg_ongkir')->nullable();
            $table->integer('total')->nullable();
            $table->integer('id_status')->nullable();
            $table->string('resi')->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamp('tanggal_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};

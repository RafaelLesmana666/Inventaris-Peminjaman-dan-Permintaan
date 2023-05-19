<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servis', function (Blueprint $table) {
            $table->id();
            $table->string('ruangan')->nullable();
            $table->string('nama_guru');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->enum('kategori_peminjaman',['Individu','Ruangan']);
            $table->date('tgl_masuk')->format('j-F-Y');
            $table->date('tgl_kembali')->format('j-F-Y')->nullable();
            $table->enum('status_perbaikan',['Request','Sedang Diperbaiki','Selesai Perbaikan','Dikembalikan']);
            $table->text('kendala');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servis');
    }
};

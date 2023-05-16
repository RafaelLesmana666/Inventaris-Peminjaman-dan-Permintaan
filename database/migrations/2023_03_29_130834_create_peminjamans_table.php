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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('nama_barang');
            $table->date('tgl_peminjaman')->format('j-F-Y');
            $table->date('tgl_kembali')->format('j-F-Y')->nullable();
            $table->integer('jml_barang_dipinjam');
            $table->string('kode_barang');
            $table->enum('status_peminjaman',['Dikembalikan','Masih Dipinjam','Barang Rusak','Dalam Perbaikan']);
            $table->string('kategori_barang');
            $table->string('ruangan');
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
        Schema::dropIfExists('peminjamans');
    }
};

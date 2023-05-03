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
            $table->integer('nip');
            $table->string('nama_guru');
            $table->string('nama_barang');
            $table->date('tgl_peminjaman')->format('d/m/Y');
            $table->date('tgl_kembali')->format('d/m/Y')->nullable();
            $table->integer('jml_barang_dipinjam');
            $table->integer('id_barang');
            $table->enum('status_peminjaman',['Dikembalikan','Masih Dipinjam','Barang Rusak']);
            $table->string('keterangan');
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

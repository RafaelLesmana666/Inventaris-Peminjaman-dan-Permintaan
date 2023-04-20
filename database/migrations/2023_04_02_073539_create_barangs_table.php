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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->date('tgl_pengadaan');
            $table->string('sumber_dana');
            $table->integer('jml_barang');
            $table->string('merk_barang');
            $table->enum('jenis_barang',['inventaris','non_inventaris','inventaris_ruangan']);
            $table->string('kategori_barang');
            $table->string('kondisi_barang');
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
        Schema::dropIfExists('barangs');
    }
};

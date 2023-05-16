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
        Schema::create('inventaris_ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('ruangan');
            $table->string('nama_ruangan');
            $table->string('pj_rayon');
            $table->string('pj_ruangan');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->enum('satuan',['Buah','Unit']);
            $table->integer('baik');
            $table->integer('rusak')->nullable();
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
        Schema::dropIfExists('invetaris_ruangan');
    }
};

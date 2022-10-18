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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idkategori');
            $table->string('gambar');
            $table->string('judul');
            $table->text('isi');
            $table->timestamps();

            $table->index('idkategori');
            //foreign key
            $table->foreign('idkategori')->references('id')->on('kategori');
            // $table->foreign('idkategori')->references('id')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('idkategori')->constrained('kategori');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berita');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('umkm', function (Blueprint $table) {
        $table->id();
        $table->string('nama_tempat');
        $table->string('keterangan');
        $table->integer('harga');
        $table->string('no_wa');
        $table->string('thumbnail');
        $table->string('photo1');
        $table->string('photo2');
        $table->string('photo3');
    });
}
};

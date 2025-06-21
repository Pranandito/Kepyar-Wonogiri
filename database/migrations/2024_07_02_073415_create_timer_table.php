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
        Schema::create('timer', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pju_id');
            $table->boolean('condition')->default(false);
            $table->time('on_time', 0);
            $table->time('off_time', 0);
            $table->enum('status', ['active', 'inactive']);
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
        Schema::dropIfExists('timer');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjuTable extends Migration
{
    public function up()
    {
        Schema::create('pju', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('pju_id');
            $table->float('daya')->nullable();
            $table->float('arus')->default(0);
            $table->float('daya_harian')->default(0);
            $table->float('profit_harian')->default(0);
            $table->float('daya_total')->default(0);
            $table->float('profit_total')->default(0);
            $table->float('bebas_emisi')->default(0);
            $table->timestamps();
        });
        Schema::create('pju_2', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('pju_id');
            $table->float('daya')->nullable();
            $table->float('arus')->default(0);
            $table->float('daya_harian')->default(0);
            $table->float('profit_harian')->default(0);
            $table->float('daya_total')->default(0);
            $table->float('profit_total')->default(0);
            $table->float('bebas_emisi')->default(0);
            $table->timestamps();
        });
        Schema::create('pju_3', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('pju_id');
            $table->float('daya')->nullable();
            $table->float('arus')->default(0);
            $table->float('daya_harian')->default(0);
            $table->float('profit_harian')->default(0);
            $table->float('daya_total')->default(0);
            $table->float('profit_total')->default(0);
            $table->float('bebas_emisi')->default(0);
            $table->timestamps();
        });
        Schema::create('pju_4', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('pju_id');
            $table->float('daya')->nullable();
            $table->float('arus')->default(0);
            $table->float('daya_harian')->default(0);
            $table->float('profit_harian')->default(0);
            $table->float('daya_total')->default(0);
            $table->float('profit_total')->default(0);
            $table->float('bebas_emisi')->default(0);
            $table->timestamps();
        });
        Schema::create('pju_5', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('pju_id');
            $table->float('daya')->nullable();
            $table->float('arus')->default(0);
            $table->float('daya_harian')->default(0);
            $table->float('profit_harian')->default(0);
            $table->float('daya_total')->default(0);
            $table->float('profit_total')->default(0);
            $table->float('bebas_emisi')->default(0);
            $table->timestamps();
        });
        Schema::create('pju_all', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('pju_id');
            $table->float('daya')->nullable();
            // $table->float('arus')->default(0);
            $table->float('daya_harian')->nullable();
            $table->integer('profit_harian')->nullable();
            $table->float('daya_total')->nullable();
            $table->float('profit_total')->nullable();
            $table->float('bebas_emisi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pju_1');
        Schema::dropIfExists('pju_2');
        Schema::dropIfExists('pju_3');
        Schema::dropIfExists('pju_4');
        Schema::dropIfExists('pju_5');
        Schema::dropIfExists('pju_all');
    }
}
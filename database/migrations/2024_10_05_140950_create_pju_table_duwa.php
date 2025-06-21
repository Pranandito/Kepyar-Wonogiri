<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjuTableDuwa extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pju_6', function (Blueprint $table) {
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
        Schema::create('pju_7', function (Blueprint $table) {
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
        Schema::create('pju_8', function (Blueprint $table) {
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
        Schema::create('pju_9', function (Blueprint $table) {
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
        Schema::create('pju_10', function (Blueprint $table) {
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pju_6');
        Schema::dropIfExists('pju_7');
        Schema::dropIfExists('pju_8');
        Schema::dropIfExists('pju_9');
        Schema::dropIfExists('pju_10');
    }
};

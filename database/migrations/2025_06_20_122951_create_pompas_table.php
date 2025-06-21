<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_pompa', function (Blueprint $table) {
            $table->id();
            $table->float('debit')->default(0);
            $table->float('volume')->default(0);
            $table->float('tegangan_dc')->default(0);
            $table->float('daya_dc')->default(0);
            $table->float('energi_harian')->default(0);
            $table->float('durasi_harian')->default(0);
            $table->float('durasi_total')->default(0);
            $table->float('energi_total')->default(0);
            $table->float('volume_total')->default(0);
            $table->decimal('latitude', 10, 8)->default(0);
            $table->decimal('longitude', 11, 8)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pompa');
    }
};

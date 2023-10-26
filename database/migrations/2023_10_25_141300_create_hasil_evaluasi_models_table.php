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
        Schema::create('hasil_evaluasi', function (Blueprint $table) {
            $table->smallInteger('id_alternatif', false, true);
            $table->tinyInteger('id_kriteria', false, true);
            $table->float('value');
            $table->primary(['id_alternatif', 'id_kriteria']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_evaluasi');
    }
};

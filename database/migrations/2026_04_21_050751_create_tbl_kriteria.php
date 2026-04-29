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
        Schema::create('tbl_kriteria', function (Blueprint $table) {
            $table->string('id_kriteria', 5)->primary();
            $table->string('nama_kriteria', 50);
            $table->integer('bobot');
            $table->enum('tipe', ['benefit', 'cost']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kriteria');
    }
};

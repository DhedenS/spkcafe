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
        Schema::create('tbl_penilaian', function (Blueprint $table) {
            $table->increments('id_penilaian');
            $table->string('id_alternatif', 2);
            $table->string('id_kriteria', 5);
            $table->integer('nilai');
            $table->integer('tbl_penilaian_id_penilaian')->nullable();

            $table->foreign('id_alternatif', 'fk_penilaian_alternatif_idx')
                ->references('id_alternatif')
                ->on('tbl_alternatif')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_kriteria', 'fk_penilaian_kriteria_idx')
                ->references('id_kriteria')
                ->on('tbl_kriteria')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_penilaian', function (Blueprint $table) {
            $table->dropForeign('fk_penilaian_alternatif_idx');
            $table->dropForeign('fk_penilaian_kriteria_idx');
        });
        
        Schema::dropIfExists('tbl_penilaian');
    }
};

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
        Schema::create('tbl_hasil', function (Blueprint $table) {
            $table->increments('id_hasil');
            $table->string('id_alternatif', 2);
            $table->decimal('nilai_v', 10, 6);
            $table->integer('ranking');

            $table->foreign('id_alternatif', 'fk_hasil_alternatif_idx')
                ->references('id_alternatif')
                ->on('tbl_alternatif')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_hasil', function (Blueprint $table) {
            $table->dropForeign('fk_hasil_alternatif_idx');
        });
        
        Schema::dropIfExists('tbl_hasil');
    }
};

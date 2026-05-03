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
        $table->string('id_alternatif', 5);
        $table->decimal('nilai_v', 10, 6);
        $table->integer('ranking');

        $table->foreign('id_alternatif')
            ->references('id_alternatif')
            ->on('tbl_alternatif')
            ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasils');
    }
};

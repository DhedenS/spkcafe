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
    Schema::create('tbl_menu_cafe', function (Blueprint $table) {
        $table->id();
        $table->string('id_alternatif', 2);
        $table->string('nama_menu');
        $table->integer('harga');
        $table->string('foto_menu')->nullable();
        $table->timestamps();

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
        Schema::dropIfExists('menu_cafes');
    }
};

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
    Schema::create('tbl_alternatif', function (Blueprint $table) {
        $table->string('id_alternatif', 5)->primary();

        $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->onDelete('cascade');

        $table->string('nama_cafe', 100);
        $table->string('nama_pemilik')->nullable();
        $table->string('no_hp')->nullable();
        $table->text('alamat')->nullable();
        $table->string('foto')->nullable();

        $table->integer('harga_menu')->nullable();
        $table->integer('luas_parkiran')->nullable();
        $table->integer('kecepatan_wifi')->nullable();
        $table->integer('jarak')->nullable();
        $table->integer('suasana')->nullable();

        $table->enum('status', ['pending', 'approved', 'rejected'])
            ->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_alternatif');
    }
};

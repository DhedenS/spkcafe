<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tbl_history')) {
            Schema::create('tbl_history', function (Blueprint $table) {
                $table->id('id_history');

                $table->integer('suasana');
                $table->integer('harga');
                $table->integer('jarak');
                $table->integer('parkiran');
                $table->integer('wifi');

                $table->string('hasil_cafe');
                $table->string('id_alternatif')->nullable();

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_history');
    }
};

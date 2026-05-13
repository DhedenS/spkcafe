<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tbl_history MODIFY suasana VARCHAR(100) NOT NULL");
        DB::statement("ALTER TABLE tbl_history MODIFY harga VARCHAR(100) NOT NULL");
        DB::statement("ALTER TABLE tbl_history MODIFY jarak VARCHAR(100) NOT NULL");
        DB::statement("ALTER TABLE tbl_history MODIFY parkiran VARCHAR(100) NOT NULL");
        DB::statement("ALTER TABLE tbl_history MODIFY wifi VARCHAR(100) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tbl_history MODIFY suasana INT NOT NULL");
        DB::statement("ALTER TABLE tbl_history MODIFY harga INT NOT NULL");
        DB::statement("ALTER TABLE tbl_history MODIFY jarak INT NOT NULL");
        DB::statement("ALTER TABLE tbl_history MODIFY parkiran INT NOT NULL");
        DB::statement("ALTER TABLE tbl_history MODIFY wifi INT NOT NULL");
    }
};

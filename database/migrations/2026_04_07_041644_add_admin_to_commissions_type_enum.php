<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // MySQL specific change for ENUM column
        DB::statement("ALTER TABLE commissions MODIFY COLUMN type ENUM('teacher', 'sales_agent', 'admin') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE commissions MODIFY COLUMN type ENUM('teacher', 'sales_agent') NOT NULL");
    }
};

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
        Schema::table('users', function (Blueprint $table) {
            $table->string('state')->nullable()->after('address');
            $table->string('district')->nullable()->after('state');
            $table->string('block')->nullable()->after('district');
            $table->string('pin_code')->nullable()->after('block');
            $table->string('coaching_or_school')->nullable()->after('pin_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['state', 'district', 'block', 'pin_code', 'coaching_or_school']);
        });
    }
};

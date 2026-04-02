<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('home_sectors', function (Blueprint $table) {

            $table->string('icon')->nullable()->after('slug');
            $table->longText('content')->nullable()->after('description');
            $table->json('stats')->nullable()->after('tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_sectors', function (Blueprint $table) {
            $table->dropColumn(['slug', 'icon', 'content', 'stats']);
        });
    }
};

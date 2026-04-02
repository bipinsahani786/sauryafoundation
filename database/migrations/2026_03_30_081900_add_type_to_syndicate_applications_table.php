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
        Schema::table('syndicate_applications', function (Blueprint $table) {
            $table->string('type')->default('Member')->after('email'); // Member, Volunteer, Syndicate
            $table->string('city')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('syndicate_applications', function (Blueprint $table) {
            //
        });
    }
};

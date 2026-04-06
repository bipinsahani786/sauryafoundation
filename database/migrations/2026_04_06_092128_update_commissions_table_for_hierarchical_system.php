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
        Schema::table('commissions', function (Blueprint $table) {
            // Make quiz_enrollment_id nullable to support other sources
            $table->unsignedBigInteger('quiz_enrollment_id')->nullable()->change();
            
            // Add Course ID support
            $table->foreignId('course_id')->nullable()->after('quiz_enrollment_id')->constrained('courses')->onDelete('cascade');
            
            // Generic amount field
            $table->renameColumn('quiz_price', 'total_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->renameColumn('total_amount', 'quiz_price');
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
            $table->unsignedBigInteger('quiz_enrollment_id')->nullable(false)->change();
        });
    }
};

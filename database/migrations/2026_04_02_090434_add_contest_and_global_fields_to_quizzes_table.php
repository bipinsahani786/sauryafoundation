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
        Schema::table('quizzes', function (Blueprint $table) {
            $table->boolean('is_global')->default(false)->after('status');
            $table->boolean('is_contest')->default(false)->after('is_global');
            $table->unsignedBigInteger('parent_id')->nullable()->after('is_contest');
            $table->integer('level_number')->nullable()->after('parent_id');
            $table->integer('promotion_percentage')->nullable()->after('level_number');
            $table->integer('winner_count')->nullable()->after('promotion_percentage');
            
            $table->foreign('parent_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn([
                'is_global', 
                'is_contest', 
                'parent_id', 
                'level_number', 
                'promotion_percentage', 
                'winner_count'
            ]);
        });
    }
};

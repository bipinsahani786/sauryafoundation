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
        Schema::create('study_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('class_id')->nullable()->constrained('student_classes')->onDelete('cascade');
            $table->string('title');
            $table->string('category')->default('note'); // note, pdf, etc.
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->boolean('is_global')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_materials');
    }
};

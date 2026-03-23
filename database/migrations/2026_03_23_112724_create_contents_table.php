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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['note', 'video', 'test'])->default('note');
            $table->string('title');
            $table->text('body')->nullable(); // Text for notes, YouTube link for video
            $table->foreignId('quiz_id')->nullable()->constrained()->onDelete('set null');
            $table->string('attachment_path')->nullable(); // For PDF notes
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};

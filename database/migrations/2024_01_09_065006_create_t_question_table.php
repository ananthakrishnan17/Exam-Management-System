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
        Schema::create('t_question', function (Blueprint $table) {
            $table->id();
            $table->integer('question_pattern_id');
            $table->string('question_answer_id');
            $table->string('question');
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('option4');
            $table->string('answer');
            $table->enum('format', ['text', 'image']);
            $table->string('created_by')->default('ADMIN');
            $table->dateTime('created_date')->nullable();
            $table->string('updated_by')->default('ADMIN');
            $table->dateTime('updated_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

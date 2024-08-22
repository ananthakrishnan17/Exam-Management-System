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
        Schema::create('t_question_patterns', function (Blueprint $table) {
            $table->id();
            $table->integer('question_pattern_id');
            $table->string('use_notuse')->default(0);
            $table->string('user_id');
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
        Schema::dropIfExists('patterns');
    }
};


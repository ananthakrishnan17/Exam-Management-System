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
        Schema::create('t_test_answer', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('question_id');
            $table->string('answer')->nullable();
            $table->string('created_by');
            $table->timestamp('created_date')->useCurrent();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('t_test_answer');
    }
};

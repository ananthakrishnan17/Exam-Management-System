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
        Schema::create('t_employee_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('dob');
            $table->string('marital_status');
            $table->string('email')->unique();            
            $table->string('year_of_graduation');
            $table->string('contact_number')->unique();
            $table->text('address');
            $table->string('cgpa');
            $table->string('degree_id');
            $table->string('use_notuse')->default(1);
            $table->string('created_by');
            $table->timestamp('created_date')->current_timestamp();
            $table->string('updated_by')->nullable();            
            $table->timestamp('updated_date')->nullable();  
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_employee_details');
    }
};

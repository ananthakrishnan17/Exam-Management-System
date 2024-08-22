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
        Schema::create('t_admin_details', function (Blueprint $table) {
            $table->id();
            $table->integer('role')->default(1);
            $table->string('admin_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('dob');
            $table->string('marital_status');
            $table->string('email')->unique();
            $table->string('contact_number')->unique();
            $table->string('address');
            $table->integer('use_notuse')->default(1);
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
        //
    }
};

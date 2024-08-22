<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_admin_details')->insert([
            'role' => 0,
            'admin_id' => 'ADM0001',
            'first_name' => 'Shanmuga',
            'last_name' => 'Sundaram',
            'gender' => '0',
            'dob' => '1989-12-01',
            'marital_status' => '1',
            'email' => 'headoffice@gmail.com',
            'contact_number' => 'ADMIN',
            'address' => 'Tirunelveli',
            'use_notuse' => 0,
            'created_by' => 'ADM0001',
            'created_date' => now(),
            'updated_by' => 'ADM0001',
            'updated_date' => now(),
        ]);
    }
}

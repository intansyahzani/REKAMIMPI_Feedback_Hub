<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'email' => 'admin@reka.com',
            'password' => 'AdminRM@1212', // plain text (for testing only)
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}


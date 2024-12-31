<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'Admin',
            'username' => 'admin123',
            'password' => bcrypt('123456'),
            'phone' => '+6281234567890',
            'email' => 'admin@gmail.com',
        ];

        DB::table('users')->insert($admin);
    }
}

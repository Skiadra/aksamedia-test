<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use Faker to generate dummy employee data
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            Employee::create([
                'id' => (string) Str::uuid(),
                'name' => $faker->name,
                'phone' => $faker->unique()->phoneNumber,
                'image' => 'example.com', // Set to null or a default image URL
                'position' => 'Position ' . $i,
                'division_id' => 'a0309e9c-c78e-11ef-b848-2cf05d67bcab'
            ]);
        }
    }
}

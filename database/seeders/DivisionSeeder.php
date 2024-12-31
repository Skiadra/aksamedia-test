<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['id' => 'a0309e9c-c78e-11ef-b848-2cf05d67bcab', 'name' => 'Mobile Apps'],
            ['id' => 'a0309e9c-c78e-11ef-b848-2cf05d67bcac', 'name' => 'QA'],
            ['id' => 'a0309e9c-c78e-11ef-b848-2cf05d67bcad', 'name' => 'Full Stack'],
            ['id' => 'a0309e9c-c78e-11ef-b848-2cf05d67bcae', 'name' => 'Backend'],
            ['id' => 'a0309e9c-c78e-11ef-b848-2cf05d67bcaf', 'name' => 'Frontend'],
            ['id' => 'a0309e9c-c78e-11ef-b848-2cf05d67bcag', 'name' => 'UI/UX Designer']
        ];

        DB::table('divisions')->insert($divisions);
    }
}

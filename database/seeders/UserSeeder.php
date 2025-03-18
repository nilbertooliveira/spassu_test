<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'nilbertooliveira.ti@gmail.com'],
            [
                'name' => 'Nilberto Oliveira',
                'email' => 'nilbertooliveira.ti@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('users')->updateOrInsert(
            ['email' => 'test@spassu.com'],
            [
                'name' => 'Test',
                'email' => 'test@spassu.com',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}

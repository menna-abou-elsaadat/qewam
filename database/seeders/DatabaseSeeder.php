<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\UserSessionSeeder;
use Database\Seeders\CustomerUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CustomerSeeder::class);
        $this->call(CustomerUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserSessionSeeder::class);
    }
}

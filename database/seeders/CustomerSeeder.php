<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Customer::factory()->times(5)->create();
        $customer = new Customer();
        $customer->name = 'Client One';
        $customer->save();

        $customer = new Customer();
        $customer->name = 'Client Two';
        $customer->save();
    }
}

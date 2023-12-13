<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomerUser;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CustomerUser::factory()->times(20)->create();
        $user = new CustomerUser();
        $user->name = 'user1';
        $user->email = 'user1@mail.com';
        $user->customer_id = 1;
        $user->registration_date = '2021-01-01';
        $user->save();

        $user = new CustomerUser();
        $user->name = 'user2';
        $user->email = 'user2@mail.com';
        $user->customer_id = 1;
        $user->registration_date = '2021-01-01';
        $user->save();

        $user = new CustomerUser();
        $user->name = 'user3';
        $user->email = 'user3@mail.com';
        $user->customer_id = 2;
        $user->registration_date = '2021-01-01';
        $user->save();

        $user = new CustomerUser();
        $user->name = 'user4';
        $user->email = 'user4@mail.com';
        $user->customer_id = 1;
        $user->registration_date = '2021-01-15';
        $user->save();

        $user = new CustomerUser();
        $user->name = 'user5';
        $user->email = 'user5@mail.com';
        $user->customer_id = 2;
        $user->registration_date = '2021-04-01';
        $user->save();

        $user = new CustomerUser();
        $user->name = 'user6';
        $user->email = 'user6@mail.com';
        $user->customer_id = 2;
        $user->registration_date = '2021-05-01';
        $user->save();

        $user = new CustomerUser();
        $user->name = 'user7';
        $user->email = 'user7@mail.com';
        $user->customer_id = 2;
        $user->registration_date = '2019-01-01';
        $user->save();

        $user = new CustomerUser();
        $user->name = 'user8';
        $user->email = 'user8@mail.com';
        $user->customer_id = 1;
        $user->registration_date = '2021-03-03';
        $user->save();

        $user = new CustomerUser();
        $user->name = 'user9';
        $user->email = 'user9@mail.com';
        $user->customer_id = 1;
        $user->registration_date = '2020-12-22';
        $user->save();

        $user = new CustomerUser();
        $user->name = 'user10';
        $user->email = 'user10@mail.com';
        $user->customer_id = 1;
        $user->registration_date = '2020-12-01';
        $user->save();

    }
}

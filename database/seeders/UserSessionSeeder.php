<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserSession;

class UserSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // UserSession::factory()->times(25)->create();
        $user_session = new UserSession();
        $user_session->user_id = 1;
        $user_session->appointment_date = '2021-01-22';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 2;
        $user_session->activation_date = '2021-01-01';
        $user_session->appointment_date = '2021-01-01';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 2;
        $user_session->activation_date = '2021-02-01';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 4;
        $user_session->activation_date = '2021-01-15';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 4;
        $user_session->activation_date = '2021-01-16';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 4;
        $user_session->activation_date = '2021-03-01';
        $user_session->appointment_date = '2021-01-30';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 4;
        $user_session->appointment_date = '2021-01-30';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 8;
        $user_session->activation_date = '2021-03-03';
        $user_session->appointment_date = '2021-03-03';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 9;
        $user_session->appointment_date = '2020-12-22';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 10;
        $user_session->activation_date = '2020-12-01';
        $user_session->save();


        $user_session = new UserSession();
        $user_session->user_id = 10;
        $user_session->activation_date = '2020-12-02';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 10;
        $user_session->activation_date = '2020-12-03';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 10;
        $user_session->appointment_date = '2021-01-04';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 3;
        $user_session->activation_date = '2021-01-01';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 5;
        $user_session->appointment_date = '2021-04-01';
        $user_session->save();

        $user_session = new UserSession();
        $user_session->user_id = 5;
        $user_session->activation_date = '2021-04-01';
        $user_session->save();

    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CustomerUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSession>
 */
class UserSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => CustomerUser::inRandomOrder()->value('id'),
        ];
    }
}

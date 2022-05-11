<?php

namespace Tests\Support\Models;

use Faker\Generator;

class UserFabricator extends \User\Models\User_model
{
    public function fake(Generator &$faker)
    {
        return [
            'fk_user_type' => $faker->numberBetween(1, 3),
            'username' => $faker->userName(),
            'email' => $faker->email(),
        ];
    }
}

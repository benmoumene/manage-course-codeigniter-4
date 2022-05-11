<?php

namespace Tests\Support\Models;

use Faker\Generator;

class CoursePlanFabricator extends \Plafor\Models\CoursePlanModel
{
    public function make(Generator &$faker)
    {
        return [
            'formation_number' => $faker->numerify('#####'),
            'official_name' => $faker->sentence,
            'date_begin' => $faker->date(),
        ];
    }
}

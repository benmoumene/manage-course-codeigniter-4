<?php

namespace Tests\Support\Models;

use Faker\Generator;

/**
 * Extension of ModuleModel that includes a fake data generator
 */
class ModuleFabricator extends \Plafor\Models\ModuleModel
{
    public function fake(Generator &$faker)
    {
        return [
            'module_number' => $faker->numerify('###'),
            'official_name' => $faker->sentence,
            'version' => $faker->randomDigit(),
        ];
    }
}

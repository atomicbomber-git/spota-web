<?php

use Faker\Generator as Faker;

$factory->define(App\Lecturer::class, function (Faker $faker) {
    return [
        'phone'         => $faker->phoneNumber,
        'position'      => $faker->jobTitle,
        'privileges'    => $faker->randomElement(['D','K']),
        'picture'       => '',
    ];
});

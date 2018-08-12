<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'position'      => $faker->jobTitle,
        'privileges'    => $faker->randomElement(['S','P']),
        'phone'         => $faker->phoneNumber,
    ];
});

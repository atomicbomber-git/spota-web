<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'identity_number' => $faker->unique()->numberBetwee('10000','99999'),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$w4AkYL6hH1SUlU.6PghL/OF5WterZbGyFnEXqjCSjnomX9cu/Klga', // password
        'remember_token' => str_random(10),
        'type' => 'D'
    ];
});

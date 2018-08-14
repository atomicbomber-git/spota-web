<?php

use Faker\Generator as Faker;

$factory->define(App\Faculty::class, function (Faker $faker) {
    return [
        'code'=> $faker->unique()->randomLetter,
        'name'=> $faker->unique()->company,
    ];
});

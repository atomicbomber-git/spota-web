<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'batch'     => $faker->numberBetween('2004','2018'),
        'picture'   => ''
    ];
});

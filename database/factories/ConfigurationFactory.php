<?php

use Faker\Generator as Faker;

$factory->define(App\Configuration::class, function (Faker $faker) {
    return [
        'current_semester'  => 'GANJIL-2018',
        'semesters_years'   => '2018/2019',
        'approved_count'    => $faker->numberBetween(1,5)
    ];
});

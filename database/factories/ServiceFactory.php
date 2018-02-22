<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name'=>$faker->catchPhrase,
        'time_taken'=>'2hrs',
    ];
});

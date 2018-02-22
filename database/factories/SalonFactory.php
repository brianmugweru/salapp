<?php

use Faker\Generator as Faker;

$factory->define(App\Salon::class, function (Faker $faker) {
    return [
        'name'=>$faker->catchPhrase,
        //'image'=>$faker->image('public/storage/salons',640,480,'city',false),
        'latitude'=>$faker->randomNumber($nbDigits=3,$strict=true),
        'longitude'=>$faker->randomNumber($nbDigits=3,$strict=true),
        'opening_time'=>'6:00:00',
        'closing_time'=>'20:30:00'
    ];
});

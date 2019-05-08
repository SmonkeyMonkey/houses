<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\House;
use Faker\Generator as Faker;

$factory->define(House::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(8, 520, 999999), // приближенные к значениям в csv таблице
        'bedrooms' => $faker->numberBetween(1,5),
        'bathrooms' => $faker->numberBetween(1,5),
        'storeys' => $faker->numberBetween(1,5),
        'garages' => $faker->numberBetween(1,5)
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'name'        => $faker->unique()->word(),
        'price'       => 00.0,
        'description' => $faker->sentence() 
    ];
});

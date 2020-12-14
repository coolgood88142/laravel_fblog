<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Articles;
use Faker\Generator as Faker;

$factory->define(Articles::class, function (Faker $faker) {
    return [
        'title' => $faker->title(),
        'content' => $faker->text(),
        'slug' => $faker->slug(),
    ];
});

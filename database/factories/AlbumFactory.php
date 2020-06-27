<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    $img = [
        "abstract",
        "animals",
        "business",
        "cats",
        "city",
        "food",
        "fashion",
        "people",
        "nature",
        "sports",
        "technics",
        "transport"
    ];
    return [
        'album_name' => $faker->name,
        'description' => $faker->text(128),
        'album_thumb' => $faker->imageUrl(640, 480, $faker->randomElement($img))
    ];
});

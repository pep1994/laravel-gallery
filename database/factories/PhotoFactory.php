<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
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
        'name' => $faker -> text(64),
        'description' => $faker -> text(),
        'img_path' => $faker -> imageUrl(640, 480, $faker ->randomElement($img))
    ];
});

<?php

declare (strict_types=1);

use App\Manufacturer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Manufacturer::class, function (Faker $faker) {
    $title = $faker->words(5, true);

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $faker->text(),
        'address' => $faker->address,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'logo' => 'null',
        'active' => true,
    ];
});

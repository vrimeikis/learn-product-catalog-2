<?php

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Product::class, function(Faker $faker) {

    $title = $faker->unique()->sentence(6);

    return [
        'title' => $title,
        'cover' => 'products/' . $faker->file(
                resource_path('img'),
                storage_path('app/public/products'),
                false
            ),
        'context' => $faker->paragraph,
        'slug' => Str::slug($title),
        'price' => $faker->numberBetween(10.00, 1000.00),
        'active' => (bool)random_int(0, 1),

    ];
});
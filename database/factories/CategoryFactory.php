<?php


declare(strict_types = 1);

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Category::class, function(Faker $faker) {
    $title = $faker->unique()->sentence(3, false);

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'active' => (int)$faker->boolean(),
        'cover' => 'categories/' . $faker->file(
                resource_path('img'),
                storage_path('app/public/categories'),
                false
            ),
    ];
});


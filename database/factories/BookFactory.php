<?php

use App\Book;
use App\Rating;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title'     => $faker->sentence,
        'author'    => $faker->name,
        'user_id'   => 1
    ];
});

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'user_id'   => 1,
        'book_id'   => mt_rand(1, 2),
        'rating'   => mt_rand(1, 5)
    ];
});

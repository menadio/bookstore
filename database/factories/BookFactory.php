<?php

use App\User;
use App\Book;
use App\Rating;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title'     => $faker->sentence,
        'author'    => $faker->name,
        'user_id'   => function (){
            return factory(User::class)->create();
        }
    ];
});

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'user_id'   => 1,
        'book_id'   => mt_rand(1, 2),
        'rating'   => mt_rand(1, 5)
    ];
});

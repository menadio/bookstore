<?php

use App\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First remove existing books records
        Book::truncate();

        factory(App\Book::class, 5)->create()->each(function ($book) {
            // Add book rating
            $ratings = factory(App\Rating::class, 1)->make();
            $book->ratings()->saveMany($ratings);
        });
    }
}

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

        factory(App\Book::class, 2)->create()->each(function ($book) {
            // Add book rating
            $ratings = factory(App\Rating::class, 1)->create(['book_id' => $book->id]);
            $book->ratings()->saveMany($ratings);
        });
    }
}

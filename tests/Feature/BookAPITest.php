<?php

namespace Tests\Feature;

use App\Book;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookAPITest extends TestCase
{
    use WithFaker;

    /**
     * Test if anyone can get a list of books
     *
     */
    public function testFetchBookList()
    {
        $response = $this->get('/api/books');

        $response->assertStatus(200);
    }

    /**
     * Get a specific book record
     */
    public function testFetchABookRecord()
    {
        $selectedBook = Book::all()->random();

        $response = $this->json('GET', '/api/books/'.$selectedBook->id);

        $response->assertStatus(200);
    }

    /**
     * Test if only an authenticated user can add/create a new book
     *
     */
    public function testCreateBookRecord()
    {
        // Generate a book using the book factory.
        $book = factory(Book::class)->make();

        // Get the user id from the book record.
        $user = User::find($book->user_id);

        // Authenticate the user and persist the record to the database.
        if (Passport::actingAs($user)) {
            $response = $this->json('POST', '/api/books', [
                'title'     => $book->title,
                'author'    => $book->author,
                'user_id'   => $book->user_id
            ]);
        };

        $response->assertStatus(201);
    }

    /**
     * Test if a user can update a book record
     * User MUST be authenticated to update book successfully
     * Book MUST belong to the authenticated user
     */
    public function testUpdateBookRecord()
    {
        // Select an existing user randomly & authenticate the user.
        $user = User::all()->random();
        Passport::actingAs($user);

        // User adds a book
        $selectedBook = factory(Book::class)->create(['user_id' => $user->id]);

        // Update the book.
        $response = $this->json('PUT', '/api/books/'.$selectedBook->id, [
            'title'     => $this->faker->sentence(),
            'author'    => $this->faker->name()
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test if a user can delete a book record
     * User MUST be authenticated to delete a book record successfully
     * Book MUST belong to the authenticated user
     */
    public function testDeleteBookRecord()
    {
        // Select an existing user randomly & authenticate the user.
        $user = User::all()->random();
        Passport::actingAs($user);

        // Get first book belonging to the user
        $selectedBook = factory(Book::class)->create(['user_id' => $user->id]);

        // Delete the book only if the user has added a book.
        $response = $this->json('DELETE', '/api/books/'.$selectedBook->id);

        $response->assertStatus(204);
    }

    /**
     * Test if only authenticated users can rate a book
     */
    public function testBookRecordRating()
    {
        // Select and authenticate user randomly
        $user = User::all()->random();
        Passport::actingAs($user);

        // Get a book randomly
        $selectedBook = Book::all()->random();

        // Rate the selected book
        $response = $this->json('POST', '/api/books/'.$selectedBook->id.'/rating', [
            'user_id'   => $user->id,
            'book_id'   => $selectedBook->id,
            'rating'    => mt_rand(1, 5)
        ]);

        $response->assertStatus(201);
    }
}

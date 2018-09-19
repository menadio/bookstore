<?php

namespace App\Http\Controllers;

use App\Book;
use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Allow only registered and logged in users to rate a book
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Method to store a book rating
     */
    public function store(Request $request, Book $book)
    {
        // Allow only logged in users to rate books
        if ($request->user()->id) {

            $rating = Rating::create([
                'user_id'   => $request->user()->id,
                'book_id'   => $book->id,
            ],
            [
                'rating'    => $request->rating
            ]);

            return new Rating($rating);
        } else {
            return response()->json(['error', 'Login to rate this book.'], 403);
        }
    }
}

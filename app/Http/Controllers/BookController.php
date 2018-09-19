<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Allow anyone view the listing of books
     * Allow anyone view a specific book
     * Only registered and logged in users can add, update or delete a book
     * Only registered and logged in users can rate a book
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of all books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(Book::all());
    }

    /**
     * Add a new book.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->id) {
            $book = Book::create($request->all());

            return new BookResource($book);
        } else {
            return response()->json(['error' => 'Login to add a new book.']);
        }
    }

    /**
     * Display a specific book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified book.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // Update book if the logged in user_id is the same as the book user_id
        if ($request->user()->id === $book->user_id) {
            $book->update($request->only(['title', 'author']));

            return new BookResource($book);
        } else {
            return response()->json(['error' => 'You do not have the permission for this operation'], 403);
        }
    }

    /**
     * Delete the specified book record.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Book $book)
    {
        // Delete book only if user_id matches book's user_id
        if ($request->user()->id === $book->user_id) {
            $book->delete();

            return response()->json(null, 204);
        } else {
            return response()->json(['error' => 'You do not have the permission for this operation'], 403);
        }
    }
}

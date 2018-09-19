<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id', 'book_id', 'rating'];

    /**
     * Rating/Book
     * A rating belongs to a book
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

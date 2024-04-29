<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reader;
use App\Models\Genre;
use App\Models\Book;


class LibrarianController extends Controller
{
    public function dashboard(){
        $total_readers = Reader::all()->count();
        $total_books = Book::all()->count();
        $total_genres = Genre::all()->count();
        return view('librarian.dashboard',
        compact('total_readers',
                'total_books',
                'total_genres'));
    }
}

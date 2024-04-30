<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reader;
use App\Models\Genre;
use App\Models\Book;
use App\Models\Borrow;

class ReaderController extends Controller
{
    public function dashboard()
    {
        $total_readers = Reader::all()->count();
        $total_books = Book::all()->count();
        $total_genres = Genre::all()->count();
        $genres = Genre::all();
        $active_rent = Borrow::where('status', 'ACCEPTED')->count();

        return view(
            'reader.dashboard',
            compact(
                'total_readers',
                'total_books',
                'total_genres',
                'genres',
                'active_rent'
            )
        );
    }
}

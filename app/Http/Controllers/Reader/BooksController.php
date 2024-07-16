<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;


class BooksController extends Controller
{
    public function filteredByTitle(String $keyword){
        $books = Book::where('title', 'LIKE', '%' . $keyword . '%')->paginate(5);
    
        return view('reader.book.filtered-by-title', compact('keyword', 'books'));
    }
    
    public function filteredByAuthors(String $keyword){
        $books = Book::where('authors', 'LIKE', '%' . $keyword . '%')->paginate(5);
    
        return view('reader.book.filtered-by-authors', compact('keyword', 'books'));
    }
    
    
    public function filteredByGenre(String $id){
        $genre = Genre::findOrFail($id);
        $books = $genre->Books()->paginate(5);
    
        return view('reader.book.filtered-by-genre', compact('genre', 'books'));
    }

    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view("reader.book.show", compact('book'));
    }
}

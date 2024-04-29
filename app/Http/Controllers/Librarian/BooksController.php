<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function filteredByTitle(String $keyword){
        $books = Book::where('title', 'LIKE', '%' . $keyword . '%')->paginate(5);
    
        return view('librarian.book.filtered-by-title', compact('keyword', 'books'));
    }
    
    public function filteredByAuthors(String $keyword){
        $books = Book::where('authors', 'LIKE', '%' . $keyword . '%')->paginate(5);
    
        return view('librarian.book.filtered-by-authors', compact('keyword', 'books'));
    }
    
    
    public function filteredByGenre(String $id){
        $genre = Genre::findOrFail($id);
        $books = $genre->Books()->paginate(5);
    
        return view('librarian.book.filtered-by-genre', compact('genre', 'books'));
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('librarian.book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Book::create([
            'title' => $request->input('title'),
            'authors' => $request->input('authors'),
            'description' => $request->input('description'),
            'released_at' => $request->input('released_at'),
            'cover_image' => $request->input('cover_image'),
            'pages' => $request->input('pages'),
            'language_code' => $request->input('language_code'),
            'isbn' => $request->input('isbn'),
            'in_stock' => $request->input('in_stock')
        ]);

        return redirect()->route('librarian.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view("librarian.book.show", compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view("librarian.book.edit", compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->authors = $request->input('authors');
        $book->description = $request->input('description');
        $book->released_at = $request->input('released_at');
        $book->cover_image = $request->input('cover_image');
        $book->pages = $request->input('pages');
        $book->language_code = $request->input('language_code');
        $book->isbn = $request->input('isbn');
        $book->in_stock = $request->input('in_stock');

        $book->save();
        return redirect()->route('librarian.books.show', $book->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('librarian.dashboard');
    }

    public function deletedbookIndex(){
        $books = Book::onlyTrashed()->get();

        return view('librarian.deletedBook.index', compact('books'));
    }

    public function deletedbookRestore(string $id){
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();

        return redirect()->route('librarian.deleted-book.index');
    }

    public function deletedbookDestroy(string $id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->forceDelete();
        return redirect()->route('librarian.deleted-book.index');
    }
}

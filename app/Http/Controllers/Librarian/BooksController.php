<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Book_genre;
use Illuminate\Http\Request;
use App\Models\Borrow;
use Illuminate\Support\Facades\Log;
use PHPUnit\Event\Code\Throwable;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function filteredByTitle(String $keyword)
    {
        $books = Book::where('title', 'LIKE', '%' . $keyword . '%')->paginate(5);

        return view('librarian.book.filtered-by-title', compact('keyword', 'books'));
    }

    public function filteredByAuthors(String $keyword)
    {
        $books = Book::where('authors', 'LIKE', '%' . $keyword . '%')->paginate(5);

        return view('librarian.book.filtered-by-authors', compact('keyword', 'books'));
    }


    public function filteredByGenre(String $id)
    {
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
        $genres = Genre::all();
        return view('librarian.book.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $book = Book::create([
                    "title" => $request->title,
                    "authors" => $request->authors,
                    "description" => $request->description,
                    "released_at" => $request->released_at,
                    "cover_image" => $request->cover_image,
                    "pages" => $request->pages,
                    "language_code" =>  $request->language_code ?? "hu",
                    "isbn" => $request->isbn,
                    "in_stock" => $request->in_stock,
                ]);

                $genre_ids = $request->genres;

                foreach ($genre_ids as $genre_id) {
                    Book_genre::create([
                        "book_id" => $book->id,
                        "genre_id" => $genre_id
                    ]);
                }
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

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
        $genres = Genre::all();
        $current_genres = [];
        foreach ($book->Genres as $genre) {
            $current_genres[] = $genre->id;
        }
        return view("librarian.book.edit", compact('book', 'genres', 'current_genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id)
    {
        $book = Book::findOrFail($id);

        $book->title = $request->title;
        $book->authors = $request->authors;
        $book->description = $request->description;
        $book->released_at = $request->released_at;
        $book->cover_image = $request->cover_image;
        $book->pages = $request->pages;
        $book->language_code = $request->language_code;
        $book->isbn = $request->isbn;
        $book->in_stock = $request->in_stock;

        $Book_genres = Book_genre::where('book_id', $id)->get();
        foreach ($Book_genres as $book_genre) {
            $book_genre->delete();
        }
        $genre_ids = $request->genres;
        foreach ($genre_ids as $genre_id) {
            book_genre::create([
                "book_id" => $book->id,
                "genre_id" => $genre_id
            ]);
        }
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

    public function deletedbookIndex()
    {
        $books = Book::onlyTrashed()->get();

        return view('librarian.deletedBook.index', compact('books'));
    }

    public function deletedbookRestore(string $id)
    {
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

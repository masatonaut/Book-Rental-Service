<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::select()->paginate(5);

        return view('librarian.genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('librarian.genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request)
    {
        $name = $request->input('name');
        $style = $request->input('style');

        Genre::create([
            'name' => $name,
            'style' => $style
        ]);

        // dd($name, $style);
        return redirect()->route('librarian.dashboard');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = Genre::findOrFail($id);
        return view('librarian.genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreRequest $request, string $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->name = $request->input('name');
        $genre->style = $request->input('style');

        $genre->save();

        return redirect()->route('librarian.genres.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('librarian.genres.index');
    }

    public function deletedGenreIndex(){
        $genres = Genre::onlyTrashed()->get();

        return view('librarian.deletedGenre.index', compact('genres'));
    }

    public function deletedGenreRestore(string $id){
        $genre = Genre::onlyTrashed()->findOrFail($id);
        $genre->restore();

        return redirect()->route('librarian.deleted-genre.index');
    }

    public function deletedGenreDestroy(string $id)
    {
        $genre = Genre::onlyTrashed()->findOrFail($id);
        $genre->forceDelete();
        return redirect()->route('librarian.deleted-genre.index');
    }
}

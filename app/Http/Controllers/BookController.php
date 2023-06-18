<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'isbn' => 'required|unique:l_book',
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publisher_year' => 'required',
            'short_description' => 'required',
            'cover' => 'required',
            'genre_id' => 'required',
        ]);

        Book::create($validatedData);

        // Redirect to the desired page after successful creation
        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publisher_year' => 'required',
            'short_description' => 'required',
            'cover' => 'required',
            'genre_id' => 'required',
        ]);

        $book->update($validatedData);

        // Redirect to the desired page after successful update
        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        // Redirect to the desired page after successful deletion
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}

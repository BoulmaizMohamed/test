<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'ISBN' => 'required|string|unique:books',
            'publication_date' => 'required|date',
            'genre_id' => 'required|exists:genres,id',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'string',
            'author_id' => 'exists:authors,id',
            'ISBN' => 'string|unique:books,ISBN,' . $book->id,
            'publication_date' => 'date',
            'genre_id' => 'exists:genres,id',
            'price' => 'numeric',
            'stock_quantity' => 'integer',
        ]);

        $book->update($request->all());

        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}

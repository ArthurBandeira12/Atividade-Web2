<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookControllerApi extends Controller
{
    /**
     * Lista livros (público)
     */
    public function index()
    {
        return response()->json(Book::all());
    }

    /**
     * Mostra um livro (público)
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Cria livro (admin / bibliotecario)
     */
    public function store(Request $request)
    {
        Gate::authorize('manage-library');

        $data = $request->validate([
            'title' => 'required|string',
            'pages' => 'required|integer',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = Book::create($data);

        return response()->json($book, 201);
    }

    /**
     * Atualiza livro (admin / bibliotecario)
     */
    public function update(Request $request, Book $book)
    {
        Gate::authorize('manage-library');

        $data = $request->validate([
            'title' => 'sometimes|string',
            'pages' => 'sometimes|integer',
            'publisher_id' => 'sometimes|exists:publishers,id',
            'author_id' => 'sometimes|exists:authors,id',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        $book->update($data);

        return response()->json($book);
    }

    /**
     * Remove livro (admin / bibliotecario)
     */
    public function destroy(Book $book)
    {
        Gate::authorize('manage-library');

        $book->delete();

        return response()->json([
            'message' => 'Livro removido com sucesso'
        ]);
    }
}

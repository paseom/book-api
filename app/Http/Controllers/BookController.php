<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    // GET /api/books
    public function index(): JsonResponse
    {
        $books = Book::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar semua buku',
            'data'    => $books
        ], 200);
    }

    // POST /api/books
    public function simpan(Request $request): JsonResponse
{
    $validated = $request->validate([
        'title'     => 'required|string|max:255',
        'author'    => 'required|string|max:255',
        'publisher' => 'required|string|max:255',
        'year'      => 'required|digits:4|integer',
    ]);

    $book = Book::create($validated);
    return response()->json([
        'success' => true,
        'message' => 'Buku berhasil disimpan',
        'data'    => $book
    ], 201);
}


    // GET /api/books/{id}
    public function show(string $id): JsonResponse
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Buku tidak ditemukan'], 404);
        }
        return response()->json(['success' => true, 'data' => $book], 200);
    }

    // PUT /api/books/{id}
    public function update(Request $request, string $id): JsonResponse
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Buku tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'title'     => 'sometimes|required|string|max:255',
            'author'    => 'sometimes|required|string|max:255',
            'publisher' => 'sometimes|required|string|max:255',
            'year'      => 'sometimes|required|digits:4|integer',
        ]);

        $book->update($validated);
        return response()->json(['success' => true, 'message' => 'Buku berhasil diperbarui', 'data' => $book], 200);
    }

    // DELETE /api/books/{id}
    public function destroy(string $id): JsonResponse
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Buku tidak ditemukan'], 404);
        }
        $book->delete();
        return response()->json(['success' => true, 'message' => 'Buku berhasil dihapus'], 200);
    }
}

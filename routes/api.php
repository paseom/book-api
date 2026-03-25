<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('books', BookController::class)->except(['store']);
Route::post('/api/books', [BookController::class, 'simpan'])->name('books.store');
Route::get('/books',          [BookController::class, 'index']   )->name('books.index');
Route::post('/books',         [BookController::class, 'simpan']  )->name('books.store');
Route::get('/books/{id}',     [BookController::class, 'show']    )->name('books.show');
Route::put('/books/{id}',     [BookController::class, 'update']  )->name('books.update');
Route::delete('/books/{id}',  [BookController::class, 'destroy'] )->name('books.destroy');


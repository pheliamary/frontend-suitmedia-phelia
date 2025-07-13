<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('app');
});

// Book Routes
Route::get('/books/book', [BookController::class, 'index'])->name('books.index');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::resource('books', BookController::class);

// Peminjam Routes
Route::resource('peminjam', PeminjamController::class)->only(['index', 'edit', 'update', 'destroy', 'store']);

// Pengembalian Routes  
Route::resource('ideas', PengembalianController::class)->only(['index', 'edit', 'update', 'destroy', 'store']);

// Alternative routes for navigation
Route::get('/peminjam', [PeminjamController::class, 'index'])->name('peminjam.index');
Route::get('/ideas', [PengembalianController::class, 'index'])->name('ideas.index');
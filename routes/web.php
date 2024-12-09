<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TvShowController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/author', [PublicController::class, 'author'])->name('author');

Route::get('/search', [MovieController::class, 'search'])->name('movies.search');

// movies
Route::get('/c/{id}/{slug}', [MovieController::class, 'category'])->name('movies.category');
Route::get('/movie/show/{id}/{slug}', [MovieController::class, 'show'])->name('movies.show');

// tv shows
Route::get('/tv/c/{id}/{slug}', [TvShowController::class, 'category'])->name('tv-show.index');

<?php

declare(strict_types=1);

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SuggestionsController;
use App\Http\Controllers\VotesController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => to_route('suggestions.index'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [RegisteredUserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [RegisteredUserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [RegisteredUserController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/suggestions', [SuggestionsController::class, 'index'])->name('suggestions.index');

Route::middleware('auth')->group(function () {
    Route::get('/suggestions/create', [SuggestionsController::class, 'create'])->name('suggestions.create');
    Route::post('/suggestions/create', [SuggestionsController::class, 'store'])->name('suggestions.store');

    Route::middleware('can:modify,suggestion')->group(function () {
        Route::get('/suggestions/{suggestion}/edit', [SuggestionsController::class, 'edit'])->name('suggestions.edit');
        Route::patch('/suggestions/{suggestion}/edit', [SuggestionsController::class, 'update'])->name('suggestions.update');
        Route::delete('/suggestions/{suggestion}', [SuggestionsController::class, 'destroy'])->name('suggestions.destroy');
    });

    Route::post('/suggestions/{suggestion}/vote', [VotesController::class, 'update'])->name('suggestions.vote');

    Route::get('/suggestions/{suggestion}/comment', [CommentsController::class, 'create'])->name('suggestions.comment');
    Route::post('/suggestions/{suggestion}/comment', [CommentsController::class, 'store'])->name('suggestions.comment.store');
    Route::get('/comment/{comment}/edit', [CommentsController::class, 'edit'])->name('suggestions.comment.edit');
    Route::patch('/comment/{comment}/edit', [CommentsController::class, 'update'])->name('suggestions.comment.update');
    Route::delete('/comment/{comment}', [CommentsController::class, 'destroy'])->name('suggestions.comment.destroy');
});
Route::get('/suggestions/{suggestion}', [SuggestionsController::class, 'show'])->name('suggestions.show');

Route::get('/forum', [DashboardController::class, 'forum'])->name('forum');
Route::middleware('auth')->group(function () {
    Route::get('/my-votes', [DashboardController::class, 'my_votes'])->name('my-votes');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
});

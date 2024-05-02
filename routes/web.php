<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;

Route::get('/', [PostsController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');

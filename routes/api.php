<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->name('posts.')
    ->group(function () {

        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/show/{post}', [PostController::class, 'show'])->name('show');
});

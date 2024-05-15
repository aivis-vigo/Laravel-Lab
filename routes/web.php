<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/posts');
Route::resource('posts', PostController::class);

URL::forceScheme('http');

require __DIR__.'/auth.php';

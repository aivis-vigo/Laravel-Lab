<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::redirect('/', '/posts');
Route::resource('posts', PostController::class);

URL::forceScheme('https');

require __DIR__.'/auth.php';

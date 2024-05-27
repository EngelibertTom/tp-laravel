<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function () {

    Route::get('/', 'index')->name('index');

    Route::get('/new-post-model', 'createPostModel')->name('createPostModel');

    Route::post('/new', 'store');

    Route::get('/new', 'create')->name('create');

    Route::get('/authors/{author}', 'showAuthor')->name('author.show');

    Route::get('/{post:slug}', 'show')->where([
        'post' => '[a-z0-9\-]+'
    ])->name('show');

    Route::get('/{post:slug}/edit', 'edit')->name('edit');

    Route::post('/{post:slug}/edit', 'update');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('/pages', [PagesController::class, 'index'])
    ->name('pages.index');

Route::get('pages/{id}', [PagesController::class, 'show'])
    ->name('pages.show');

Route::get('/search{title?}', [PostsController::class, 'search'])
    ->name('posts.search');

Route::get('/search', [PostsController::class, 'search'])
    ->name('posts.search');

Route::resource('/posts', PostsController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

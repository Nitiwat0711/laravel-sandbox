<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::name('api.')->middleware(['auth:api'])->group(function () {
//    Route::get('posts/search/{title}', [\App\Http\Controllers\API\PostsController::class, 'search']);
//    Route::apiResource('posts', \App\Http\Controllers\API\PostsController::class);
//});

//Route::name('api')->group(function (){
//
//});

Route::get('/name', function (){
    $name = "Nitiwat Apaikawee";
    $id = "6110400823";
    return [
        'name' => $name,
        'id' => $id
    ];
});
//
//Route::post('/posts', function (Request $request)
//{
//    $post = new \App\Models\Post;
//    $post->title = $request->input('title');
//    $post->content = $request->input('content');
//    $post->user_id = 1;
//    $post->save();
//    return $post;
//});
//
//Route::put('/posts', function ()
//{
//    return [
//        'title' => 'You requested by put method'
//    ];
//});

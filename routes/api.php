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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'books' => \App\Http\Controllers\Book\BookController::class,
    'authors' => \App\Http\Controllers\Authors\AuthorController::class,
    'favorites' => \App\Http\Controllers\Favorite\FavoriteController::class,
    'trash/books' => \App\Http\Controllers\Trash\BookTrashController::class,
    'users' => \App\Http\Controllers\User\UserController::class,
]);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('/', [BookController::class, 'store']);
    Route::get('/{id}', [BookController::class, 'show']);
    Route::put('/{id}', [BookController::class, 'update']);
    Route::delete('/{id}', [BookController::class, 'destroy']);
});
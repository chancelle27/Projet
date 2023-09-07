<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\articlesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/article', [articlesController::class , "create"]);
Route::get('/articles' , [articlesController::class , "read"]);
Route::get('/article' , [articlesController::class , "read_one"]);
Route::delete('/article' , [articlesController::class , "drop"]);
Route::put('/article' , [articlesController::class , "update"]);
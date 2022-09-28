<?php

use App\Http\Controllers\Api\CoinsApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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



Route::get("/", [CoinsApiController::class, "index"]);

Route::get("/news", [NewsApiController::class, "index"]);

Route::get("/listings/", [UsersController::class, "show"])->middleware('auth');

Route::put("/listings/sell/", [UsersController::class, "sell"])->middleware('auth');

Route::put("/listings/buy/", [UsersController::class, "buy"])->middleware('auth');

Route::get("/user/portfolio", [UsersController::class, "portfolio"])->middleware('auth');

Route::patch("/user/portfolio", [UsersController::class, "addFiat"])->middleware('auth');

Route::get("/user/transactions", [UsersController::class, "transactions"])->middleware('auth');

Route::get("/user/search", [UsersController::class, "search"])->middleware('auth');

require __DIR__.'/auth.php';

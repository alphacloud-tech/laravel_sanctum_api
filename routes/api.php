<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\User\AuthController;
use App\Models\Product;
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

// public route 
Route::post('/v1/register', [AuthController::class, 'register']);
Route::post('/v1/login', [AuthController::class, 'login']);

Route::get('/v1/product', [ProductController::class, 'index']);
Route::get('/v1/product{id}', [ProductController::class, 'show']);
Route::get('/v1/product/search/{name}', [ProductController::class, 'search']);

// Route::resource('/v1/product', ProductController::class);


// protected route 
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('v1/product', [ProductController::class, 'store']);
    Route::put('v1/product/{id}', [ProductController::class, 'update']);
    Route::delete('v1/product/{id}', [ProductController::class, 'destroy']);
    Route::post('/v1/logout', [AuthController::class, 'logout']);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

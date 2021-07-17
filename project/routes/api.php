<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('StoreProduct', [ProductController::class, 'StoreProduct']);

Route::get('Products', [ProductController::class, 'Products']);

Route::get('Products_Details/{id}', [ProductController::class, 'Products_Details']);

Route::post('UpdateProduct/{id}', [ProductController::class, 'UpdateProduct']);

Route::get('DeleteProduct/{id}', [ProductController::class, 'DeleteProduct']);
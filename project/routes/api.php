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


Route::post('Store_Product', [ProductController::class, 'Store_Product']);

Route::get('Products', [ProductController::class, 'Products']);

Route::get('Products_Details/{id}', [ProductController::class, 'Products_Details']);

Route::post('Update_Product/{id}', [ProductController::class, 'Update_Product']);

Route::delete('Delete_Product/{id}', [ProductController::class, 'Delete_Product']);
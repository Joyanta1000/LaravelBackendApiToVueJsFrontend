<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\isLoggedIn;

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


	Route::post('/Register', [UserController::class, 'Register']);
	Route::post('Login', [UserController::class, 'Login'])->name('Login');


	// Route::middleware([isLoggedIn::class])->group(function () {
		Route::post('Store_Product', [ProductController::class, 'Store_Product'])->middleware('auth:api');

Route::get('Products', [ProductController::class, 'Products']);

Route::get('Products_Details/{id}', [ProductController::class, 'Products_Details'])->middleware('auth:api');

Route::post('Update_Product/{id}', [ProductController::class, 'Update_Product'])->middleware('auth:api');

Route::delete('Delete_Product/{id}', [ProductController::class, 'Delete_Product'])->middleware('auth:api');

Route::post('Logout', [UserController::class, 'Logout']);
	// });




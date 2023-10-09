<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add_product',[ProductsController::class,'add_product']);

Route::get('users',[AdminUserController::class,'index']);

Route::get('products',[AdminProductController::class,'index']);

Route::post('login',[AdminController::class,'login']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('details', [AdminController::class,'details']);
});

Route::post('create',[AdminProductController::class,'add']);

Route::delete('products/{id}',[AdminProductController::class,'delete']);

Route::delete('products',[AdminProductController::class,'deleteMultiple']);

Route::get('products/{id}/edit',[AdminProductController::class,'edit']);

Route::post('products/{id}',[AdminProductController::class,'update']);


Route::prefix('admins')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.show',
            'uses' => 'App\Http\Controllers\CategoryController@show',
        ]);
    });
});

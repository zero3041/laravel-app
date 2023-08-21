<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;


Route::get('products',[
    ProductsController::class,
    'index'
]);

Route::get('/',[
    PagesController::class,
    'index'
]);

Route::get('/login',[
    LoginController::class,
    'login'
])->name('login');

Route::post('/login', [UserController::class, 'login']);

Route::post('/register', [UserController::class, 'register']);

Route::get('/admins', function () {
    return view('admin.home');
});

Route::prefix('admins')->group(function (){

    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
        ]);
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@detele',
        ]);
    });

    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
        ]);
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create',
        ]);
        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'App\Http\Controllers\MenuController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete',
        ]);
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [
            'as' => 'product.index',
            'uses' => 'App\Http\Controllers\AdminProductController@index',
        ]);
        Route::get('/create', [
            'as' => 'product.create',
            'uses' => 'App\Http\Controllers\AdminProductController@create',
        ]);
        Route::POST('/store', [
            'as' => 'product.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'product.edit',
            'uses' => 'App\Http\Controllers\AdminProductController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'product.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update',
        ]);
        Route::delete('/delete/{id}', [
            'as' => 'product.delete',
            'uses' => 'App\Http\Controllers\AdminProductController@delete',
        ]);
        Route::post('/deleteMultiple',[
            'as' => 'product.deleteMultiple',
            'uses' => 'App\Http\Controllers\AdminProductController@deleteMultiple',
        ]);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'App\Http\Controllers\AdminUserController@index',
        ]);
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'App\Http\Controllers\AdminUserController@create',
        ]);
        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'App\Http\Controllers\AdminUserController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'App\Http\Controllers\AdminUserController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'App\Http\Controllers\AdminUserController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'App\Http\Controllers\AdminUserController@delete',
        ]);
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'App\Http\Controllers\RoleController@index',
        ]);
        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'App\Http\Controllers\RoleController@create',
        ]);
        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'App\Http\Controllers\RoleController@store',
        ]);
    });


    Route::get('/forget-password', [PasswordResetController::class, 'showResetForm'])->name('password.request');
    Route::post('/send-reset-link', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetFormPass'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'handleResetPassword'])->name('password.update');
    Route::prefix('login')->group(function () {
        Route::get('/',[
            'as' => 'logins.login',
            'uses' => 'App\Http\Controllers\AdminController@loginAdmin'
        ]);
        Route::post('/',[
            'as' => 'logins.login',
            'uses' => 'App\Http\Controllers\AdminController@login'
        ]);
        Route::get('/register',[
            'as' => 'logins.register',
            'uses' => 'App\Http\Controllers\AdminController@registerAdmin'
        ]);
        Route::post('/register',[
            'as' => 'logins.register',
            'uses' => 'App\Http\Controllers\AdminController@register'
        ]);
    });
});

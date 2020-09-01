<?php

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

/**
 * Rota = api/auth/login
 */
Route::post('auth/login', 'Api\AuthController@login');

/**
 * Rota = api/auth/
 */
Route::group(['middleware' => 'apiJwt', 'prefix' => 'auth'], function () {
    Route::get('perfil', 'Api\AuthController@perfil');
    Route::get('logout', 'Api\AuthController@logout');
    Route::get('refresh', 'Api\AuthController@refresh');
});

/**
 * Rota = api/users/
 */
Route::group(['middleware' => 'apiJwt', 'prefix' => 'users'], function () {
    Route::get('', 'Api\UserController@index');
    Route::post('store', 'Api\UserController@store');
    Route::get('show/{id}', 'Api\UserController@show');
    Route::put('update/{id}', 'Api\UserController@update');
    Route::delete('delete/{id}', 'Api\UserController@destroy');
});

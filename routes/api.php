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

Route::post('auth/login', 'Api\AuthController@login');

Route::group([
    'middleware' => 'apiJwt',
    'prefix' => 'auth'
], function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('perfil', 'Api\AuthController@perfil');
});

Route::group(['middleware' => ['apiJwt']], function () {
    Route::get('users', 'Api\UserController@index');
});

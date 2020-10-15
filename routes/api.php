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
 * Rota = api/usuarios/
 */
Route::group(['middleware' => 'apiJwt', 'prefix' => 'usuarios'], function () {
    Route::get('', 'Api\UsuarioController@index');
    Route::post('store', 'Api\UsuarioController@store')->middleware('checkRole');
    Route::get('show/{id}', 'Api\UsuarioController@show');
    Route::put('update/{id}', 'Api\UsuarioController@update')->middleware('checkUserProfile');
    Route::delete('delete/{id}', 'Api\UsuarioController@destroy')->middleware('checkRole');
    Route::post('upload', 'Api\UsuarioController@upload');
});

/**
 * Rota = api/pessoas/
 */
Route::group(['middleware' => 'apiJwt', 'prefix' => 'pessoas'], function () {
    Route::get('', 'Api\PessoaController@index');
    Route::post('store', 'Api\PessoaController@store')->middleware('checkRole');
    Route::get('show/{id}', 'Api\PessoaController@show');
    Route::put('update/{id}', 'Api\PessoaController@update')->middleware('checkUserProfile');
    Route::delete('delete/{id}', 'Api\PessoaController@destroy')->middleware('checkRole');
});

/**
 * Rola = api/roles/
 */
Route::group(['middleware' => 'apiJwt', 'prefix' => 'roles'], function () {
    Route::get('', 'Api\RoleController@index');
});

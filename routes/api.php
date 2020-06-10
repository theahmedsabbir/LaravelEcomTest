<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// cart route groups
Route::group( ['prefix' => '/cart'], function(){
	Route::get('/', 'API\CartsController@index')->name('cart.index');
	Route::post('/store', 'API\CartsController@store')->name('cart.store');
	Route::post('/update', 'API\CartsController@update')->name('cart.update');
	Route::post('/delete', 'API\CartsController@destroy')->name('cart.delete');
});

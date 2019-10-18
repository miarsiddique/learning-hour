<?php

use Illuminate\Http\Request;

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

Route::get('/todos', 'TodoController')->middleware('auth:api');

Route::post('login', 'UserController@login')->name('login');
Route::post('register', 'UserController@register');
Route::post('user-register', 'UserController@user_register');

Route::group(['middleware' => 'auth:api'], function()
{
   Route::get('details', 'UserController@details');
});


Route::group(['prefix' => 'common'], function() {
	Route::get('db-value', 'CommonController@dbValue');
	Route::get('users', 'CommonController@usersList');
}) ;
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

/**
 * users エンドポイント
 */
Route::group([
		'middleware' => [],
		'prefix'     => 'users',
],
function () {
	Route::get( '/{client_id}',      'Api\UserController@get')->name('api.users.get');
// 	Route::post('/',                 'Api\UserController@post');
	Route::put( '/{client_id}',      'Api\UserController@put');
// 	Route::delete('/{client_id}',    'Api\UserController@delete');
});

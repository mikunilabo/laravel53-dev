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
 * clients エンドポイント
 */
Route::group([
		'middleware' => [],
		'prefix'     => 'clients',
		'namespace'  => 'Api',
],
function () {
	Route::get( '/{client_id}',      'ClientController@get')->name('api.clients.get');
// 	Route::post('/',                 'ClientController@post');
	Route::put( '/{client_id}',      'ClientController@put');
// 	Route::delete('/{client_id}',    'ClientController@delete');
});

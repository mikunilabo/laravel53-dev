<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Auth...
 */
Auth::routes();

Route::get('/',                       'Controller@index');

Route::get('/home',                   'HomeController@index');


/**
 * Passport Test...
 */
Route::group([
	'middleware' => [],
	"prefix"     => 'passport',
], function () {
	Route::get( 'token/get',          'PassportController@getTokens');
	Route::get( 'token/post',         'PassportController@postToken');
	
	Route::get( 'clients/post',       'PassportController@postClients');
});

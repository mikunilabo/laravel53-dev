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
	Route::get( 'token/get',          'Api\PassportController@getTokens');
	Route::get( 'token/post',         'Api\PassportController@postToken');
	
	Route::get( 'clients/get',        'Api\PassportController@getClients');
	Route::get( 'clients/post',       'Api\PassportController@postClients');
});

/**
 * 
 */
Route::group([
		'middleware' => [],
		"prefix"     => 'test/api/users',
], function () {
	Route::get( 'get',                'TestController@getUsers');
	Route::get( 'put',                'TestController@putUsers');
});
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

Route::group([
        'middleware' => ['web'],
], function () {
    
    Route::get('/',                       'Controller@index');
    Route::get('/home',                   'HomeController@index');
    
    
    /**
     * Some Test...
     */
    Route::group([
            'prefix'     => 'test',
    ], function () {
        Route::get( '/',                  'TestController@index');
    });
    
    
    /**
     * Passport Test...
     */
    Route::group([
            'prefix'     => 'passport',
            'namespace'  => 'Api',
    ], function () {
        Route::get( 'token/get',          'PassportController@getTokens');
        Route::get( 'token/post',         'PassportController@postToken');
        
        Route::get( 'clients/get',        'PassportController@getClients');
        Route::get( 'clients/post',       'PassportController@postClients');
    });
    
    
    /**
     * API Test...
     */
    Route::group([
            'prefix'     => 'api/clients',
    ], function () {
        Route::get( 'get',                'PassportTestController@getClients');
        Route::get( 'put',                'PassportTestController@putClients');
    });
    
});
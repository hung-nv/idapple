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

Route::get( '/', function () {
	return view( 'backend.auth.login' );
} );

Route::get( '/id', [ 'as' => 'apple.getid', 'uses' => 'Backend\AppleController@getFirstId' ]);
Route::get( '/the', [ 'as' => 'creditCard.getthe', 'uses' => 'Backend\CreditCardController@getFirstNumber' ]);
Route::get('/idsp/{email}', ['as' => 'support.insert', 'uses' => 'Backend\SupportController@insert' ]);
Route::get('/addport/{port}', ['as' => 'port.store', 'uses' => 'Backend\PortController@store']);
Route::get('/deleteport/{port}', ['as' => 'port.delete', 'uses' => 'Backend\PortController@delete']);
Route::get('/viewport', ['as' => 'port.view', 'uses' => 'Backend\PortController@view']);


Route::group( [ 'namespace' => 'Backend' ], function () {
	Route::get( 'login', [ 'as' => 'login', 'uses' => 'LoginController@getLogin' ] );
	Route::post( 'login', [ 'as' => 'login', 'uses' => 'LoginController@postLogin' ] );
	Route::get( 'logout', [ 'as' => 'logout', 'uses' => 'LoginController@getLogout' ] );
} );

Route::group( [ 'middleware' => 'auth', 'namespace' => 'Backend' ], function () {
	Route::get( '/', [ 'as' => 'admin.dashboard', 'uses' => 'AdminSiteController@index' ] );
	Route::resource( 'apple', 'AppleController', [ 'only' => [ 'index' ] ] );
	Route::get( 'user/update-account', [ 'as' => 'user.updateAccount', 'uses' => 'UserController@updateAccount' ] );
	Route::put( 'user/update-account', [ 'as' => 'user.putUpdateAccount', 'uses' => 'UserController@account' ] );
	Route::resource( 'menuSystem', 'MenuSystemController', [ 'except' => [ 'show' ] ] );
	Route::resource( 'user', 'UserController' );
	Route::get( 'apple/insertId', [ 'as' => 'apple.insert', 'uses' => 'AppleController@insert' ] );
	Route::post( 'apple/store', [ 'as' => 'apple.store', 'uses' => 'AppleController@store' ] );
	Route::resource( 'apple', 'AppleController', [ 'only' => [ 'destroy' ] ] );
	Route::resource( 'support', 'SupportController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::resource( 'creditCard', 'CreditCardController', [ 'only' => [ 'create', 'store', 'destroy', 'index' ] ] );
	Route::get('support/download', ['as' => 'support.download', 'uses' => 'SupportController@download']);
	Route::get('apple/download', ['as' => 'apple.download', 'uses' => 'AppleController@download']);
	Route::get('credit/download', ['as' => 'creditCard.download', 'uses' => 'CreditCardController@download']);
	Route::get('support/deleteAll', ['as' => 'support.deleteAll', 'uses' => 'SupportController@deleteAll']);
	Route::get('creditCard/deleteAll', ['as' => 'creditCard.deleteAll', 'uses' => 'CreditCardController@deleteAll']);
	Route::get('apple/deleteAll', ['as' => 'apple.deleteAll', 'uses' => 'AppleController@deleteAll']);

	Route::resource( 'port', 'PortController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::get('port/deleteAll', ['as' => 'port.deleteAll', 'uses' => 'PortController@deleteAll']);
} );
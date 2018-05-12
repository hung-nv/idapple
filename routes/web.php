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
Route::get( '/add-id/{id}', [ 'as' => 'apple.insertDirect', 'uses' => 'Backend\AppleController@insertDirect' ]);
Route::get( '/the', [ 'as' => 'creditCard.getthe', 'uses' => 'Backend\CreditCardController@getFirstNumber' ]);
Route::get( '/add-the/{number}', [ 'as' => 'creditCard.insertDirect', 'uses' => 'Backend\CreditCardController@insertDirect' ]);
Route::get('/idsp/{email}', ['as' => 'support.insert', 'uses' => 'Backend\SupportController@insert' ]);
Route::get('/addport/{port}', ['as' => 'port.store', 'uses' => 'Backend\PortController@store']);
Route::get('/deleteport/{port}', ['as' => 'port.delete', 'uses' => 'Backend\PortController@delete']);
Route::get('/viewport', ['as' => 'port.view', 'uses' => 'Backend\PortController@view']);
Route::get( '/view-serial', [ 'as' => 'seria.getid', 'uses' => 'Backend\SeriaController@getFirstId' ]);
Route::get( '/view-id-serial', [ 'as' => 'viewSeria.getid', 'uses' => 'Backend\ViewSeriaController@getFirstId' ]);
Route::get('/id-seria/{seria}', ['as' => 'idSeria.insert', 'uses' => 'Backend\IdSeriaController@insert' ]);
Route::get('/id-seria-support/{seria}', ['as' => 'idSeriaSupport.insert', 'uses' => 'Backend\IdSeriaSupportController@insert' ]);
Route::get('/credit-card-support/{number}', ['as' => 'creditCardSupport.insert', 'uses' => 'Backend\CreditCardSupportController@insert' ]);

Route::group( [ 'namespace' => 'Backend' ], function () {
	Route::get( 'login', [ 'as' => 'login', 'uses' => 'LoginController@getLogin' ] );
	Route::post( 'login', [ 'as' => 'login', 'uses' => 'LoginController@postLogin' ] );
	Route::get( 'logout', [ 'as' => 'logout', 'uses' => 'LoginController@getLogout' ] );
} );

Route::group( [ 'middleware' => 'auth', 'namespace' => 'Backend' ], function () {
	Route::get( '/', [ 'as' => 'admin.dashboard', 'uses' => 'AdminSiteController@index' ] );
	Route::get( 'user/update-account', [ 'as' => 'user.updateAccount', 'uses' => 'UserController@updateAccount' ] );
	Route::put( 'user/update-account', [ 'as' => 'user.putUpdateAccount', 'uses' => 'UserController@account' ] );
	Route::resource( 'menuSystem', 'MenuSystemController', [ 'except' => [ 'show' ] ] );
	Route::resource( 'user', 'UserController' );

	Route::resource( 'support', 'SupportController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::get('support/deleteAll', ['as' => 'support.deleteAll', 'uses' => 'SupportController@deleteAll']);
	Route::get('support/download', ['as' => 'support.download', 'uses' => 'SupportController@download']);

	Route::resource( 'creditCard', 'CreditCardController', [ 'only' => [ 'create', 'store', 'destroy', 'index' ] ] );
	Route::get('credit/download', ['as' => 'creditCard.download', 'uses' => 'CreditCardController@download']);
	Route::get('creditCard/deleteAll', ['as' => 'creditCard.deleteAll', 'uses' => 'CreditCardController@deleteAll']);


	Route::resource( 'apple', 'AppleController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::get( 'apple/insertId', [ 'as' => 'apple.insert', 'uses' => 'AppleController@insert' ] );
	Route::post( 'apple/store', [ 'as' => 'apple.store', 'uses' => 'AppleController@store' ] );
	Route::get('apple/download', ['as' => 'apple.download', 'uses' => 'AppleController@download']);
	Route::get('apple/deleteAll', ['as' => 'apple.deleteAll', 'uses' => 'AppleController@deleteAll']);

	Route::resource( 'port', 'PortController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::get('port/deleteAll', ['as' => 'port.deleteAll', 'uses' => 'PortController@deleteAll']);

	Route::resource( 'seria', 'SeriaController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::get('seria/deleteAll', ['as' => 'seria.deleteAll', 'uses' => 'SeriaController@deleteAll']);
	Route::get('seria/download', ['as' => 'seria.download', 'uses' => 'SeriaController@download']);
	Route::get( 'seria/insertId', [ 'as' => 'seria.insert', 'uses' => 'SeriaController@insert' ] );
	Route::post( 'seria/store', [ 'as' => 'seria.store', 'uses' => 'SeriaController@store' ] );

	Route::resource( 'viewSeria', 'ViewSeriaController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::get('viewSeria/deleteAll', ['as' => 'viewSeria.deleteAll', 'uses' => 'ViewSeriaController@deleteAll']);
	Route::get('viewSeria/download', ['as' => 'viewSeria.download', 'uses' => 'ViewSeriaController@download']);
	Route::get( 'viewSeria/insertId', [ 'as' => 'viewSeria.insert', 'uses' => 'ViewSeriaController@insert' ] );
	Route::post( 'viewSeria/store', [ 'as' => 'viewSeria.store', 'uses' => 'ViewSeriaController@store' ] );

	Route::resource( 'idSeria', 'IdSeriaController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::get('idSeria/download', ['as' => 'idSeria.download', 'uses' => 'IdSeriaController@download']);
	Route::get('idSeria/deleteAll', ['as' => 'idSeria.deleteAll', 'uses' => 'IdSeriaController@deleteAll']);

	Route::resource( 'idSeriaSupport', 'IdSeriaSupportController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::get('idSeriaSupport/download', ['as' => 'idSeriaSupport.download', 'uses' => 'IdSeriaSupportController@download']);
	Route::get('idSeriaSupport/deleteAll', ['as' => 'idSeriaSupport.deleteAll', 'uses' => 'IdSeriaSupportController@deleteAll']);

	Route::resource( 'creditCardSupport', 'CreditCardSupportController', [ 'only' => [ 'index', 'destroy' ] ] );
	Route::get('creditCardSupport/download', ['as' => 'creditCardSupport.download', 'uses' => 'CreditCardSupportController@download']);
	Route::get('creditCardSupport/deleteAll', ['as' => 'creditCardSupport.deleteAll', 'uses' => 'CreditCardSupportController@deleteAll']);
} );
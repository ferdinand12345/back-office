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

Route::group( [ 'middleware' => 'not_in_session' ], function() {
	Route::get( '/login', 'AuthController@login_form' );
	Route::post( '/login', 'AuthController@login_process' );
} );
Route::group( [ 'middleware' => 'in_session' ], function() {
	Route::get( '/', 'ClientController@index' );
	Route::get( '/dashboard', 'ClientController@index' );
	Route::get( '/client', 'ClientController@index' );
	Route::get( '/client/{id}', 'ClientController@edit_form' );
	Route::post( '/client/{id}', 'ClientController@edit_process' );
	Route::group( [ 'middleware' => 'is_admin' ], function() {
		Route::get( '/create-user', 'UserController@user_create_form' );
		Route::post( '/create-user', 'UserController@user_create_process' );
		Route::get( '/user', 'UserController@index' );
	} );
	Route::get( '/logout', 'AuthController@logout_process' );
} );
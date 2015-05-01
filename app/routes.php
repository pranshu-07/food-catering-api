<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::post('v1/api/login', array('as'=>'api.login','uses' => 'UsersController@getApikey'));
Route::post('user', array('uses'=>'UsersController@store'));
Route::api(array('version' => 'v1', 'prefix' => 'v1/api', 'before' => 'api.auth'), function(){
	Route::resource('user', 'UsersController', array('except' => array('store', 'show')));
	Route::resource('item', 'ItemsController', array('except'=>array('show', 'create', 'index')));
	Route::resource('order', 'OrdersController');
});

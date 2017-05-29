<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Illuminate\Support\Facades\Artisan::call('migrate');

Route::auth();

Route::get('/', function () {
	return view(Auth::check() ? 'dashboard' : 'auth.login');
});

Route::any('{unit}/{method}/{id?}', 'RoutesController@index');

/*
Route::get('/clubs/lists', 'ClubsController@lists');
Route::get('/clubs/add', 'ClubsController@add');

Route::get('/federations/lists', 'FederationsController@lists');
Route::get('/federations/add', 'FederationsController@add');
Route::get('/federations/import', 'FederationsController@import');

Route::get('/servers/lists', 'ServersController@lists');
Route::get('/servers/add', 'ServersController@add');

Route::get('/subdomains/lists', 'SubdomainsController@lists');
Route::get('/subdomains/add', 'SubdomainsController@add');

Route::get('/settings/users', 'SettingsController@users');
*/
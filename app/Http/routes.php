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

Route::group(['middleware' => 'apikey', 'prefix' => 'api'], function () {
    Route::get('status', [
        'as' => 'status',
        'uses' => 'ApiController@status'
    ]);
    Route::post('get_federation_url', [
        'as' => 'get_federation_url',
        'uses' => 'ApiController@get_federation_url'
    ]);
    Route::post('register_club', [
        'as' => 'register_club',
        'uses' => 'ApiController@register_club'
    ]);
    Route::post('mark_registration', [
        'as' => 'mark_registration',
        'uses' => 'ApiController@mark_registration'
    ]);
    Route::post('update_default_activity', [
        'as' => 'update_default_activity',
        'uses' => 'ApiController@update_default_activity'
    ]);
    Route::post('validate_account_key', [
        'as' => 'validate_account_key',
        'uses' => 'ApiController@validate_account_key'
    ]);
    Route::post('get_available_countries', [
        'as' => 'get_available_countries',
        'uses' => 'ApiController@get_available_countries'
    ]);
    Route::post('get_available_activities', [
        'as' => 'get_available_activities',
        'uses' => 'ApiController@get_available_activities'
    ]);
});

Route::get('/', function () {
	return view(Auth::check() ? 'dashboard' : 'auth.login');
});

Route::any('ajax/{unit}/{method}/{id?}', 'RoutesController@ajax');
Route::any('{unit}/{method}/{id?}', 'RoutesController@index')->middleware('roles');

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
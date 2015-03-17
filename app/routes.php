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


Route::get('reflect', function(){
	return Response::json($_GET);
});

Route::group(
	['prefix' => 'api/v1'],
	function () {

		/**
		 * API OAUTH
		 */

		Route::controller('oauth', 'OAuthController');

	}
);

Route::get('/', function()
{
	return View::make('hello');
});

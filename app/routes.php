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

Route::get('/', array('as' => 'index', function()
{
	// $config = Config::get('l4setting');
	return View::make('doc.introduction')->with('config',$config);
}));

Route::get('doc/introduction', array('as' => 'doc_introduction', 'uses'=>'DocController@Introduction'));
Route::resource('doc', 'DocController');

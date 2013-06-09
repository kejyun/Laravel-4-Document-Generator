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
// 首頁
Route::get('/', array('as' => 'index', function()
{
	return 'index';
	// return View::make('doc.zhtw.preface.introduction');
}));
// 文件
Route::get('docs/{target}', array('as' => 'doc_index', 'uses'=>'DocController@Index'));


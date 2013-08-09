<?php
/**
 * 作者:KeJyun
 * 建立日期:2013-06-09
 * 最後修改日期:2013-06-09
 * 聯絡方式:kejyun@gmail.com
 */
// 首頁
Route::get('/', array('as' => 'index', function()
{
	return 'index';
}));
// 文件
Route::get('docs/{target}', array('as' => 'doc_index', 'uses'=>'DocController@Index'));
Route::get('docs', function ()
{
	return View::make('doc.zhtw.docindex');
});
// 文件產生器
Route::get('docsgen', array('as' => 'docgen_index', 'uses'=>'DocgenController@Index'));


<?php
/**
 * Laravel 4 文件產生器控制器
 *     作者:KeJyun
 *     建立日期:2013-06-09
 *     最後修改日期:2013-06-09
 *     聯絡方式:kejyun@gmail.com
 */
class DocController extends \BaseController {
	// 樣板
	protected $layout = 'layouts.main';
	// 視圖路由
	public function index($target='introduction')
	{
		// 撈取設定
		$config = Config::get('l4doc_setting');
		$app = Config::get('app');
		// 語言
		$language = $app['locale'];
		// 撈取視圖目標
		$target = (in_array($target, $config['allow_route']['doc'])) ? $target : 'introduction';
		// 撈取view子目錄
		foreach ($config['allow_route']['subdoc'] as $target_index => $target_items) {
			if (in_array($target, $target_items)) {
				$view_path = $target_index;
				break;
			}
		}
		// 建立視圖路徑
		$viewmake = "doc.{$language}.{$view_path}.{$target}";
		$this->layout->content = View::make($viewmake);
	}
}
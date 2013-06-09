<?php

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
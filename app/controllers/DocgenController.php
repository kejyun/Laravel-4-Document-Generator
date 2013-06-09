<?php
/**
 * 靜態文件產生器
 *     作者:KeJyun
 *     建立日期:2013-06-09
 *     最後修改日期:2013-06-09
 *     聯絡方式:kejyun@gmail.com
 */
class DocgenController extends \BaseController {
    // 文件網址
    private $_site_url = 'http://doc.laravel';
    // 文件產生資料夾:相對於根目錄
    private $_docgen_dir = 'docgen';
    private $_replace_pattern = array('/\(@\)/','/\({\)/','/\(}\)/');
    private $_replace_string = array('@','{','}');
    public function index()
    {
        // 撈取設定
        $docpath = Config::get('l4doc_setting.generate_path');
        // 建立文件資料夾
        if (!is_dir($this->_docgen_dir)) {
            mkdir($this->_docgen_dir);
        }
        $ch = curl_init();
        foreach ($docpath as $folder => $path) {
            if (is_string($path)) 
            {
                // 字串:建立路徑資料
                $curl_path = "{$folder}{$path}";
                $doc_path = "{$this->_docgen_dir}{$curl_path}";
                if (!is_dir($doc_path))
                {
                    // 資料夾不存在，建立文件資料夾
                    mkdir($doc_path);
                }
                curl_setopt($ch, CURLOPT_URL, "{$this->_site_url}{$curl_path}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                $result = curl_exec($ch);
                $result = preg_replace($this->_replace_pattern , $this->_replace_string , $result);
                $fp = fopen("{$doc_path}/index.html", 'w');
                fwrite($fp, $result);
                fclose($fp);
            }
            elseif (is_array($path))
            {
                // 陣列:建立陣列路徑資料
                $sub_folder = $folder;
                $check_path = "{$this->_docgen_dir}/{$sub_folder}";
                if (!is_dir($check_path)) {
                    mkdir($check_path);
                }  
                foreach ($path as $folder => $child_path) 
                {
                    $curl_path = "{$sub_folder}{$child_path}";
                    $doc_path = "{$this->_docgen_dir}{$curl_path}";
                    if (!is_dir($doc_path)) 
                    {
                        // 資料夾不存在，建立文件資料夾
                        mkdir($doc_path);
                    }
                    curl_setopt($ch, CURLOPT_URL, "{$this->_site_url}{$curl_path}");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                    $result = curl_exec($ch);
                    $result = preg_replace($this->_replace_pattern , $this->_replace_string , $result);
                    $fp = fopen("{$doc_path}/index.html", 'w');
                    fwrite($fp, $result);
                    fclose($fp);
                }
            }
        }
        echo 'Laravel 4 Document Generate Finish';
    }
}
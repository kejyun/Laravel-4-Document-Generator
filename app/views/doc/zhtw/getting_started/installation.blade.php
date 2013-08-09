@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.installation') }}</h1>

<ul>
    <li>
        <a href="#install-composer">{{ Lang::get('l4doc.docs_title.getting_started.installation.install_composer') }}</a>
    </li>
    <li>
        <a href="#install-laravel">{{ Lang::get('l4doc.docs_title.getting_started.installation.install_laravel') }}</a>
    </li>
    <li>
        <a href="#server-requirements">{{ Lang::get('l4doc.docs_title.getting_started.installation.server_requirements') }}</a>
    </li>
    <li>
        <a href="#configuration">{{ Lang::get('l4doc.docs_title.getting_started.installation.configuration') }}</a>
    </li>
    <li>
        <a href="#pretty-urls">{{ Lang::get('l4doc.docs_title.getting_started.installation.pretty_urls') }}</a>
    </li>
</ul>

<p><a name="install-composer"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.install_composer') }}</h2>

<p>
    Laravel 使用 <a href="http://getcomposer.org" target="_blank">Composer</a> 作為套件管理軟體，首先下載 <code>composer.phar</code>，你可以將 PHAR 檔案放到你的專案目錄，或者將檔案移至 <code>usr/local/bin</code> ，讓整個系統都可以存取到這個檔案，在 Windows 中，你可以使用 Composer 中的 <a href="https://getcomposer.org/Composer-Setup.exe">Windows installer</a> 進行安裝
</p>

<p><a name="install-laravel"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.install_laravel') }}</h2>

<h3>透過 Composer Create-Project 建立 Laravel 專案</h3>

<p>
    你可以透過 Composer 的 <code>create-project</code> 指令建立您的 Laravel 專案
</p>

<pre><code>composer create-project laravel/laravel
</code></pre>

<h3>透過下載建立 Laravel 專案</h3>

<p>
    只要 Composer 安裝完成，下載 <a href="https://github.com/laravel/laravel/archive/master.zip">最新版本</a> 的 Laravel 檔案，並解壓到你的伺服器中，接下來在您的 Laravel 專案根目錄執行 <code>php composer.phar install</code> (或 <code>composer install</code>) 指令去安裝所有相依的套件，這個 Laravel 安裝過程，需要在伺服器完整安裝完 Git 後才可以順利執行。
</p>

<p>
    如果你想要更新 Laravel，你可以執行 <code>php composer.phar update</code> 指令進行更新
</p>

<p><a name="server-requirements"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.server_requirements') }}</h2>

<p>The Laravel framework has a few system requirements:</p>

<ul>
<li>PHP >= 5.3.7</li>
<li>MCrypt PHP Extension</li>
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.configuration') }}</h2>

<p>
    幾乎沒有Laravel需要配置開箱。你可以自由開始開發！不過，你不妨檢討的應用程式/配置/ app.php的文件和文 ​​檔。它包含幾個選項，如時區和語言環境，你不妨根據您的應用程序改變。

    Laravel 開始幾乎不需要進行任何的設定，你可以自由開始開發了！不過，你或許希望重新檢視 <code>app/config/app.php</code> 檔案和說明文件，它包含幾個選項，如 <code>timezone(時區)</code> 和 <code>locale(語言環境)</code> ，你或許想根據您的應用程式需求進行變更。
</p>

<blockquote>
  <p>
    <strong>備註:</strong> 一個在 <code>app/config/app.php</code> 的設置選項應該確保有設定 <code>key</code> 的選項，這個值應該設為32個字元的隨機字串，這個 key 將會被用來加密資料，除非 key 設定完成，否則您的加密資料都是不安全的，你可以透過 artisan 指令快速地建立此 key值 <code>php artisan key:generate</code>
  </p>
</blockquote>

<p><a name="permissions"></a></p>

<h3>權限</h3>

<p>
    Laravel 需要被設定一組權限的 - <code>app/storage</code> 資料夾在伺服器中必須要有寫入的權限
</p>

<p><a name="paths"></a></p>

<h3>路徑</h3>

<p>
    Laravel 框架的目錄是可以被設定的，可以檢查一下 <code>bootstrap/paths.php</code> 的檔案去變更你要變更的目錄
</p>

<blockquote>
  <p>
    <strong>備註:</strong> Laravel 已經設計成保護您的網頁應用程式的架構，僅能藉由本地端去存取你的程式，需要公開的檔案將會被放到 public 資料夾，建議您將 public 資料夾設定為您網頁的存取根目錄 (documentRoot)，也是你所知的網站根目錄(/)，放置所有要讓外部存取的檔案到 public 資料夾中，所有 Laravel 的其他相關檔案放在網頁根目錄之外，讓外部無法直接存取。
  </p>
</blockquote>



<p><a name="pretty-urls"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.pretty_urls') }}</h2>

<p>
    Laravel 有 <code>public/.htaccess</code> 的檔案，讓網址中不要出現 <code>index.php</code> 的檔案名稱，如果你使用 Apache當作您 Laravel 專案的網頁伺服器，請確保您有開啟 <code>mod_rewrite</code> 模組
</p>

<p>
    如果 <code>.htaccess</code> 在您的 Laravel 專案 Apache 伺服器中沒有發生作用，可以試試看這個:
</p>

<pre><code>Options +FollowSymLinks
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)/$ http://%{HTTP_HOST}/$1 [R=301,L]

RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
</code></pre>
@stop;
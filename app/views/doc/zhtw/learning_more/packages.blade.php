@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.packages') }}</h1>

<ul>
  <li>
    <a href="#introduction">{{ Lang::get('l4doc.docs_title.learning_more.packages.introduction') }}</a>
  </li>
  <li>
    <a href="#creating-a-package">{{ Lang::get('l4doc.docs_title.learning_more.packages.creating_a_package') }}</a>
  </li>
  <li>
    <a href="#package-structure">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_structure') }}</a>
  </li>
  <li>
    <a href="#service-providers">{{ Lang::get('l4doc.docs_title.learning_more.packages.service_providers') }}</a>
  </li>
  <li>
    <a href="#package-conventions">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_conventions') }}</a>
  </li>
  <li>
    <a href="#development-workflow">{{ Lang::get('l4doc.docs_title.learning_more.packages.development_workflow') }}</a>
  </li>
  <li>
    <a href="#package-routing">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_routing') }}</a>
  </li>
  <li>
    <a href="#package-configuration">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_configuration') }}</a>
  </li>
  <li>
    <a href="#package-migrations">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_migrations') }}</a>
  </li>
  <li>
    <a href="#package-assets">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_assets') }}</a>
  </li>
  <li>
    <a href="#publishing-packages">{{ Lang::get('l4doc.docs_title.learning_more.packages.publishing_packages') }}</a>
  </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.introduction') }}</h2>

<p>
  套件是從 Laravel 增加功能的主要方式。 它可能像是 <a href="https://github.com/briannesbitt/Carbon" target="_blank">Carbon</a> 一個日期處理的絕妙選擇，或是 <a href="https://github.com/Behat/Behat" target="_blank">Behat</a> 一個完整的 BDD 測試框架。
</p>

<p>
  當然，套件有著不同的類型。 有些套件是具有獨立性，可適用於任何框架，並非只限於 Laravel。 例如 Carbon 和 Behat 這兩個就是一個獨立套件的範例。 任何這類型的套件可透過你的 <code>composer.json</code> 檔案，簡單的被引入並使用在 Laravel 上。
</p>

<p>
  反過來說，另一種套件則是特別用於 Laravel 的類型。 在之前的版本，這些類型的套件被稱為 "Bundles"。 它們有自己的路由(routes)、控制器(controllers)、視圖(views)、設定(configuration)以及遷移(migrations)等專門用來增強 Laravel 應用程式。 開發獨立套件不需要特別的程序規定，所以本章節涵蓋內容主要是針對 Laravel 專用套件開發。
</p>

<p>
  所有 Laravel 套件都是透過 <a href="http://packagist.org">Packagist</a> 與 <a href="http://getcomposer.org">Composer</a> 發佈，因此學習這些工具來發佈 PHP 套件是必要的。
</p>

<p><a name="creating-a-package"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.creating_a_package') }}</h2>

<p>
  建立套件最簡單的方法是透過 Laravel 所提供的 <code>workbench</code> Artisan 命令列。 首先你需要從 <code>app/config/workbench.php</code>  這個檔案設定一些選項。 檔案中你會發現 <code>name</code> 與 <code>email</code>  選項，這兩個資料將用來產生一個新套件使用的 <code>composer.json</code> 檔案。 一旦你設定好這些資料，就可以準備建立一個 workbench 套件了!
</p>

<p><strong>執行 Workbench Artisan 命令</strong></p>

<pre><code>php artisan workbench vendor/package --resources
</code></pre>

<p>
  vender 名稱是用來區分不同開發者所建立的相同名稱套件。 例如，如果我(Taylor Otwell)想要建立一個名為 "Zapper" 的套件，那 vender 名稱應該為 <code>Taylor</code> ，而套件名稱應該為 <code>Zapper</code> 。 預設情況上 workbench 將會建立獨立型的套件； 但若你追加了 <code>resources</code> 參數，將告知 workbench 產生套件時，同時產生 Laravel 專用的特定資料夾，例如 <code>migrations</code> 、 <code>views</code> 、 <code>config</code> 等。
</p>

<p>
  一旦  <code>workbench</code>  命令指被執行後，你的套件將被建置在 Laravel 安裝目錄底下的  <code>workbench</code> 資料夾內。 接下來，你應該為你的套件註冊 <code>ServiceProvider</code> 服務供應器。 開啟檔案 <code>app/config/app.php</code> 並追加到 <code>providers</code> 陣列來進行註冊。 這將指示 Laravel 在應用程式開始時，讀取你的套件。 服務提供使用 <code>[Package]ServiceProvider</code> 命名規則，以上面的範例為例，你應該增加 <code>Taylor\Zapper\ZapperServiceProvider</code> 到 <code>providers</code> 陣列中。
</p>

<p>
  當完成提供器的註冊，你可以開始準備開發你的套件了！ 不過在開始動手之前，我們先再看看套件結構與開發流程來更熟悉開發套件的部分。
</p>

<p><a name="package-structure"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_structure') }}</h2>

<p>
  當你使用 <code>workbench</code> 命令，你的套件將被建置並轉成適合 Laravel 框架運行的結構:
</p>

<p><strong>基本套件目錄結構</strong></p>

<pre><code>/src
    /Vendor
        /Package
            PackageServiceProvider.php
    /config
    /lang
    /migrations
    /views
/tests
/public
</code></pre>

<p>
  讓我們來逐一說明各結構功用。 <code>src/Vendor/Package</code> 是所有套件類別的主目錄，包含 <code>ServiceProvider</code> 。 而 <code>config</code>  、 <code>lang</code> 、 <code>migrations</code> 以及 <code>views</code>  正如你所猜想的，包含如同名稱相對應的資源。 套件也可以只擁有這些資源的其中幾項，就像是 "regular" 的應用程式。
</p>

<p><a name="service-providers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.service_providers') }}</h2>

<p>
  服務供應器是一個套件的簡單啟動類別。 它預設包含了兩個方法： <code>boot</code> 以及 <code>register</code> 。 你可以在這些方法裡面做任何事：像是載入路由設定檔、註冊綁定控制反轉容器，監聽事件或任何你想要做的事。
</p>

<p>
  方法 <code>register</code> 會在服務供應器被註冊時被呼叫，而 <code>boot</code>  則是在路由請求前被呼叫。 所以如果你的服務供應器中的動作(action)必需依賴另一個服務供應器，或是你打算覆蓋另外一個服務供應器所綁定的服務，那麼你應該使用 <code>boot</code> 方法。
</p>

<p>
  如果你使用了 <code>workbench</code> 建立套件，系統將會自動在你的 <code>boot</code> 方法補上這個動作:
</p>

<pre><code>$this-&gt;package('vendor/package');
</code></pre>

<p>
  這個方法告知 Laravel 如何為你的應用程式加載視圖、設定、以及其它資源。 一般來講，你通常不需要修改這行程式，它為依照 workbench 的設定自動配置好。
</p>

<p><a name="package-conventions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_conventions') }}</h2>

<p>
  當需要從套件使用資源時，例如設定檔或視圖，必需使用雙冒號的語法:
</p>

<p><strong>載入套件中的視圖</strong></p>

<pre><code>return View::make('[YourPackageName]::view.name');
</code></pre>

<p><strong>取得套件設定選項</strong></p>

<pre><code>return Config::get('package::group.option');
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 如果你的套件包含了 migrations，請為 migration 名稱添加前置詞，避免與其它的套件類別相衝突。</p>
</blockquote>

<p><a name="development-workflow"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.development_workflow') }}</h2>

<p>
  當開發套件時，保持在應用程式架構內開發相當有用的，可以讓你容易處理樣板視圖環境的問題等。 所以我們開始，然後使用 <code>workbench</code>  指令來建立一個新的套件。
</p>

<p>
  在執行 <code>workbench</code> 建立套件後。 從 <code>workbench/[vendor]/[package]</code> 資料夾執行 <code>git init</code> 並且 git push！ 這樣你就不會因為每次的 <code>composer update</code> 指令造成開發上不便而陷入苦境。
</p>

<p>
  當你的套件還在 <code>workbench</code> 時，你可能會擔心 Composer 要如何自動載入你的套件檔案。當 <code>workbench</code> 目錄存在時，Laravel 將會在應用程式啟動時，自動掃描資料夾的所有套件，並執行套件內的 Composer 設定!
</p>

<p>
  如果你需要重新產生套件的自動讀取檔案的設定，你可以使用 <code>php artisan dump-autoload</code> 這個指令。 這個指令將會為你的套件主目錄重新掃描 autoload 的 classmap 所指定的資料夾後，建立自動讀取檔的類別檔。
</p>

<p><a name="package-routing"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_routing') }}</h2>

<p>
  在之前的 Laravel 版本，套件透過 <code>handles</code> 來對應哪個 URI。 然在，在 Laravel 4 中，套件可以對應任何 URI。 只要從你的服務供應器中的 <code>boot</code> 方法 <code>include</code> 路由設定即可。
</p>

<p><strong>在服務供應器中載入路由設定</strong></p>

<pre><code>public function boot()
{
    $this-&gt;package('vendor/package');

    include __DIR__.'/../../routes.php';
}
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 
    如果你的套件使用了控制器(controllers)，你必需確認控制器資料夾路徑有被設置在 <code>composer.json</code> 的 autoload 區段中 classmap 裡面。</p>
</blockquote>

<p><a name="package-configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_configuration') }}</h2>

<p>
  有些套件也許需要載入一些設定檔案。 這些檔案應該和應用程式設定檔一樣被定義。 使用 <code>$this-&gt;package</code> 註冊到服務供應器後，接著就能用雙冒號來存取這它們:
</p>

<p><strong>存取套件設定檔</strong></p>

<pre><code>Config::get('package::file.option');
</code></pre>

<p>
  然而，如果你的套件只有單一個設定檔，只要將設定檔命名為 <code>config.php</code> 。 如此一來，你就不需要特別指定檔案名稱來存取這個設定檔資料:
</p>

<p><strong>存取套件單一設定檔的資料</strong></p>

<pre><code>Config::get('package::option');
</code></pre>

<h3>覆寫設定檔</h3>

<p>
  當其它開發者安裝了你的套件，他們可能想要覆寫一些你的套件設定檔內容。然而，如果他們直接修改你套件內的設定檔，他們必需在下次 Composer updates 後，又要再次覆寫一次。一個代替的方式是使用 <code>config:publish</code> artisan 指令來解決這個問題:
</p>

<p><strong>執行設定檔發佈指令</strong></p>

<pre><code>php artisan config:publish vendor/package
</code></pre>

<p>
  當指令被執行後，設定檔將會被複製到 <code>app/config/packages/vendor/package</code> 資料夾，這樣開發者就能避免修改後一再被覆寫的問題!
</p>

<blockquote>
  <p><strong>注意:</strong> 
    開發者也可以建立針對環境的設定檔，並將他放在 <code>app/config/packages/vendor/package/environment</code> 資料夾。</p>
</blockquote>

<p><a name="package-migrations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_migrations') }}</h2>

<p>
    你可以容易的為你的套件建立並執行遷移(migrations)。建立遷移可以使用指令參數 <code>--bench</code>:
</p>

<p><strong>建立 workbench 中的套件遷移</strong></p>

<pre><code>php artisan migrate:make create_users_table --bench="vendor/package"
</code></pre>

<p><strong>執行 workbench 中的套件遷移</strong></p>

<pre><code>php artisan migrate --bench="vendor/package"
</code></pre>

<p>
  如果你要執從的遷移是透過 Composer 安裝在 <code>vendor</code> 資料夾中，你應該改用指令參數 <code>--package</code>:
</p>

<p><strong>執行安裝套件的遷移</strong></p>

<pre><code>php artisan migrate --package="vendor/package"
</code></pre>

<p><a name="package-assets"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_assets') }}</h2>

<p>
  一些套件可能有像是 JavaScript、CSS、以及圖片等資源， 然而我們無法直接連結使用 <code>vendor</code> 或 <code>workbench</code> 資料夾中的資源。 所以我們需要一個方法將這些資源移至到我們應用程式的 <code>public</code> 資料夾。 這時候命令 <code>asset:publish</code> 將會為你處理好這一切:
</p>

<p><strong>移到套件資源到 Public</strong></p>

<pre><code>php artisan asset:publish

php artisan asset:publish vendor/package
</code></pre>

<p>
  如果套件仍然在 <code>workbench</code> 中，使用 <code>--bench</code> 參數指引:
</p>

<pre><code>php artisan asset:publish --bench="vendor/package"
</code></pre>

<p>
  這個命令將會根據 vender 以及套件名稱，將移動資源到 <code>public/packages</code> 資料夾。 所以假設一個名稱為 <code>userscape/kudos</code>  的套件，它的資源將會被移動到 <code>public/packages/userscape/kudos</code> 使用這樣的方法發佈資源，可以讓你能夠在你的套件視圖中安全的使用這些資源路徑。
</p>

<p><a name="publishing-packages"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.publishing_packages') }}</h2>

<p>
  當你的套件已經準備好要發佈了，你應該將套件發送到 <a href="http://packagist.org" target="_blank">Packagist</a> repository。 如果套件是特定於 <code>laravel</code> 的話，考慮看看使用 laravel 這個標籤到你的 <code>composer.json</code> 檔案中。
</p>

<p>
  還有，在發佈的版本追加一些標籤，有助於開發者可以在他們的 <code>composer.json</code> 中，安裝穩定的套件版本。 如果穩定版本還未完成，考慮看看使用指令參數 <code>branch-alias</code> 來指示。
</p>

<p>
  一旦你的套件被發佈後，持續的保持在應用程式框架透過 <code>workbench</code> 進行開發。這樣可以方便在套件發佈後，繼續的開發你的套件。
</p>

<p>
  一些組職使用私有的套件資源主機，如果你有興趣，可以參考 Composer 團隊所建立的 <a href="http://github.com/composer/satis" target="blank">Satis</a> 文件。
</p>
@stop;
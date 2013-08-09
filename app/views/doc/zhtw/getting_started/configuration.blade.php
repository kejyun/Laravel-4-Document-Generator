@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.configuration') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.getting_started.configuration.introduction') }}</a>
    </li>
    <li>
        <a href="#environment-configuration">{{ Lang::get('l4doc.docs_title.getting_started.configuration.environment_configuration') }}</a>
    </li>
    <li>
        <a href="#maintenance-mode">{{ Lang::get('l4doc.docs_title.getting_started.configuration.maintenance_mode') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.configuration.introduction') }}</h2>

<p>
    Laravel 的所有設定存放在 <code>app/config</code> 目錄中，檔案中的每一個選項都有做成文件供參考，可以翻閱文件選擇適合你熟悉的選項
</p>

<p>
    有時你或許需要在執行時能存取到這些設定，你可以使用 <code>Config</code> 這個類別去存取設定:
</p>

<p><strong>存取一個選項設定值</strong></p>

<pre><code>Config::get('app.timezone');
</code></pre>

<p>
    當這個選項值沒有被設定時，你或許可以指定一個預設的值當作預設選項:
</p>

<pre><code>$timezone = Config::get('app.timezone', 'UTC');
</code></pre>

<p>
    注意到 "點(dot)" 的語法格式可以用來存取不同的檔案，你可以在執行時設定選項值為:
</p>

<p><strong>設定一個選項值</strong></p>

<pre><code>Config::set('database.default', 'sqlite');
</code></pre>

<p><a name="environment-configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.configuration.environment_configuration') }}</h2>

<p>
    不同的設定值，在不同的正在執行的應用環境，往往是有幫助的，舉例來說，你可以希望在 本地開發機器 與產品伺服器 使用不同的快取機制，這使用執行環境(environment)的配置的設定後，是很容易做到的。
</p>

<p>
    簡單的在 <code>config</code> 目錄建立與執行環境(environment)相符的檔案名稱，像是 <code>local</code>，下一步建立你想要在這個環境覆蓋過去的設定，舉例來說，為了複寫本地端環境的快取機制，你可以在 <code>app/config/local</code> 建立 <code>cache.php</code> 的檔案，檔案內容如下:
</p>

<pre><code>&lt;?php

return array(

    'driver' =&gt; 'file',

);
</code></pre>

<blockquote>
  <p><strong>備註:</strong> 不要使用 'testing' 當作環境名稱，這個是保留給單元測試用</p>
</blockquote>

<p>
    請注意，你不需要在設定檔中指定 <em>每一個</em> 選項，你只需要指定你想覆蓋的選項名稱即可，環境設置將會使用瀑布流(cascade)的方式去複寫這些在原始檔案的設定
</p>

<p>
    接下來我們必須告訴框架，需要執行哪一個環境(environment)，預設的環境都是為 <code>production</code>，但是你或許安裝前在 <code>bootstrap/start.php</code> 檔案中設定其他的執行環境，在這個檔案中你將會找到 <code>$app-&gt;detectEnvironment</code> 的呼叫，這個陣列傳遞給這個方法去決定現在要執行的環境，你可能添加需要的其他環境及機器名稱。
</p>

<pre><code>&lt;?php

$env = $app-&gt;detectEnvironment(array(

    'local' =&gt; array('your-machine-name'),

));
</code></pre>

<p>
    您也可以通過一個封閉的detectEnvironment方法，讓你實現你自己的環境檢測：

    你也可以透過一個 <code>封閉(Closure)</code> 的 <code>detectEnvironment</code> 方法，讓你完成你自己的環境檢測
</p>

<pre><code>$env = $app-&gt;detectEnvironment(function()
{
    return $_SERVER['MY_LARAVEL_ENV'];
});
</code></pre>

<p>
    你可以透過 <code>environment</code> 方法存取現在的應用環境:
</p>

<p><strong>存取現在的應用環境</strong></p>

<pre><code>$environment = App::environment();
</code></pre>

<p><a name="maintenance-mode"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.configuration.maintenance_mode') }}</h2>

<p>
    當你的應用程式在維護模式 (maintenance mode)，應用程式中所有的路由將會顯示一個自訂的 view ，呼叫 <code>app/start/global.php</code> 檔案中的 <code>App::down</code> 可以讓你容易的在你需要更新時，"關閉" 你的應用程式，這個回應會傳送給所有使用者，告知你的應用程式正在維護中。
</p>

<p>
    開啟維護模式 (maintenance mode) 只需要在 Artisan 指令中執行 <code>down</code> 指令即可:
</p>

<pre><code>php artisan down
</code></pre>

<p>
    關閉維護模式 (maintenance mode)時，使用 <code>up</code> 指令即可:
</p>

<pre><code>php artisan up
</code></pre>

<p>
    為了在維護模式 (maintenance mode) 時顯示一個自訂的 view，你可以在 <code>app/start/global.php</code> 檔案中加入下列程式:
</p>

<pre><code>App::down(function()
{
    return Response::view('maintenance', array(), 503);
});
</code></pre>
@stop;
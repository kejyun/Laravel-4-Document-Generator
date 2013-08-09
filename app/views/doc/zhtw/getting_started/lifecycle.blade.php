@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.lifecycle') }}</h1>

<ul>
	<li>
		<a href="#overview">{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.overview') }}</a>
	</li>
	<li>
		<a href="#start-files">{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.start_files') }}</a>
	</li>
	<li>
		<a href="#application-events">{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.application_events') }}</a>
	</li>
</ul>

<p><a name="overview"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.overview') }}</h2>

<p>
	Laravel 發出請求(Request)的生命週期相當簡單，當使用者請求存取你的應用程式，會將它費配到適當的 路由 (Route) 或 控制器(Controller)，然後從該路由送回訊息給瀏覽器顯示在螢幕上，有時候你可能會希望在存取路由 "之前 (before)" 或 "之後 (after)" 做一些處理，有幾個機會點可以做到這樣的需求，其中兩個是 "start" 檔案 和 應用程式事件。
</p>

<p><a name="start-files"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.start_files') }}</h2>

<p>
	你應用程式的 start 檔案室存放在 <code>app/start</code>，預設引用三個檔案到你的應用程式: <code>global.php</code> 、 <code>local.php</code> 及 <code>artisan.php</code> ，更多的 <code>artisan.php</code> 資訊請參考 <a href="../../docs/commands/#registering-commands">{{ Lang::get('l4doc.layout.docs_menu.commands') }}:{{ Lang::get('l4doc.docs_title.artisancli.commands.registering_commands') }}</a> 的說明文件。
</p>

<p>
	<code>global.php</code> 的啟動檔案包含一些預設基本的元素，像是註冊 <a href="../../docs/errors">{{ Lang::get('l4doc.layout.docs_menu.errors') }}</a> 和引入你的 <code>app/filters.php</code> 檔案，不管怎樣，你還是可以隨意的加入任何東西在這個檔案，這樣在 <em>每次</em> 的請求，不論執行環境為何，都會自動引用到你的應用程式，而 <code>local.php</code> 的檔案則是當執行環境為 <code>local</code> 時才會被引用進去，對於更多的環境相關設定，請參考 <a href="../../docs/configuration">{{ Lang::get('l4doc.layout.docs_menu.configuration') }}</a></li> 說明文件。
</p>

<p>
	當然，如果你有除了 <code>local</code> 以外的其他執行環境，你可以建立這些環境的啟動檔案，他們將會在該環境中自動的被執行
</p>

<p><a name="application-events"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.application_events') }}</h2>

<p>
	註冊之前，您也可以做前期和後期的請求處理，之後，關閉，完成後，關閉應用程序事件：

	你可以藉由註冊 <code>before</code> 、 <code>after</code> 、 <code>close</code> 、 <code>finish</code> 和 <code>shutdown</code> 做應用程式的"前期"和"後期"的請求處理:
</p>

<p><strong>Registering Application Events</strong></p>

<pre><code>App::before(function()
{
    //
});

App::after(function($request, $response)
{
    //
});
</code></pre>

<p>
	這些事件的傾聽，將會在每次對應用程式請求(Request)的<code>之前(before)</code> 及 <code>之後(after)</code> 執行。
</p>
@stop;
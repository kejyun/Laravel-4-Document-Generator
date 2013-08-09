@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.responses') }}</h1>

<ul>
    <li>
        <a href="#basic-responses">{{ Lang::get('l4doc.docs_title.getting_started.responses.basic_responses') }}</a>
    </li>
    <li>
        <a href="#redirects">{{ Lang::get('l4doc.docs_title.getting_started.responses.redirects') }}</a>
    </li>
    <li>
        <a href="#views">{{ Lang::get('l4doc.docs_title.getting_started.responses.views') }}</a>
    </li>
    <li>
        <a href="#view-composers">{{ Lang::get('l4doc.docs_title.getting_started.responses.view_composers') }}</a>
    </li>
    <li>
        <a href="#special-responses">{{ Lang::get('l4doc.docs_title.getting_started.responses.special_responses') }}</a>
    </li>
</ul>

<p><a name="basic-responses"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.responses.basic_responses') }}</h2>

<p><strong>從路由取得字串</strong></p>

<pre><code>Route::get('/', function()
{
    return 'Hello World';
});
</code></pre>

<p><strong>建立自訂回應</strong></p>

<p>
    <code>Response</code> 的實例是繼承 <code>Symfony\Component\HttpFoundation\Response</code> 類別，提供各種不同的方法去建立一個 HTTP 的回應。
</p>

<pre><code>$response = Response::make($contents, $statusCode);

$response-&gt;header('Content-Type', $value);

return $response;
</code></pre>

<p><strong>添加 cookies 資料到回應中</strong></p>

<pre><code>$cookie = Cookie::make('name', 'value');

return Response::make($content)-&gt;withCookie($cookie);
</code></pre>

<p><a name="redirects"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.responses.redirects') }}</h2>

<p><strong>回傳重新導向到指定連結</strong></p>

<pre><code>return Redirect::to('user/login');
</code></pre>

<p><strong>回傳重新導向到指定名稱的路由</strong></p>

<pre><code>return Redirect::route('login');
</code></pre>

<p><strong>回傳重新導向到指定名稱的路由，並添加參數資料</strong></p>

<pre><code>return Redirect::route('profile', array(1));
</code></pre>

<p><strong>回傳重新導向到指定名稱的路由，並添加有命名的參數資料</strong></p>

<pre><code>return Redirect::route('profile', array('user' =&gt; 1));
</code></pre>

<p><strong>回傳重新導向到指定控制器的動作中</strong></p>

<pre><code>return Redirect::action('HomeController@index');
</code></pre>

<p><strong>回傳重新導向到指定控制器的動作中，並添加參數資料</strong></p>

<pre><code>return Redirect::action('UserController@profile', array(1));
</code></pre>

<p><strong>回傳重新導向到指定控制器的動作中，並添加有命名的參數資料</strong></p>

<pre><code>return Redirect::action('UserController@profile', array('user' =&gt; 1));
</code></pre>

<p><a name="views"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.responses.views') }}</h2>

<p>
    視圖 (View) 基本上都會包含 HTML ，提供你的網頁程式能夠方便的將控制器 (Controller) 抽離開前端呈現的邏輯之外，視圖的檔案是存放在 <code>app/views</code> 目錄中。
</p>

<p>一個簡易的視圖會長成像這樣:</p>

<pre><code>&lt;!-- View stored in app/views/greeting.php --&gt;

&lt;html&gt;
    &lt;body&gt;
        &lt;h1&gt;Hello, &lt;?php echo $name; ?&gt;&lt;/h1&gt;
    &lt;/body&gt;
&lt;/html&gt;
</code></pre>

<p>這個視圖呈現在瀏覽器會是像這樣:</p>

<pre><code>Route::get('/', function()
{
    return View::make('greeting', array('name' =&gt; 'Taylor'));
});
</code></pre>

<p>
    傳給 <code>View::make</code> 的第二個參數是一個陣列資料，這些陣列可以在視圖中被存取到:
</p>

<p><strong>傳送資料到視圖</strong></p>

<pre><code>$view = View::make('greeting', $data);

$view = View::make('greeting')-&gt;with('name', 'Steve');
</code></pre>

<p>
    在上面的例子中，<code>$name</code> 可以在視圖裡被存取到，而資料值會是 <code>Steve</code>。
</p>

<p>你也可以在不同的視圖中共享部分的資訊:</p>

<pre><code>View::share('name', 'Steve');
</code></pre>

<p><strong>傳送子視圖到視圖中</strong></p>

<p>
    有時你可能想要將一個視圖的資料，傳送到另一個視圖中呈現，舉例來說，在將子視圖存放在 <code>app/views/child/view.php</code> 中，我們可以將它傳到另一個視圖中，像這樣:
</p>

<pre><code>$view = View::make('greeting')-&gt;nest('child', 'child.view');

$view = View::make('greeting')-&gt;nest('child', 'child.view', $data);
</code></pre>

<p>子視圖可以被呈現在母視圖:</p>

<pre><code>&lt;html&gt;
    &lt;body&gt;
        &lt;h1&gt;Hello!&lt;/h1&gt;
        &lt;?php echo $child; ?&gt;
    &lt;/body&gt;
&lt;/html&gt;
</code></pre>

<p><a name="view-composers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.responses.view_composers') }}</h2>

<p>
    視圖 Composer 是一個回呼 (callback) 或類別的方法，當視圖被建立時會呼叫這個方法，如果你有資料想要每次都綁定到視圖上，視圖 Composer 可以將這些資料整合在相同地方，因此視圖 Composer 會像是"視圖的模型 (view models)"或是"呈現器 (presenters)"。
</p>

<p><strong>定義一個視圖 Composer</strong></p>

<pre><code>View::composer('profile', function($view)
{
    $view-&gt;with('count', User::count());
});
</code></pre>

<p>
    現在每次 <code>profile</code> 視圖被建立時，<code>count</code> 資料將會都被綁訂到此視圖。
</p>

<p>
    你也可以一次就將視圖 Composer 綁訂到多個視圖當中:
</p>

<pre><code>View::composer(array('profile','dashboard'), function($view)
{
    $view-&gt;with('count', User::count());
});
</code></pre>

<p>
    假如你想用類別為基礎的 Composer，透過 <a href="../../docs/ioc">{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</a> 的應用可以提供你解決更多這樣的問題，你可以這樣做:
</p>

<pre><code>View::composer('profile', 'ProfileComposer');
</code></pre>

<p>
    一個視圖的 Composer 類別應該被定義成像這樣:
</p>

<pre><code>class ProfileComposer {

    public function compose($view)
    {
        $view-&gt;with('count', User::count());
    }

}
</code></pre>

<p>
    請注意到，這裡並沒有任何的規矩去限制 Composer 類別要存在什麼樣的地方，你可以將她存放在任何的地方，只要他們可以使用 <code>composer.json</code> 的檔案做紀錄，去直接自動的載入這個類別:
</p>

<p><a name="special-responses"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.responses.special_responses') }}</h2>

<p><strong>建立一個 JSON 資料格式的回應</strong></p>

<pre><code>return Response::json(array('name' =&gt; 'Steve', 'state' =&gt; 'CA'));
</code></pre>

<p><strong>建立一個 JSONP 資料格式的回應</strong></p>

<pre><code>return Response::json(array('name' =&gt; 'Steve', 'state' =&gt; 'CA'))-&gt;setCallback(Input::get('callback'));
</code></pre>

<p><strong>建立一個下載檔案的回應</strong></p>

<pre><code>return Response::download($pathToFile);

return Response::download($pathToFile, $name, $headers);
</code></pre>
@stop;
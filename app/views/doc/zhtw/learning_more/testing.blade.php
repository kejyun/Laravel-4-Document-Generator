@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.testing') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.learning_more.testing.introduction') }}</a>
    </li>
    <li>
        <a href="#defining-and-running-tests">{{ Lang::get('l4doc.docs_title.learning_more.testing.defining_and_running_tests') }}</a>
    </li>
    <li>
        <a href="#test-environment">{{ Lang::get('l4doc.docs_title.learning_more.testing.test_environment') }}</a>
    </li>
    <li>
        <a href="#calling-routes-from-tests">{{ Lang::get('l4doc.docs_title.learning_more.testing.calling_routes_from_tests') }}</a>
    </li>
    <li>
        <a href="#mocking-facades">{{ Lang::get('l4doc.docs_title.learning_more.testing.mocking_facades') }}</a>
    </li>
    <li>
        <a href="#framework-assertions">{{ Lang::get('l4doc.docs_title.learning_more.testing.framework_assertions') }}</a>
    </li>
    <li>
        <a href="#helper-methods">{{ Lang::get('l4doc.docs_title.learning_more.testing.helper_methods') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.introduction') }}</h2>

<p>
    Laravel 自己有建立單元測試，但也有支援 PHPUnit 單元測試，在你的應用程式已經有設定好 <code>phpunit.xml</code> PHPUnit 單元測試的設定，除了 PHPUnit 外，Laravel 也使用了 Symfony HttpKernel 、 DomCrawler 及 BrowserKit 元件，讓你在測試的時候可以監看及操作你的視圖，以及模擬瀏覽器的行為。
</p>

<p>
    在 <code>app/tests</code> 資料夾中有一個測試的範例檔，在安裝了新的 Laravel 應用程式後，只要在命令列執行 <code>phpunit</code> 指令即可執行測試。
</p>

<p><a name="defining-and-running-tests"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.defining_and_running_tests') }}</h2>

<p>
    只要在 <code>app/tests</code> 資料夾中建立新的測試檔案就可以建立測試案例，測試類別必須繼承 <code>TestCase</code> 類別，現在你可以像使用 PHPUnit 一樣去定義測試方法。
</p>

<p><strong>測試類別範例</strong></p>

<pre><code>class FooTest extends TestCase {

    public function testSomethingIsTrue()
    {
        $this-&gt;assertTrue(true);
    }

}
</code></pre>

<p>
    你可以在命令列執行 <code>phpunit</code> 指令，去執行應用程式所有的測試。
</p>

<blockquote>
    <p>
        <strong>注意:</strong> 你可以定義自己的 <code>setUp</code> 方法，但確保你有呼叫母類別的 <code>parent::setUp</code> 方法。
    </p>
</blockquote>

<p><a name="test-environment"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.test_environment') }}</h2>

<p>
    在執行單元測試時，Laravel 將會自動設置環境參數為 <code>測試 (testing)</code> 模式，且 Laravel 包含了在測試環境的 <code>session</code> 及 <code>cache</code> 設定檔案，在測試環境中這兩個檔案設置為 <code>空陣列 (array)</code> ，意思是 session 或 cache 資料在測試時不會被保存下來，如果需要，你也可以自己配置其他的測試環境參數。
</p>

<p><a name="calling-routes-from-tests"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.calling_routes_from_tests') }}</h2>

<p>
    你可以使用 <code>call</code> 方法可以執行路由:
</p>

<p><strong>從測試中呼叫路由</strong></p>

<pre><code>$response = $this-&gt;call('GET', 'user/profile');

$response = $this-&gt;call($method, $uri, $parameters, $files, $server, $content);
</code></pre>

<p>
    你可以監看 <code>Illuminate\Http\Response</code> 物件:
</p>

<pre><code>$this-&gt;assertEquals('Hello World', $response-&gt;getContent());
</code></pre>

<p>
    你也可以在測試中呼叫控制器:
</p>

<p><strong>從測試中呼叫控制器</strong></p>

<pre><code>$response = $this-&gt;action('GET', 'HomeController@index');

$response = $this-&gt;action('GET', 'UserController@profile', array('user' =&gt; 1));
</code></pre>

<p>
    <code>getContent</code> 方法會回傳和回應相同的字串內容，如果你路由是回傳 <code>視圖 (View)</code> ，你可以使用 <code>original</code> 參數去存取這個視圖的資料:
</p>

<pre><code>$view = $response-&gt;original;

$this-&gt;assertEquals('John', $view['name']);
</code></pre>

<p>
    使用 <code>callSecure</code> 方法可以呼叫 HTTPS 的路由:
</p>

<pre><code>$response = $this-&gt;callSecure('GET', 'foo/bar');
</code></pre>

<h3>DOM 爬行器</h3>

<p>
    你可以呼叫路由並接收一個 "DOM 爬行器" 的實例，你可以使用這個實例去監控內容:
</p>

<pre><code>$crawler = $this-&gt;client-&gt;request('GET', '/');

$this-&gt;assertTrue($this-&gt;client-&gt;getResponse()-&gt;isOk());

$this-&gt;assertCount(1, $crawler-&gt;filter('h1:contains("Hello World!")'));
</code></pre>

<p>
    更多的 "DOM 爬行器" 相關資訊，請參考 <a href="http://symfony.com/doc/master/components/dom_crawler.html" target="_blank">官方文件</a>。
</p>

<p><a name="mocking-facades"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.mocking_facades') }}</h2>

<p>
    在測試時，你可能想要模擬呼叫 Laravel 靜態 Facade 方法，舉例來說，參考下列控制器的的動作:
</p>

<pre><code>public function getIndex()
{
    Event::fire('foo', array('name' =&gt; 'Dayle'));

    return 'All done!';
}
</code></pre>

<p>
    我們可以透過 <code>shouldReceive</code> 方法模擬呼叫在 Facade 中的 <code>Event</code> 類別，該方法會回傳一個 <a href="https://github.com/padraic/mockery" target="_blank">Mockery</a> 模擬的實例。
</p>

<p><strong>模擬 Facade</strong></p>

<pre><code>public function testGetIndex()
{
    Event::shouldReceive('fire')-&gt;once()-&gt;with(array('name' =&gt; 'Dayle'));

    $this-&gt;call('GET', '/');
}
</code></pre>

<blockquote>
    <p>
        <strong>注意:</strong> 不可以模擬 <code>Request</code> Facade，反之，你可以在執行測試時傳送你想要輸入資訊到 <code>call</code> 方法中，代替 <code>Request</code> 請求。
    </p>
</blockquote>

<p><a name="framework-assertions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.framework_assertions') }}</h2>

<p>
    Laravel 提供幾個 <code>宣告 (assert)</code> 的方法，讓測試能夠變得更容易:
</p>

<p><strong>宣告回應為 OK</strong></p>

<pre><code>public function testMethod()
{
    $this-&gt;call('GET', '/');

    $this-&gt;assertResponseOk();
}
</code></pre>

<p><strong>宣告回應狀態碼</strong></p>

<pre><code>$this-&gt;assertResponseStatus(403);
</code></pre>

<p><strong>宣告回應重新導向</strong></p>

<pre><code>$this-&gt;assertRedirectedTo('foo');

$this-&gt;assertRedirectedToRoute('route.name');

$this-&gt;assertRedirectedToAction('Controller@method');
</code></pre>

<p><strong>宣告回應帶有資料的視圖</strong></p>

<pre><code>public function testMethod()
{
    $this-&gt;call('GET', '/');

    $this-&gt;assertViewHas('name');
    $this-&gt;assertViewHas('age', $value);
}
</code></pre>

<p><strong>宣告回應 Session 中帶有資料</strong></p>

<pre><code>public function testMethod()
{
    $this-&gt;call('GET', '/');

    $this-&gt;assertSessionHas('name');
    $this-&gt;assertSessionHas('age', $value);
}
</code></pre>

<p><a name="helper-methods"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.helper_methods') }}</h2>

<p>
    <code>TestCase</code> 類別包含一些輔助方法讓你可以更容易測試你的應用程式:
</p>

<p>
    你可以使用 <code>be</code> 方法去設為現在驗證登入的使用者:
</p>

<p><strong>設定現在驗證登入的使用者</strong></p>

<pre><code>$user = new User(array('name' =&gt; 'John'));

$this-&gt;be($user);
</code></pre>

<p>
    在測試中使用 <code>seed</code> 方法重新產生資料庫的測試資料:
</p>

<p><strong>在測試時重新產生資料庫的測試資料</strong></p>

<pre><code>$this-&gt;seed();

$this-&gt;seed($connection);
</code></pre>

<p>
    更多建立測試資料的資訊可以在 
    <a href="../../docs/migrations#database-seeding">{{ Lang::get('l4doc.docs_title.db.migrations.database_seeding') }}</a> 文件中找到。
</p>
@stop;
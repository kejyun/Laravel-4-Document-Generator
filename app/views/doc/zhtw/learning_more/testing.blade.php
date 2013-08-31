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
    
    You may run all of the tests for your application by executing the <code>phpunit</code> command from your terminal.
</p>

<blockquote>
  <p><strong>Note:</strong> If you define your own <code>setUp</code> method, be sure to call <code>parent::setUp</code>.</p>
</blockquote>

<p><a name="test-environment"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.test_environment') }}</h2>

<p>
    When running unit tests, Laravel will automatically set the configuration environment to <code>testing</code>. Also, Laravel includes configuration files for <code>session</code> and <code>cache</code> in the test environment. Both of these drivers are set to <code>array</code> while in the test environment, meaning no session or cache data will be persisted while testing. You are free to create other testing environment configurations as necessary.
</p>

<p><a name="calling-routes-from-tests"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.calling_routes_from_tests') }}</h2>

<p>You may easily call one of your routes for a test using the <code>call</code> method:</p>

<p><strong>Calling A Route From A Test</strong></p>

<pre><code>$response = $this-&gt;call('GET', 'user/profile');

$response = $this-&gt;call($method, $uri, $parameters, $files, $server, $content);
</code></pre>

<p>You may then inspect the <code>Illuminate\Http\Response</code> object:</p>

<pre><code>$this-&gt;assertEquals('Hello World', $response-&gt;getContent());
</code></pre>

<p>You may also call a controller from a test:</p>

<p><strong>Calling A Controller From A Test</strong></p>

<pre><code>$response = $this-&gt;action('GET', 'HomeController@index');

$response = $this-&gt;action('GET', 'UserController@profile', array('user' =&gt; 1));
</code></pre>

<p>
    The <code>getContent</code> method will return the evaluated string contents of the response. If your route returns a <code>View</code>, you may access it using the <code>original</code> property:
</p>

<pre><code>$view = $response-&gt;original;

$this-&gt;assertEquals('John', $view['name']);
</code></pre>

<p>To call a HTTPS route, you may use the <code>callSecure</code> method:</p>

<pre><code>$response = $this-&gt;callSecure('GET', 'foo/bar');
</code></pre>

<h3>DOM Crawler</h3>

<p>You may also call a route and receive a DOM Crawler instance that you may use to inspect the content:</p>

<pre><code>$crawler = $this-&gt;client-&gt;request('GET', '/');

$this-&gt;assertTrue($this-&gt;client-&gt;getResponse()-&gt;isOk());

$this-&gt;assertCount(1, $crawler-&gt;filter('h1:contains("Hello World!")'));
</code></pre>

<p>
    For more information on how to use the crawler, refer to its <a href="http://symfony.com/doc/master/components/dom_crawler.html">official documentation</a>.
</p>

<p><a name="mocking-facades"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.mocking_facades') }}</h2>

<p>
    When testing, you may often want to mock a call to a Laravel static facade. For example, consider the following controller action:
</p>

<pre><code>public function getIndex()
{
    Event::fire('foo', array('name' =&gt; 'Dayle'));

    return 'All done!';
}
</code></pre>

<p>
    We can mock the call to the <code>Event</code> class by using the <code>shouldReceive</code> method on the facade, which will return an instance of a <a href="https://github.com/padraic/mockery">Mockery</a> mock.
</p>

<p><strong>Mocking A Facade</strong></p>

<pre><code>public function testGetIndex()
{
    Event::shouldReceive('fire')-&gt;once()-&gt;with(array('name' =&gt; 'Dayle'));

    $this-&gt;call('GET', '/');
}
</code></pre>

<blockquote>
  <p><strong>Note:</strong> You should not mock the <code>Request</code> facade. Instead, pass the input you desire into the <code>call</code> method when running your test.</p>
</blockquote>

<p><a name="framework-assertions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.framework_assertions') }}</h2>

<p>Laravel ships with several <code>assert</code> methods to make testing a little easier:</p>

<p><strong>Asserting Responses Are OK</strong></p>

<pre><code>public function testMethod()
{
    $this-&gt;call('GET', '/');

    $this-&gt;assertResponseOk();
}
</code></pre>

<p><strong>Asserting Response Statuses</strong></p>

<pre><code>$this-&gt;assertResponseStatus(403);
</code></pre>

<p><strong>Asserting Responses Are Redirects</strong></p>

<pre><code>$this-&gt;assertRedirectedTo('foo');

$this-&gt;assertRedirectedToRoute('route.name');

$this-&gt;assertRedirectedToAction('Controller@method');
</code></pre>

<p><strong>Asserting A View Has Some Data</strong></p>

<pre><code>public function testMethod()
{
    $this-&gt;call('GET', '/');

    $this-&gt;assertViewHas('name');
    $this-&gt;assertViewHas('age', $value);
}
</code></pre>

<p><strong>Asserting The Session Has Some Data</strong></p>

<pre><code>public function testMethod()
{
    $this-&gt;call('GET', '/');

    $this-&gt;assertSessionHas('name');
    $this-&gt;assertSessionHas('age', $value);
}
</code></pre>

<p><a name="helper-methods"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.helper_methods') }}</h2>

<p>The <code>TestCase</code> class contains several helper methods to make testing your application easier.</p>

<p>You may set the currently authenticated user using the <code>be</code> method:</p>

<p><strong>Setting The Currently Authenticated User</strong></p>

<pre><code>$user = new User(array('name' =&gt; 'John'));

$this-&gt;be($user);
</code></pre>

<p>You may re-seed your database from a test using the <code>seed</code> method:</p>

<p><strong>Re-Seeding Database From Tests</strong></p>

<pre><code>$this-&gt;seed();

$this-&gt;seed($connection);
</code></pre>

<p>
    More information on creating seeds may be found in the <a href="/docs/migrations#database-seeding">migrations and seeding</a> section of the documentation.
</p>
@stop;
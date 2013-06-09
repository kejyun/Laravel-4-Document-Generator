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
    Laravel is built with unit testing in mind. In fact, support for testing with PHPUnit is included out of the box, and a <code>phpunit.xml</code> file is already setup for your application. In addition to PHPUnit, Laravel also utilizes the Symfony HttpKernel, DomCrawler, and BrowserKit components to allow you to inspect and manipulate your views while testing, allowing to simulate a web browser.
</p>

<p>An example test file is provided in the <code>app/tests</code> directory. After installing a new Laravel application, simply run <code>phpunit</code> on the command line to run your tests.</p>

<p><a name="defining-and-running-tests"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.testing.defining_and_running_tests') }}</h2>

<p>
    To create a test case, simply create a new test file in the <code>app/tests</code> directory. The test class should extend <code>TestCase</code>. You may then define test methods as you normally would when using PHPUnit.
</p>

<p><strong>An Example Test Class</strong></p>

<pre><code>class FooTest extends TestCase {

    public function testSomethingIsTrue()
    {
        $this-&gt;assertTrue(true);
    }

}
</code></pre>

<p>You may run all of the tests for your application by executing the <code>phpunit</code> command from your terminal.</p>

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
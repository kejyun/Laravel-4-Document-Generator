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

<p><strong>Returning Strings From Routes</strong></p>

<pre><code>Route::get('/', function()
{
    return 'Hello World';
});
</code></pre>

<p><strong>Creating Custom Responses</strong></p>

<p>
    A <code>Response</code> instance inherits from the <code>Symfony\Component\HttpFoundation\Response</code> class, providing a variety of methods for building HTTP responses.
</p>

<pre><code>$response = Response::make($contents, $statusCode);

$response-&gt;header('Content-Type', $value);

return $response;
</code></pre>

<p><strong>Attaching Cookies To Responses</strong></p>

<pre><code>$cookie = Cookie::make('name', 'value');

return Response::make($content)-&gt;withCookie($cookie);
</code></pre>

<p><a name="redirects"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.responses.redirects') }}</h2>

<p><strong>Returning A Redirect</strong></p>

<pre><code>return Redirect::to('user/login');
</code></pre>

<p><strong>Returning A Redirect To A Named Route</strong></p>

<pre><code>return Redirect::route('login');
</code></pre>

<p><strong>Returning A Redirect To A Named Route With Parameters</strong></p>

<pre><code>return Redirect::route('profile', array(1));
</code></pre>

<p><strong>Returning A Redirect To A Named Route Using Named Parameters</strong></p>

<pre><code>return Redirect::route('profile', array('user' =&gt; 1));
</code></pre>

<p><strong>Returning A Redirect To A Controller Action</strong></p>

<pre><code>return Redirect::action('HomeController@index');
</code></pre>

<p><strong>Returning A Redirect To A Controller Action With Parameters</strong></p>

<pre><code>return Redirect::action('UserController@profile', array(1));
</code></pre>

<p><strong>Returning A Redirect To A Controller Action Using Named Parameters</strong></p>

<pre><code>return Redirect::action('UserController@profile', array('user' =&gt; 1));
</code></pre>

<p><a name="views"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.responses.views') }}</h2>

<p>
    Views typically contain the HTML of your application and provide a convenient way of separating your controller and domain logic from your presentation logic. Views are stored in the <code>app/views</code> directory.
</p>

<p>A simple view could look something like this:</p>

<pre><code>&lt;!-- View stored in app/views/greeting.php --&gt;

&lt;html&gt;
    &lt;body&gt;
        &lt;h1&gt;Hello, &lt;?php echo $name; ?&gt;&lt;/h1&gt;
    &lt;/body&gt;
&lt;/html&gt;
</code></pre>

<p>This view may be returned to the browser like so:</p>

<pre><code>Route::get('/', function()
{
    return View::make('greeting', array('name' =&gt; 'Taylor'));
});
</code></pre>

<p>
    The second argument passed to <code>View::make</code> is an array of data that should be made available to the view.
</p>

<p><strong>Passing Data To Views</strong></p>

<pre><code>$view = View::make('greeting', $data);

$view = View::make('greeting')-&gt;with('name', 'Steve');
</code></pre>

<p>
    In the example above the variable <code>$name</code> would be accessible from the view, and would contain <code>Steve</code>.
</p>

<p>You may also share a piece of data across all views:</p>

<pre><code>View::share('name', 'Steve');
</code></pre>

<p><strong>Passing A Sub-View To A View</strong></p>

<p>
    Sometimes you may wish to pass a view into another view. For example, given a sub-view stored at <code>app/views/child/view.php</code>, we could pass it to another view like so:
</p>

<pre><code>$view = View::make('greeting')-&gt;nest('child', 'child.view');

$view = View::make('greeting')-&gt;nest('child', 'child.view', $data);
</code></pre>

<p>The sub-view can then be rendered from the parent view:</p>

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
    View composers are callbacks or class methods that are called when a view is created. If you have data that you want bound to a given view each time that view is created throughout your application, a view composer can organize that code into a single location. Therefore, view composers may function like "view models" or "presenters".
</p>

<p><strong>Defining A View Composer</strong></p>

<pre><code>View::composer('profile', function($view)
{
    $view-&gt;with('count', User::count());
});
</code></pre>

<p>Now each time the <code>profile</code> view is created, the <code>count</code> data will be bound to the view.</p>

<p>You may also attach a view composer to multiple views at once:</p>

<pre><code>View::composer(array('profile','dashboard'), function($view)
{
    $view-&gt;with('count', User::count());
});
</code></pre>

<p>
    If you would rather use a class based composer, which will provide the benefits of being resolved through the application <a href="/docs/ioc">IoC Container</a>, you may do so:
</p>

<pre><code>View::composer('profile', 'ProfileComposer');
</code></pre>

<p>A view composer class should be defined like so:</p>

<pre><code>class ProfileComposer {

    public function compose($view)
    {
        $view-&gt;with('count', User::count());
    }

}
</code></pre>

<p>
    Note that there is no convention on where composer classes may be stored. You are free to store them anywhere as long as they can be autoloaded using the directives in your <code>composer.json</code> file.
</p>

<p><a name="special-responses"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.responses.special_responses') }}</h2>

<p><strong>Creating A JSON Response</strong></p>

<pre><code>return Response::json(array('name' =&gt; 'Steve', 'state' =&gt; 'CA'));
</code></pre>

<p><strong>Creating A JSONP Response</strong></p>

<pre><code>return Response::json(array('name' =&gt; 'Steve', 'state' =&gt; 'CA'))-&gt;setCallback(Input::get('callback'));
</code></pre>

<p><strong>Creating A File Download Response</strong></p>

<pre><code>return Response::download($pathToFile);

return Response::download($pathToFile, $name, $headers);
</code></pre>
@stop;
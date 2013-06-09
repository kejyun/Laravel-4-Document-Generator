@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.routing') }}</h1>

<ul>
    <li>
        <a href="#basic-routing">{{ Lang::get('l4doc.docs_title.getting_started.routing.basic_routing') }}</a>
    </li>
    <li>
        <a href="#route-parameters">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_parameters') }}</a>
    </li>
    <li>
        <a href="#route-filters">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_filters') }}</a>
    </li>
    <li>
        <a href="#named-routes">{{ Lang::get('l4doc.docs_title.getting_started.routing.named_routes') }}</a>
    </li>
    <li>
        <a href="#route-groups">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_groups') }}</a>
    </li>
    <li>
        <a href="#sub-domain-routing">{{ Lang::get('l4doc.docs_title.getting_started.routing.sub_domain_routing') }}</a>
    </li>
    <li>
        <a href="#route-prefixing">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_prefixing') }}</a>
    </li>
    <li>
        <a href="#route-model-binding">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_model_binding') }}</a>
    </li>
    <li>
        <a href="#throwing-404-errors">{{ Lang::get('l4doc.docs_title.getting_started.routing.throwing_404_errors') }}</a>
    </li>
    <li>
        <a href="#routing-to-controllers">{{ Lang::get('l4doc.docs_title.getting_started.routing.routing_to_controllers') }}</a>
    </li>
</ul>

<p><a name="basic-routing"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.basic_routing') }}</h2>

<p>
    Most of the routes for your application will be defined in the <code>app/routes.php</code> file. The simplest Laravel routes consist of a URI and a Closure callback.
</p>

<p><strong>Basic GET Route</strong></p>

<pre><code>Route::get('/', function()
{
    return 'Hello World';
});
</code></pre>

<p><strong>Basic POST Route</strong></p>

<pre><code>Route::post('foo/bar', function()
{
    return 'Hello World';
});
</code></pre>

<p><strong>Registering A Route Responding To Any HTTP Verb</strong></p>

<pre><code>Route::any('foo', function()
{
    return 'Hello World';
});
</code></pre>

<p><strong>Forcing A Route To Be Served Over HTTPS</strong></p>

<pre><code>Route::get('foo', array('https', function()
{
    return 'Must be over HTTPS';
}));
</code></pre>

<p>Often, you will need to generate URLs to your routes, you may do so using the <code>URL::to</code> method:</p>

<pre><code>$url = URL::to('foo');
</code></pre>

<p><a name="route-parameters"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_parameters') }}</h2>

<pre><code>Route::get('user/{id}', function($id)
{
    return 'User '.$id;
});
</code></pre>

<p><strong>Optional Route Parameters</strong></p>

<pre><code>Route::get('user/{name?}', function($name = null)
{
    return $name;
});
</code></pre>

<p><strong>Optional Route Parameters With Defaults</strong></p>

<pre><code>Route::get('user/{name?}', function($name = 'John')
{
    return $name;
});
</code></pre>

<p><strong>Regular Expression Route Constraints</strong></p>

<pre><code>Route::get('user/{name}', function($name)
{
    //
})
-&gt;where('name', '[A-Za-z]+');

Route::get('user/{id}', function($id)
{
    //
})
-&gt;where('id', '[0-9]+');
</code></pre>

<p><a name="route-filters"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_filters') }}</h2>

<p>
    Route filters provide a convenient way of limiting access to a given route, which is useful for creating areas of your site which require authentication. There are several filters included in the Laravel framework, including an <code>auth</code> filter, an <code>auth.basic</code> filter, a <code>guest</code> filter, and a <code>csrf</code>filter. These are located in the <code>app/filters.php</code> file.
</p>

<p><strong>Defining A Route Filter</strong></p>

<pre><code>Route::filter('old', function()
{
    if (Input::get('age') &lt; 200)
    {
        return Redirect::to('home');
    }
});
</code></pre>

<p>
    If a response is returned from a filter, that response will be considered the response to the request and the route will not be executed, and any <code>after</code> filters on the route will also be cancelled.
</p>

<p><strong>Attaching A Filter To A Route</strong></p>

<pre><code>Route::get('user', array('before' =&gt; 'old', function()
{
    return 'You are over 200 years old!';
}));
</code></pre>

<p><strong>Attaching Multiple Filters To A Route</strong></p>

<pre><code>Route::get('user', array('before' =&gt; 'auth|old', function()
{
    return 'You are authenticated and over 200 years old!';
}));
</code></pre>

<p><strong>Specifying Filter Parameters</strong></p>

<pre><code>Route::filter('age', function($route, $request, $value)
{
    //
});

Route::get('user', array('before' =&gt; 'age:200', function()
{
    return 'Hello World';
}));
</code></pre>

<p>After filters receive a <code>$response</code> as the third argument passed to the filter:</p>

<pre><code>Route::filter('log', function($route, $request, $response, $value)
{
    //
});
</code></pre>

<p><strong>Pattern Based Filters</strong></p>

<p>You may also specify that a filter applies to an entire set of routes based on their URI.</p>

<pre><code>Route::filter('admin', function()
{
    //
});

Route::when('admin/*', 'admin');
</code></pre>

<p>
    In the example above, the <code>admin</code> filter would be applied to all routes beginning with <code>admin/</code>. The asterisk is used as a wildcard, and will match any combination of characters.
</p>

<p>You may also constrain pattern filters by HTTP verbs:</p>

<pre><code>Route::when('admin/*', 'admin', array('post'));
</code></pre>

<p><strong>Filter Classes</strong></p>

<p>
    For advanced filtering, you may wish to use a class instead of a Closure. Since filter classes are resolved out of the application <a href="/docs/ioc">IoC Container</a>, you will be able to utilize dependency injection in these filters for greater testability.
</p>

<p><strong>Defining A Filter Class</strong></p>

<pre><code>class FooFilter {

    public function filter()
    {
        // Filter logic...
    }

}
</code></pre>

<p><strong>Registering A Class Based Filter</strong></p>

<pre><code>Route::filter('foo', 'FooFilter');
</code></pre>

<p><a name="named-routes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.named_routes') }}</h2>

<p>
    Named routes make referring to routes when generating redirects or URLs more convenient. You may specify a name for a route like so:
</p>

<pre><code>Route::get('user/profile', array('as' =&gt; 'profile', function()
{
    //
}));
</code></pre>

<p>You may also specify route names for controller actions:</p>

<pre><code>Route::get('user/profile', array('as' =&gt; 'profile', 'uses' =&gt; 'UserController@showProfile'));
</code></pre>

<p>Now, you may use the route's name when generating URLs or redirects:</p>

<pre><code>$url = URL::route('profile');

$redirect = Redirect::route('profile');
</code></pre>

<p>You may access the name of a route that is running via the <code>currentRouteName</code> method:</p>

<pre><code>$name = Route::currentRouteName();
</code></pre>

<p><a name="route-groups"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_groups') }}</h2>

<p>
    Sometimes you may need to apply filters to a group of routes. Instead of specifying the filter on each route, you may use a route group:
</p>

<pre><code>Route::group(array('before' =&gt; 'auth'), function()
{
    Route::get('/', function()
    {
        // Has Auth Filter
    });

    Route::get('user/profile', function()
    {
        // Has Auth Filter
    });
});
</code></pre>

<p><a name="sub-domain-routing"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.sub_domain_routing') }}</h2>

<p>Laravel routes are also able to handle wildcard sub-domains, and pass you wildcard parameters from the domain:</p>

<p><strong>Registering Sub-Domain Routes</strong></p>

<pre><code>Route::group(array('domain' =&gt; '{account}.myapp.com'), function()
{

    Route::get('user/{id}', function($account, $id)
    {
        //
    });

});
</code></pre>

<p><a name="route-prefixing"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_prefixing') }}</h2>

<p>A group of routes may be prefixed by using the <code>prefix</code> option in the attributes array of a group:</p>

<p><strong>Prefixing Grouped Routes</strong></p>

<pre><code>Route::group(array('prefix' =&gt; 'admin'), function()
{

    Route::get('user', function()
    {
        //
    });

});
</code></pre>

<p><a name="route-model-binding"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_model_binding') }}</h2>

<p>
    Model binding provides a convenient way to inject model instances into your routes. For example, instead of injecting a user's ID, you can inject the entire User model instance that matches the given ID. First, use the <code>Route::model</code> method to specify the model that should be used for a given parameter:
</p>

<p><strong>Binding A Parameter To A Model</strong></p>

<pre><code>Route::model('user', 'User');
</code></pre>

<p>Next, define a route that contains a <code>{user}</code> parameter:</p>

<pre><code>Route::get('profile/{user}', function(User $user)
{
    //
});
</code></pre>

<p>
    Since we have bound the <code>{user}</code> parameter to the <code>User</code> model, a <code>User</code> instance will be injected into the route. So, for example, a request to <code>profile/1</code> will inject the <code>User</code> instance which has an ID of 1.
</p>

<blockquote>
  <p><strong>Note:</strong> If a matching model instance is not found in the database, a 404 error will be thrown.</p>
</blockquote>

<p>
    If you wish to specify your own "not found" behavior, you may pass a Closure as the third argument to the <code>model</code> method:
</p>

<pre><code>Route::model('user', 'User', function()
{
    throw new NotFoundException;
});
</code></pre>

<p>Sometimes you may wish to use your own resolver for route parameters. Simply use the <code>Route::bind</code> method:</p>

<pre><code>Route::bind('user', function($value, $route)
{
    return User::where('name', $value)-&gt;first();
});
</code></pre>

<p><a name="throwing-404-errors"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.throwing_404_errors') }}</h2>

<p>
    There are two ways to manually trigger a 404 error from a route. First, you may use the <code>App::abort</code> method:
</p>

<pre><code>App::abort(404);
</code></pre>

<p>
    Second, you may throw an instance of <code>Symfony\Component\HttpKernel\Exception\NotFoundHttpException</code>.
</p>

<p>
    More information on handling 404 exceptions and using custom responses for these errors may be found in the <a href="/docs/errors#handling-404-errors">errors</a> section of the documentation.
</p>

<p><a name="routing-to-controllers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.routing_to_controllers') }}</h2>

<p>
    Laravel allows you to not only route to Closures, but also to controller classes, and even allows the creation of <a href="/docs/controllers#resource-controllers">resource controllers</a>.
</p>

<p>
    See the documentation on <a href="/docs/controllers">Controllers</a> for more details.
</p>
@stop;
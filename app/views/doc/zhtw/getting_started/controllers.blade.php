@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.controllers') }}</h1>

<ul>
  <li>
    <a href="#basic-controllers">{{ Lang::get('l4doc.docs_title.getting_started.controllers.basic_controllers') }}</a>
  </li>
  <li>
    <a href="#controller-filters">{{ Lang::get('l4doc.docs_title.getting_started.controllers.controller_filters') }}</a>
  </li>
  <li>
    <a href="#restful-controllers">{{ Lang::get('l4doc.docs_title.getting_started.controllers.restful_controllers') }}</a>
  </li>
  <li>
    <a href="#resource-controllers">{{ Lang::get('l4doc.docs_title.getting_started.controllers.resource_controllers') }}</a>
  </li>
  <li>
    <a href="#handling-missing-methods">{{ Lang::get('l4doc.docs_title.getting_started.controllers.handling_missing_methods') }}</a>
  </li>
</ul>

<p><a name="basic-controllers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.basic_controllers') }}</h2>

<p>
  Instead of defining all of your route-level logic in a single <code>routes.php</code> file, you may wish to organize this behavior using Controller classes. Controllers can group related route logic into a class, as well as take advantage of more advanced framework features such as automatic <a href="/docs/ioc">dependency injection</a>.
</p>

<p>
  Controllers are typically stored in the <code>app/controllers</code> directory, and this directory is registered in the <code>classmap</code> option of your <code>composer.json</code> file by default.
</p>

<p>Here is an example of a basic controller class:</p>

<pre><code>class UserController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function showProfile($id)
    {
        $user = User::find($id);

        return View::make('user.profile', array('user' =&gt; $user));
    }

}
</code></pre>

<p>
  All controllers should extend the <code>BaseController</code> class. The <code>BaseController</code> is also stored in the <code>app/controllers</code> directory, and may be used as a place to put shared controller logic. The <code>BaseController</code> extends the framework's <code>Controller</code> class. Now, We can route to this controller action like so:
</p>

<pre><code>Route::get('user/{id}', 'UserController@showProfile');
</code></pre>

<p>If you choose to nest or organize your controller using PHP namespaces, simply use the fully qualified class name when defining the route:</p>

<pre><code>Route::get('foo', 'Namespace\FooController@method');
</code></pre>

<p>You may also specify names on controller routes:</p>

<pre><code>Route::get('foo', array('uses' =&gt; 'FooController@method',
                                        'as' =&gt; 'name'));
</code></pre>

<p>To generate a URL to a controller action, you may use the <code>URL::action</code> method:</p>

<pre><code>$url = URL::action('FooController@method');
</code></pre>

<p>You may access the name of the controller action being run using the <code>currentRouteAction</code> method:</p>

<pre><code>$action = Route::currentRouteAction();
</code></pre>

<p><a name="controller-filters"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.controller_filters') }}</h2>

<p><a href="/docs/routing#route-filters">Filters</a> may be specified on controller routes similar to "regular" routes:</p>

<pre><code>Route::get('profile', array('before' =&gt; 'auth',
            'uses' =&gt; 'UserController@showProfile'));
</code></pre>

<p>However, you may also specify filters from within your controller:</p>

<pre><code>class UserController extends BaseController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this-&gt;beforeFilter('auth');

        $this-&gt;beforeFilter('csrf', array('on' =&gt; 'post'));

        $this-&gt;afterFilter('log', array('only' =&gt;
                            array('fooAction', 'barAction')));
    }

}
</code></pre>

<p>You may also specify controller filters inline using a Closure:</p>

<pre><code>class UserController extends BaseController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this-&gt;beforeFilter(function()
        {
            //
        });
    }

}
</code></pre>

<p><a name="restful-controllers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.restful_controllers') }}</h2>

<p>
  Laravel allows you to easily define a single route to handle every action in a controller using simple, REST naming conventions. First, define the route using the <code>Route::controller</code> method:
</p>

<p><strong>Defining A RESTful Controller</strong></p>

<pre><code>Route::controller('users', 'UserController');
</code></pre>

<p>
  The <code>controller</code> method accepts two arguments. The first is the base URI the controller handles, while the second is the class name of the controller. Next, just add methods to your controller, prefixed with the HTTP verb they respond to:
</p>

<pre><code>class UserController extends BaseController {

    public function getIndex()
    {
        //
    }

    public function postProfile()
    {
        //
    }

}
</code></pre>

<p>The <code>index</code> methods will respond to the root URI handled by the controller, which, in this case, is <code>users</code>.</p>

<p>
  If your controller action contains multiple words, you may access the action using "dash" syntax in the URI. For example, the following controller action on our <code>UserController</code> would respond to the <code>users/admin-profile</code> URI:
</p>

<pre><code>public function getAdminProfile() {}
</code></pre>

<p><a name="resource-controllers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.resource_controllers') }}</h2>

<p>
  Resource controllers make it easier to build RESTful controllers around resources. For example, you may wish to create a controller that manages "photos" stored by your application. Using the <code>controller:make</code> command via the Artisan CLI and the <code>Route::resource</code> method, we can quickly create such a controller.
</p>

<p>To create the controller via the command line, execute the following command:</p>

<pre><code>php artisan controller:make PhotoController
</code></pre>

<p>Now we can register a resourceful route to the controller:</p>

<pre><code>Route::resource('photo', 'PhotoController');
</code></pre>

<p>
  This single route declaration creates multiple routes to handle a variety of RESTful actions on the photo resource. Likewise, the generated controller will already have stubbed methods for each of these actions with notes informing you which URIs and verbs they handle.
</p>

<p><strong>Actions Handled By Resource Controller</strong></p>

<table>
<thead>
<tr>
  <th>Verb</th>
  <th>Path</th>
  <th>Action</th>
  <th>Route Name</th>
</tr>
</thead>
<tbody>
<tr>
  <td>GET</td>
  <td>/resource</td>
  <td>index</td>
  <td>resource.index</td>
</tr>
<tr>
  <td>GET</td>
  <td>/resource/create</td>
  <td>create</td>
  <td>resource.create</td>
</tr>
<tr>
  <td>POST</td>
  <td>/resource</td>
  <td>store</td>
  <td>resource.store</td>
</tr>
<tr>
  <td>GET</td>
  <td>/resource/{id}</td>
  <td>show</td>
  <td>resource.show</td>
</tr>
<tr>
  <td>GET</td>
  <td>/resource/{id}/edit</td>
  <td>edit</td>
  <td>resource.edit</td>
</tr>
<tr>
  <td>PUT/PATCH</td>
  <td>/resource/{id}</td>
  <td>update</td>
  <td>resource.update</td>
</tr>
<tr>
  <td>DELETE</td>
  <td>/resource/{id}</td>
  <td>destroy</td>
  <td>resource.destroy</td>
</tr>
</tbody>
</table>

<p>Sometimes you may only need to handle a subset of the resource actions:</p>

<pre><code>php artisan controller:make PhotoController --only=index,show

php artisan controller:make PhotoController --except=index
</code></pre>

<p>And, you may also specify a subset of actions to handle on the route:</p>

<pre><code>Route::resource('photo', 'PhotoController',
                array('only' =&gt; array('index', 'show')));
</code></pre>

<p><a name="handling-missing-methods"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.handling_missing_methods') }}</h2>

<p>
  A catch-all method may be defined which will be called when no other matching method is found on a given controller. The method should be named <code>missingMethod</code>, and receives the parameter array for the request as its only argument:
</p>

<p><strong>Defining A Catch-All Method</strong></p>

<pre><code>public function missingMethod($parameters)
{
    //
}
</code></pre>
@stop;
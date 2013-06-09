@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</h1>

<ul>
<li>
    <a href="#introduction">{{ Lang::get('l4doc.docs_title.learning_more.ioc.introduction') }}</a>
</li>
<li>
    <a href="#basic-usage">{{ Lang::get('l4doc.docs_title.learning_more.ioc.basic_usage') }}</a>
</li>
<li>
    <a href="#automatic-resolution">{{ Lang::get('l4doc.docs_title.learning_more.ioc.automatic_resolution') }}</a>
</li>
<li>
    <a href="#practical-usage">{{ Lang::get('l4doc.docs_title.learning_more.ioc.practical_usage') }}</a>
</li>
<li>
    <a href="#service-providers">{{ Lang::get('l4doc.docs_title.learning_more.ioc.service_providers') }}</a>
</li>
<li>
    <a href="#container-events">{{ Lang::get('l4doc.docs_title.learning_more.ioc.container_events') }}</a>
</li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.basic_usage') }}</h2>

<p>
    The Laravel inversion of control container is a powerful tool for managing class dependencies. Dependency injection is a method of removing hard-coded class dependencies. Instead, the dependencies are injected at run-time, allowing for greater flexibility as dependency implementations may be swapped easily.
</p>

<p>
    Understanding the Laravel IoC container is essential to building a powerful, large application, as well as for contributing to the Laravel core itself.
</p>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.automatic_resolution') }}</h2>

<p>
    There are two ways the IoC container can resolve dependencies: via Closure callbacks or automatic resolution. First, we'll explore Closure callbacks. First, a "type" may be bound into the container:
</p>

<p><strong>Binding A Type Into The Container</strong></p>

<pre><code>App::bind('foo', function($app)
{
    return new FooBar;
});
</code></pre>

<p><strong>Resolving A Type From The Container</strong></p>

<pre><code>$value = App::make('foo');
</code></pre>

<p>When the <code>App::make</code> method is called, the Closure callback is executed and the result is returned.</p>

<p>
    Sometimes, you may wish to bind something into the container that should only be resolved once, and the same instance should be returned on subsequent calls into the container:
</p>

<p><strong>Binding A "Shared" Type Into The Container</strong></p>

<pre><code>App::singleton('foo', function()
{
    return new FooBar;
});
</code></pre>

<p>You may also bind an existing object instance into the container using the <code>instance</code> method:</p>

<p><strong>Binding An Existing Instance Into The Container</strong></p>

<pre><code>$foo = new Foo;

App::instance('foo', $foo);
</code></pre>

<p><a name="automatic-resolution"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.automatic_resolution') }}</h2>

<p>The IoC container is powerful enough to resolve classes without any configuration at all in many scenarios. For example:</p>

<p><strong>Resolving A Class</strong></p>

<pre><code>class FooBar {

    public function __construct(Baz $baz)
    {
        $this-&gt;baz = $baz;
    }

}

$fooBar = App::make('FooBar');
</code></pre>

<p>
    Note that even though we did not register the FooBar class in the container, the container will still be able to resolve the class, even injecting the <code>Baz</code> dependency automatically!
</p>

<p>
    When a type is not bound in the container, it will use PHP's Reflection facilities to inspect the class and read the constructor's type-hints. Using this information, the container can automatically build an instance of the class.
</p>

<p>
    However, in some cases, a class may depend on an interface implementation, not a "concrete type". When this is the case, the <code>App::bind</code> method must be used to inform the container which interface implementation to inject:
</p>

<p><strong>Binding An Interface To An Implementation</strong></p>

<pre><code>App::bind('UserRepositoryInterface', 'DbUserRepository');
</code></pre>

<p>Now consider the following controller:</p>

<pre><code>class UserController extends BaseController {

    public function __construct(UserRepositoryInterface $users)
    {
        $this-&gt;users = $users;
    }

}
</code></pre>

<p>
    Since we have bound the <code>UserRepositoryInterface</code> to a concrete type, the <code>DbUserRepository</code> will automatically be injected into this controller when it is created.
</p>

<p><a name="practical-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.practical_usage') }}</h2>

<p>
    Laravel provides several opportunities to use the IoC container to increase the flexibility and testability of your application. One primary example is when resolving controllers. All controllers are resolved through the IoC container, meaning you can type-hint dependencies in a controller constructor, and they will automatically be injected.
</p>

<p><strong>Type-Hinting Controller Dependencies</strong></p>

<pre><code>class OrderController extends BaseController {

    public function __construct(OrderRepository $orders)
    {
        $this-&gt;orders = $orders;
    }

    public function getIndex()
    {
        $all = $this-&gt;orders-&gt;all();

        return View::make('orders', compact('all'));
    }

}
</code></pre>

<p>
    In this example, the <code>OrderRepository</code> class will automatically be injected into the controller. This means that when <a href="/docs/testing">unit testing</a> a "mock" <code>OrderRepository</code> may be bound into the container and injected into the controller, allowing for painless stubbing of database layer interaction.
</p>

<p>
    <a href="/docs/routing#route-filters">Filters</a>, <a href="/docs/responses#view-composers">composers</a>, and <a href="/docs/events#using-classes-as-listeners">event handlers</a> may also be resolved out of the IoC container. When registering them, simply give the name of the class that should be used:
</p>

<p><strong>Other Examples Of IoC Usage</strong></p>

<pre><code>Route::filter('foo', 'FooFilter');

View::composer('foo', 'FooComposer');

Event::listen('foo', 'FooHandler');
</code></pre>

<p><a name="service-providers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.service_providers') }}</h2>

<p>
    Service providers are a great way to group related IoC registrations in a single location. Think of them as a way to bootstrap components in your application. Within a service provider, you might register a custom authentication driver, register your application's repository classes with the IoC container, or even setup a custom Artisan command.
</p>

<p>
    In fact, most of the core Laravel components include service providers. All of the registered service providers for your application are listed in the <code>providers</code> array of the <code>app/config/app.php</code> configuration file.
</p>

<p>
    To create a service provider, simply extend the <code>Illuminate\Support\ServiceProvider</code> class and define a <code>register</code> method:
</p>

<p><strong>Defining A Service Provider</strong></p>

<pre><code>use Illuminate\Support\ServiceProvider;

class FooServiceProvider extends ServiceProvider {

    public function register()
    {
        $this-&gt;app-&gt;bind('foo', function()
        {
            return new Foo;
        });
    }

}
</code></pre>

<p>
    Note that in the <code>register</code> method, the application IoC container is available to you via the <code>$this-&gt;app</code> property. Once you have created a provider and are ready to register it with your application, simply add it to the <code>providers</code> array in your <code>app</code> configuration file.
</p>

<p>You may also register a service provider at run-time using the <code>App::register</code> method:</p>

<p><strong>Registering A Service Provider At Run-Time</strong></p>

<pre><code>App::register('FooServiceProvider');
</code></pre>

<p><a name="container-events"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.container_events') }}</h2>

<p>
    The container fires an event each time it resolves an object. You may listen to this event using the <code>resolving</code> method:
</p>

<p><strong>Registering A Resolving Listener</strong></p>

<pre><code>App::resolving(function($object)
{
    //
});
</code></pre>

<p>Note that the object that was resolved will be passed to the callback.</p>
@stop;
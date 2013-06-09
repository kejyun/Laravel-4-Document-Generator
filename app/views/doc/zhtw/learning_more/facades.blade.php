@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.facades') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.learning_more.facades.introduction') }}</a>
    </li>
    <li>
        <a href="#explanation">{{ Lang::get('l4doc.docs_title.learning_more.facades.explanation') }}</a>
    </li>
    <li>
        <a href="#practical-usage">{{ Lang::get('l4doc.docs_title.learning_more.facades.practical_usage') }}</a>
    </li>
    <li>
        <a href="#creating-facades">{{ Lang::get('l4doc.docs_title.learning_more.facades.creating_facades') }}</a>
    </li>
    <li>
        <a href="#mocking-facades">{{ Lang::get('l4doc.docs_title.learning_more.facades.mocking_facades') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.introduction') }}</h2>

<p>
    Facades provide a "static" interface to classes that are available in the application's <a href="/docs/ioc">IoC container</a>. Laravel ships with many facades, and you have probably been using them without even knowing it!
</p>

<p>
    Occasionally, You may wish to create your own facades for your applications and packages, so let's explore the concept, development and usage of these classes.
</p>

<blockquote>
  <p><strong>Note:</strong> Before digging into facades, it is strongly recommended that you become very familiar with the Laravel <a href="/docs/ioc">IoC container</a>.</p>
</blockquote>

<p><a name="explanation"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.explanation') }}</h2>

<p>
    In the context of a Laravel application, a facade is a class that provides access to an object from the container. The machinery that makes this work is in the <code>Facade</code> class. Laravel's facades, and any custom facades you create, will extend the base <code>Facade</code> class.
</p>

<p>
    Your facade class only needs to implement a single method: <code>getFacadeAccessor</code>. It's the <code>getFacadeAccessor</code> method's job to define what to resolve from the container. The <code>Facade</code> base class makes use of the <code>__callStatic()</code> magic-method to defer calls from your facade to the resolved object.
</p>

<p><a name="practical-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.practical_usage') }}</h2>

<p>
    In the example below, a call is made to the Laravel cache system. By glancing at this code, one might assume that the static method <code>get</code> is being called on the <code>Cache</code> class.
</p>

<pre><code>$value = Cache::get('key');
</code></pre>

<p>
    However, if we look at that <code>Illuminate\Support\Facades\Cache</code> class, you'll see that there is no static method <code>get</code>:
</p>

<pre><code>class Cache extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'cache'; }

}
</code></pre>

<p>
    The Cache class extends the base <code>Facade</code> class and defines a method <code>getFacadeAccessor()</code>. Remember, this method's job is to return the name of an IoC binding.
</p>

<p>
    When a user references any static method on the <code>Cache</code> facade, Laravel resolves the <code>cache</code> binding from the IoC container and runs the requested method (in this case, <code>get</code>) against that object.
</p>

<p>So, our <code>Cache::get</code> call could be re-written like so:</p>

<pre><code>$value = $app-&gt;make('cache')-&gt;get('key');
</code></pre>

<p><a name="creating-facades"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.creating_facades') }}</h2>

<p>Creating a facade for your own application or package is simple. You only need 3 things:</p>

<ul>
<li>An IoC binding</li>
<li>A facade class.</li>
<li>A facade alias configuration.</li>
</ul>

<p>Let's look at an example. Here, we have a class defined as <code>PaymentGateway\Payment</code>.</p>

<pre><code>namespace PaymentGateway;

class Payment {

    public function process()
    {
        //
    }

}
</code></pre>

<p>We need to be able to resolve this class from the IoC container. So, let's add a binding:</p>

<pre><code>App::bind('payment', function()
{
    return new \PaymentGateway\Payment;
});
</code></pre>

<p>
    A great place to register this binding would be to create a new <a href="/docs/ioc#service-providers">service provider</a> named <code>PaymentServiceProvider</code>, and add this binding to the <code>register</code> method. You can then configure Laravel to load your service provider from the <code>app/config/app.php</code> configuration file.
</p>

<p>Next, we can create our own facade class:</p>

<pre><code>use Illuminate\Support\Facades\Facade;

class Payment extends Facade {

    protected static function getFacadeAccessor() { return 'payment'; }

}
</code></pre>

<p>
    Finally, if we wish, we can add an alias for our facade to the <code>aliases</code> array in the <code>app/config/app.php</code> configuration file. Now, we can call the <code>process</code> method on an instance of the <code>Payment</code> class.
</p>

<pre><code>Payment::process();
</code></pre>

<p><a name="mocking-facades"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.mocking_facades') }}</h2>

<p>
    Unit testing is an important aspect of why facades work the way that they do. In fact, testability is the primary reason for facades to even exist. For more information, check out the <a href="/docs/testing#mocking-facades">mocking facades</a> section of the documentation.
</p>
@stop;
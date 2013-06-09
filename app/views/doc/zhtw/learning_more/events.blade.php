@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.events') }}</h1>

<ul>
    <li>
        <a href="#basic-usage">{{ Lang::get('l4doc.docs_title.learning_more.events.basic_usage') }}</a>
    </li>
    <li>
        <a href="#wildcard-listeners">{{ Lang::get('l4doc.docs_title.learning_more.events.wildcard_listeners') }}</a>
    </li>
    <li>
        <a href="#using-classes-as-listeners">{{ Lang::get('l4doc.docs_title.learning_more.events.using_classes_as_listeners') }}</a>
    </li>
    <li>
        <a href="#queued-events">{{ Lang::get('l4doc.docs_title.learning_more.events.queued_events') }}</a>
    </li>
    <li>
        <a href="#event-subscribers">{{ Lang::get('l4doc.docs_title.learning_more.events.event_subscribers') }}</a>
    </li>
</ul>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.events.basic_usage') }}</h2>

<p>
    The Laravel <code>Event</code> class provides a simple observer implementation, allowing you to subscribe and listen for events in your application.
</p>

<p><strong>Subscribing To An Event</strong></p>

<pre><code>Event::listen('user.login', function($user)
{
    $user-&gt;last_login = new DateTime;

    $user-&gt;save();
});
</code></pre>

<p><strong>Firing An Event</strong></p>

<pre><code>$event = Event::fire('user.login', array($user));
</code></pre>

<p>
    You may also specify a priority when subscribing to events. Listeners with higher priority will be run first, while listeners that have the same priority will be run in order of subscription.
</p>

<p><strong>Subscribing To Events With Priority</strong></p>

<pre><code>Event::listen('user.login', 'LoginHandler', 10);

Event::listen('user.login', 'OtherHandler', 5);
</code></pre>

<p>Sometimes, you may wish to stop the propagation of an event to other listeners. You may do so using by returning <code>false</code> from your listener:</p>

<p><strong>Stopping The Propagation Of An Event</strong></p>

<pre><code>Event::listen('user.login', function($event)
{
    // Handle the event...

    return false;
});
</code></pre>

<p><a name="wildcard-listeners"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.events.wildcard_listeners') }}</h2>

<p>When registering an event listener, you may use asterisks to specify wildcard listeners:</p>

<p><strong>Registering Wildcard Event Listeners</strong></p>

<pre><code>Event::listen('foo.*', function($param, $event)
{
    // Handle the event...
});
</code></pre>

<p>
    This listener will handle all events that begin with <code>foo.</code>. Note that the full event name is passed as the last argument to the handler.
</p>

<p><a name="using-classes-as-listeners"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.events.using_classes_as_listeners') }}</h2>

<p>
    In some cases, you may wish to use a class to handle an event rather than a Closure. Class event listeners will be resolved out of the <a href="/docs/ioc">Laravel IoC container</a>, providing you the full power of dependency injection on your listeners.
</p>

<p><strong>Registering A Class Listener</strong></p>

<pre><code>Event::listen('user.login', 'LoginHandler');
</code></pre>

<p>By default, the <code>handle</code> method on the <code>LoginHandler</code> class will be called:</p>

<p><strong>Defining An Event Listener Class</strong></p>

<pre><code>class LoginHandler {

    public function handle($data)
    {
        //
    }

}
</code></pre>

<p>
    If you do not wish to use the default <code>handle</code> method, you may specify the method that should be subscribed:
</p>

<p><strong>Specifying Which Method To Subscribe</strong></p>

<pre><code>Event::listen('user.login', 'LoginHandler@onLogin');
</code></pre>

<p><a name="queued-events"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.events.queued_events') }}</h2>

<p>
    Using the <code>queue</code> and <code>flush</code> methods, you may "queue" an event for firing, but not fire it immediately:
</p>

<p><strong>Registering A Queued Event</strong></p>

<pre><code>Event::queue('foo', array($user));
</code></pre>

<p><strong>Registering An Event Flusher</strong></p>

<pre><code>Event::flusher('foo', function($user)
{
    //
});
</code></pre>

<p>Finally, you may run the "flusher" and flush all queued events using the <code>flush</code> method:</p>

<pre><code>Event::flush('foo');
</code></pre>

<p><a name="event-subscribers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.events.event_subscribers') }}</h2>

<p>
    Event subscribers are classes that may subscribe to multiple events from within the class itself. Subscribers should define a <code>subscribe</code> method, which will be passed an event dispatcher instance:
</p>

<p><strong>Defining An Event Subscriber</strong></p>

<pre><code>class UserEventHandler {

    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        //
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
        //
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events-&gt;listen('user.login', 'UserEventHandler@onUserLogin');

        $events-&gt;listen('user.logout', 'UserEventHandler@onUserLogout');
    }

}
</code></pre>

<p>Once the subscriber has been defined, it may be registered with the <code>Event</code> class.</p>

<p><strong>Registering An Event Subscriber</strong></p>

<pre><code>$subscriber = new UserEventHandler;

Event::subscribe($subscriber);
</code></pre>
@stop;
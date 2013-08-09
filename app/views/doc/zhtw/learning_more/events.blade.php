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
    Laravel 的 <code>Event</code> 類別提供一個簡單的觀察者實作，允許你訂閱及傾聽你應用程式的事件。
</p>

<p><strong>訂閱事件</strong></p>

<pre><code>Event::listen('user.login', function($user)
{
    $user-&gt;last_login = new DateTime;

    $user-&gt;save();
});
</code></pre>

<p><strong>觸發事件</strong></p>

<pre><code>$event = Event::fire('user.login', array($user));
</code></pre>

<p>
    你也可以指定訂閱事件的優先順序，有更高優先等級傾聽器會先被執行，如果有相同優先等級的傾聽器，將會依照事件訂閱順序依序執行。
</p>

<p><strong>訂閱有優先等級的事件</strong></p>

<pre><code>Event::listen('user.login', 'LoginHandler', 10);

Event::listen('user.login', 'OtherHandler', 5);
</code></pre>

<p>
    有時候，你也需希望能夠停止擴散事件到其他事件傾聽器，你可以在你的傾聽器中回傳 <code>false</code> 達到停止擴散的目的:
</p>

<p><strong>停止傳遞事件</strong></p>

<pre><code>Event::listen('user.login', function($event)
{
    // Handle the event...

    return false;
});
</code></pre>

<p><a name="wildcard-listeners"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.events.wildcard_listeners') }}</h2>

<p>
    你可以使用萬用字元 (*) 去註冊事件傾聽器:
</p>

<p><strong>註冊萬用字元事件傾聽器</strong></p>

<pre><code>Event::listen('foo.*', function($param, $event)
{
    // Handle the event...
});
</code></pre>

<p>
    這個傾聽器將會處理所有開頭為 <code>foo.</code> 的所有事件，注意到，完整的事件名稱，將會當作最後一個參數，傳給送處理器。
</p>

<p><a name="using-classes-as-listeners"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.events.using_classes_as_listeners') }}</h2>

<p>
    在某些例子中，你可能希望使用一個類別去處理事件，而不是用閉合函式，類別事件傾聽器將會在 <a href="/docs/ioc">Laravel IoC container</a> 中被處理，提供一個完整強大的相依性，注入在你的傾聽器中。
</p>

<p><strong>註冊事件傾聽器類別</strong></p>

<pre><code>Event::listen('user.login', 'LoginHandler');
</code></pre>

<p>
    預設，在 <code>LoginHandler</code> 類別的 <code>handle</code> 方法將會被呼叫:
</p>

<p><strong>定義事件傾聽器類別</strong></p>

<pre><code>class LoginHandler {

    public function handle($data)
    {
        //
    }

}
</code></pre>

<p>
    假如你不希望使用預設 <code>handle</code> 方法，你可以在訂閱事件中，指定要執行的方法:
</p>

<p><strong>指定訂閱事件的方法</strong></p>

<pre><code>Event::listen('user.login', 'LoginHandler@onLogin');
</code></pre>

<p><a name="queued-events"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.events.queued_events') }}</h2>

<p>
    使用 <code>queue</code> 及 <code>flush</code> 方法，你可以不要立即觸發事件，將事件存放在 "佇列" 中，等著之後再被觸發:
</p>

<p><strong>註冊一個佇列事件</strong></p>

<pre><code>Event::queue('foo', array($user));
</code></pre>

<p><strong>註冊一個事件清除器</strong></p>

<pre><code>Event::flusher('foo', function($user)
{
    //
});
</code></pre>

<p>
    最後，你可以使用 <code>flush</code> 方法，執行 "事件清除器" 去清除所有被 "佇列" 的事件:
</p>

<pre><code>Event::flush('foo');
</code></pre>

<p><a name="event-subscribers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.events.event_subscribers') }}</h2>

<p>
    事件訂閱是類別時，可以在類別中訂閱數個事件，訂閱者應定義 <code>subscribe</code> 方法，此方法將會被事件分配器實例傳遞:
</p>

<p><strong>定義事件訂閱者</strong></p>

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

<p>
    只要訂閱者被定義，此事件將會在 <code>Event</code> 類別中被註冊。
</p>

<p><strong>註冊事件訂閱者</strong></p>

<pre><code>$subscriber = new UserEventHandler;

Event::subscribe($subscriber);
</code></pre>
@stop;
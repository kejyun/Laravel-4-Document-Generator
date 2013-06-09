@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.errors') }}</h1>

<ul>
	<li>
		<a href="#error-detail">{{ Lang::get('l4doc.docs_title.getting_started.errors.error_detail') }}</a>
	</li>
	<li>
		<a href="#handling-errors">{{ Lang::get('l4doc.docs_title.getting_started.errors.handling_errors') }}</a>
	</li>
	<li>
		<a href="#http-exceptions">{{ Lang::get('l4doc.docs_title.getting_started.errors.http_exceptions') }}</a>
	</li>
	<li>
		<a href="#handling-404-errors">{{ Lang::get('l4doc.docs_title.getting_started.errors.handling_404_errors') }}</a>
	</li>
	<li>
		<a href="#logging">{{ Lang::get('l4doc.docs_title.getting_started.errors.logging') }}</a>
	</li>
</ul>

<p><a name="error-detail"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.error_detail') }}</h2>

<p>By default, error detail is enabled for your application. This means that when an error occurs you will be shown an error page with a detailed stack trace and error message. You may turn off error details by setting the <code>debug</code> option in your <code>app/config/app.php</code> file to <code>false</code>. <strong>It is strongly recommended that you turn off error detail in a production environment.</strong></p>

<p><a name="handling-errors"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.handling_errors') }}</h2>

<p>By default, the <code>app/start/global.php</code> file contains an error handler for all exceptions:</p>

<pre><code>App::error(function(Exception $exception)
{
    Log::error($exception);
});
</code></pre>

<p>This is the most basic error handler. However, you may specify more handlers if needed. Handlers are called based on the type-hint of the Exception they handle. For example, you may create a handler that only handles <code>RuntimeException</code> instances:</p>

<pre><code>App::error(function(RuntimeException $exception)
{
    // Handle the exception...
});
</code></pre>

<p>If an exception handler returns a response, that response will be sent to the browser and no other error handlers will be called:</p>

<pre><code>App::error(function(InvalidUserException $exception)
{
    Log::error($exception);

    return 'Sorry! Something is wrong with this account!';
});
</code></pre>

<p>To listen for PHP fatal errors, you may use the <code>App::fatal</code> method:</p>

<pre><code>App::fatal(function($exception)
{
    //
});
</code></pre>

<p><a name="http-exceptions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.http_exceptions') }}</h2>

<p>Exceptions in respect to HTTP, refer to errors that may occur during a client request. This may be a page not found error (404), an unauthorized error (401) or even a generated 500 error. In order to return such a response, use the following:</p>

<pre><code>App::abort(404, 'Page not found');
</code></pre>

<p>The first argument, is the HTTP status code, with the following being a custom message you'd like to show with the error.</p>

<p>In order to raise a 401 Unauthorized exception, just do the following:</p>

<pre><code>App::abort(401, 'You are not authorized.');
</code></pre>

<p>These exceptions can be executed at any time during the request's lifecycle.</p>

<p><a name="handling-404-errors"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.handling_404_errors') }}</h2>

<p>You may register an error handler that handles all "404 Not Found" errors in your application, allowing you to return custom 404 error pages:</p>

<pre><code>App::missing(function($exception)
{
    return Response::view('errors.missing', array(), 404);
});
</code></pre>

<p><a name="logging"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.logging') }}</h2>

<p>The Laravel logging facilities provide a simple layer on top of the powerful <a href="http://github.com/seldaek/monolog">Monolog</a>. By default, Laravel is configured to create daily log files for your application, and these files are stored in <code>app/storage/logs</code>. You may write information to these logs like so:</p>

<pre><code>Log::info('This is some useful information.');

Log::warning('Something could be going wrong.');

Log::error('Something is really going wrong.');
</code></pre>

<p>The logger provides the seven logging levels defined in <a href="http://tools.ietf.org/html/rfc5424">RFC 5424</a>: <strong>debug</strong>, <strong>info</strong>, <strong>notice</strong>, <strong>warning</strong>, <strong>error</strong>, <strong>critical</strong>, and <strong>alert</strong>.</p>

<p>Monolog has a variety of additional handlers you may use for logging. If needed, you may access the underlying Monolog instance being used by Laravel:</p>

<pre><code>$monolog = Log::getMonolog();
</code></pre>

<p>You may also register an event to catch all messages passed to the log:</p>

<p><strong>Registering A Log Listener</strong></p>

<pre><code>Log::listen(function($level, $message, $context)
{
    //
});
</code></pre>
@stop;
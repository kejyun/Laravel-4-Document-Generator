@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.lifecycle') }}</h1>

<ul>
	<li>
		<a href="#overview">{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.overview') }}</a>
	</li>
	<li>
		<a href="#start-files">{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.start_files') }}</a>
	</li>
	<li>
		<a href="#application-events">{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.application_events') }}</a>
	</li>
</ul>

<p><a name="overview"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.overview') }}</h2>

<p>
	The Laravel request lifecycle is fairly simple. A request enters your application and is dispatched to the appropriate route or controller. The response from that route is then sent back to the browser and displayed on the screen. Sometimes you may wish to do some processing before or after your routes are actually called. There are several opportunities to do this, two of which are "start" files and application events.
</p>

<p><a name="start-files"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.start_files') }}</h2>

<p>
	Your application's start files are stored at <code>app/start</code>. By default, three are included with your application: <code>global.php</code>, <code>local.php</code>, and <code>artisan.php</code>. For more information about <code>artisan.php</code>, refer to the documentation on the <a href="/docs/commands#registering-commands">Artisan command line</a>.
</p>

<p>
	The <code>global.php</code> start file contains a few basic items by default, such as the registration of the <a href="/docs/errors">Logger</a> and the inclusion of your <code>app/filters.php</code> file. However, you are free to add anything to this file that you wish. It will be automatically included on <em>every</em> request to your application, regardless of environment. The <code>local.php</code> file, on the other hand, is only called when the application is executing in the <code>local</code> environment. For more information on environments, check out the <a href="/docs/configuration">configuration</a> documentation.
</p>

<p>
	Of course, if you have other environments in addition to <code>local</code>, you may create start files for those environments as well. They will be automatically included when your application is running in that environment.
</p>

<p><a name="application-events"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.lifecycle.application_events') }}</h2>

<p>
	You may also do pre and post request processing by registering <code>before</code>, <code>after</code>, <code>close</code>, <code>finish</code>, and <code>shutdown</code> application events:
</p>

<p><strong>Registering Application Events</strong></p>

<pre><code>App::before(function()
{
    //
});

App::after(function($request, $response)
{
    //
});
</code></pre>

<p>Listeners to these events will be run <code>before</code> and <code>after</code> each request to your application.</p>
@stop;
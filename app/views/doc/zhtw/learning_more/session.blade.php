@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.session') }}</h1>

<ul>
	<li>
		<a href="#configuration">{{ Lang::get('l4doc.docs_title.learning_more.session.configuration') }}</a>
	</li>
	<li>
		<a href="#session-usage">{{ Lang::get('l4doc.docs_title.learning_more.session.session_usage') }}</a>
	</li>
	<li>
		<a href="#flash-data">{{ Lang::get('l4doc.docs_title.learning_more.session.flash_data') }}</a>
	</li>
	<li>
		<a href="#database-sessions">{{ Lang::get('l4doc.docs_title.learning_more.session.database_sessions') }}</a>
	</li>
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.session.configuration') }}</h2>

<p>Since HTTP driven applications are stateless, sessions provide a way to store information about the user across requests. Laravel ships with a variety of session back-ends available for use through a clean, unified API. Support for popular back-ends such as <a href="http://memcached.org">Memcached</a>, <a href="http://redis.io">Redis</a>, and databases is included out of the box.</p>

<p>The session configuration is stored in <code>app/config/session.php</code>. Be sure to review the well documented options available to you in this file. By default, Laravel is configured to use the <code>native</code> session driver, which will work well for the majority of applications.</p>

<p><a name="session-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.session.session_usage') }}</h2>

<p><strong>Storing An Item In The Session</strong></p>

<pre><code>Session::put('key', 'value');
</code></pre>

<p><strong>Retrieving An Item From The Session</strong></p>

<pre><code>$value = Session::get('key');
</code></pre>

<p><strong>Retrieving An Item Or Returning A Default Value</strong></p>

<pre><code>$value = Session::get('key', 'default');

$value = Session::get('key', function() { return 'default'; });
</code></pre>

<p><strong>Determining If An Item Exists In The Session</strong></p>

<pre><code>if (Session::has('users'))
{
    //
}
</code></pre>

<p><strong>Removing An Item From The Session</strong></p>

<pre><code>Session::forget('key');
</code></pre>

<p><strong>Removing All Items From The Session</strong></p>

<pre><code>Session::flush();
</code></pre>

<p><strong>Regenerating The Session ID</strong></p>

<pre><code>Session::regenerate();
</code></pre>

<p><a name="flash-data"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.session.flash_data') }}</h2>

<p>Sometimes you may wish to store items in the session only for the next request. You may do so using the <code>Session::flash</code> method:</p>

<pre><code>Session::flash('key', 'value');
</code></pre>

<p><strong>Reflashing The Current Flash Data For Another Request</strong></p>

<pre><code>Session::reflash();
</code></pre>

<p><strong>Reflashing Only A Subset Of Flash Data</strong></p>

<pre><code>Session::keep(array('username', 'email'));
</code></pre>

<p><a name="database-sessions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.session.database_sessions') }}</h2>

<p>When using the <code>database</code> session driver, you will need to setup a table to contain the session items. Below is an example <code>Schema</code> declaration for the table:</p>

<pre><code>Schema::create('sessions', function($table)
{
    $table-&gt;string('id')-&gt;unique();
    $table-&gt;text('payload');
    $table-&gt;integer('last_activity');
});
</code></pre>

<p>Of course, you may use the <code>session:table</code> Artisan command to generate this migration for you!</p>

<pre><code>php artisan session:table

composer dump-autoload

php artisan migrate
</code></pre>
@stop;
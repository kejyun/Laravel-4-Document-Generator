@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.database') }}</h1>

<ul>
	<li>
		<a href="#configuration">{{ Lang::get('l4doc.docs_title.db.database.configuration') }}</a>
	</li>
	<li>
		<a href="#running-queries">{{ Lang::get('l4doc.docs_title.db.database.running_queries') }}</a>
	</li>
	<li>
		<a href="#db-transactions">{{ Lang::get('l4doc.docs_title.db.database.database_transactions') }}</a>
	</li>
	<li>
		<a href="#accessing-connections">{{ Lang::get('l4doc.docs_title.db.database.accessing_connections') }}</a>
	</li>
	<li>
		<a href="#query-logging">{{ Lang::get('l4doc.docs_title.db.database.query_logging') }}</a>
	</li>
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.database.configuration') }}</h2>

<p>
	Laravel makes connecting with dbs and running queries extremely simple. The db configuration file is <code>app/config/db.php</code>. In this file you may define all of your db connections, as well as specify which connection should be used by default. Examples for all of the supported db systems are provided in this file.
</p>

<p>Currently Laravel supports four db systems: MySQL, Postgres, SQLite, and SQL Server.</p>

<p><a name="running-queries"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.database.running_queries') }}</h2>

<p>Once you have configured your db connection, you may run queries using the <code>DB</code> class.</p>

<p><strong>Running A Select Query</strong></p>

<pre><code>$results = DB::select('select * from users where id = ?', array(1));
</code></pre>

<p>The <code>select</code> method will always return an <code>array</code> of results.</p>

<p><strong>Running An Insert Statement</strong></p>

<pre><code>DB::insert('insert into users (id, name) values (?, ?)', array(1, 'Dayle'));
</code></pre>

<p><strong>Running An Update Statement</strong></p>

<pre><code>DB::update('update users set votes = 100 where name = ?', array('John'));
</code></pre>

<p><strong>Running A Delete Statement</strong></p>

<pre><code>DB::delete('delete from users');
</code></pre>

<blockquote>
  <p><strong>Note:</strong> The <code>update</code> and <code>delete</code> statements return the number of rows affected by the operation.</p>
</blockquote>

<p><strong>Running A General Statement</strong></p>

<pre><code>DB::statement('drop table users');
</code></pre>

<p>You may listen for query events using the <code>DB::listen</code> method:</p>

<p><strong>Listening For Query Events</strong></p>

<pre><code>DB::listen(function($sql, $bindings, $time)
{
    //
});
</code></pre>

<p><a name="db-transactions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.database.database_transactions') }}</h2>

<p>To run a set of operations within a db transaction, you may use the <code>transaction</code> method:</p>

<pre><code>DB::transaction(function()
{
    DB::table('users')-&gt;update(array('votes' =&gt; 1));

    DB::table('posts')-&gt;delete();
});
</code></pre>

<p><a name="accessing-connections"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.database.accessing_connections') }}</h2>

<p>When using multiple connections, you may access them via the <code>DB::connection</code> method:</p>

<pre><code>$users = DB::connection('foo')-&gt;select(...);
</code></pre>

<p>You may also access the raw, underlying PDO instance:</p>

<pre><code>$pdo = DB::connection()-&gt;getPdo();
</code></pre>

<p>Sometimes you may need to reconnect to a given db:</p>

<pre><code>DB::reconnect('foo');
</code></pre>

<p><a name="query-logging"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.database.query_logging') }}</h2>

<p>
	By default, Laravel keeps a log in memory of all queries that have been run for the current request. However, in some cases, such as when inserting a large number of rows, this can cause the application to use excess memory. To disable the log, you may use the <code>disableQueryLog</code> method:
</p>

<pre><code>DB::connection()-&gt;disableQueryLog();
</code></pre>
@stop;
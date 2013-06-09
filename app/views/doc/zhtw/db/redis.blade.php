@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.redis') }}</h1>

<ul>
	<li>
		<a href="#introduction">{{ Lang::get('l4doc.docs_title.db.redis.introduction') }}</a>
	</li>
	<li>
		<a href="#configuration">{{ Lang::get('l4doc.docs_title.db.redis.configuration') }}</a>
	</li>
	<li>
		<a href="#usage">{{ Lang::get('l4doc.docs_title.db.redis.usage') }}</a>
	</li>
	<li>
		<a href="#pipelining">{{ Lang::get('l4doc.docs_title.db.redis.pipelining') }}</a>
	</li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.redis.introduction') }}</h2>

<p><a href="http://redis.io">Redis</a> is an open source, advanced key-value store. It is often referred to as a data structure server since keys can contain <a href="http://redis.io/topics/data-types#strings">strings</a>, <a href="http://redis.io/topics/data-types#hashes">hashes</a>, <a href="http://redis.io/topics/data-types#lists">lists</a>, <a href="http://redis.io/topics/data-types#sets">sets</a>, and <a href="http://redis.io/topics/data-types#sorted-sets">sorted sets</a>.</p>

<blockquote>
  <p><strong>Note:</strong> If you have the Redis PHP extension installed via PECL, you will need to rename the alias for Redis in your <code>app/config/app.php</code> file.</p>
</blockquote>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.redis.configuration') }}</h2>

<p>The Redis configuration for your application is stored in the <strong>app/config/database.php</strong> file. Within this file, you will see a <strong>redis</strong> array containing the Redis servers used by your application:</p>

<pre><code>'redis' =&gt; array(

    'cluster' =&gt; true,

    'default' =&gt; array('host' =&gt; '127.0.0.1', 'port' =&gt; 6379),

),
</code></pre>

<p>The default server configuration should suffice for development. However, you are free to modify this array based on your environment. Simply give each Redis server a name, and specify the host and port used by the server.</p>

<p>The <code>cluster</code> option will tell the Laravel Redis client to perform client-side sharding across your Redis nodes, allowing you to pool nodes and create a large amount of available RAM. However, note that client-side sharding does not handle failover; therefore, is primarily suited for cached data that is available from another primary data store.</p>

<p><a name="usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.redis.usage') }}</h2>

<p>You may get a Redis instance by calling the <code>Redis::connection</code> method:</p>

<pre><code>$redis = Redis::connection();
</code></pre>

<p>This will give you an instance of the default Redis server. If you are not using server clustering, you may pass the server name to the <code>connection</code> method to get a specific server as defined in your Redis configuration:</p>

<pre><code>$redis = Redis::connection('other');
</code></pre>

<p>Once you have an instance of the Redis client, we may issue any of the <a href="http://redis.io/commands">Redis commands</a> to the instance. Laravel uses magic methods to pass the commands to the Redis server:</p>

<pre><code>$redis-&gt;set('name', 'Taylor');

$name = $redis-&gt;get('name');

$values = $redis-&gt;lrange('names', 5, 10);
</code></pre>

<p>Notice the arguments to the command are simply passed into the magic method. Of course, you are not required to use the magic methods, you may also pass commands to the server using the <code>command</code> method:</p>

<pre><code>$values = $redis-&gt;command('lrange', array(5, 10));
</code></pre>

<p>When you are simply executing commands against the default connection, just use static magic methods on the <code>Redis</code> class:</p>

<pre><code>Redis::set('name', 'Taylor');

$name = Redis::get('name');

$values = Redis::lrange('names', 5, 10);
</code></pre>

<blockquote>
  <p><strong>Note:</strong> Redis <a href="/docs/cache">cache</a> and <a href="/docs/session">session</a> drivers are included with Laravel.</p>
</blockquote>

<p><a name="pipelining"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.redis.pipelining') }}</h2>

<p>Pipelining should be used when you need to send many commands to the server in one operation. To get started, use the <code>pipeline</code> command:</p>

<p><strong>Piping Many Commands To Your Servers</strong></p>

<pre><code>Redis::pipeline(function($pipe)
{
    for ($i = 0; $i &lt; 1000; $i++)
    {
        $pipe-&gt;set("key:$i", $i);
    }
});
</code></pre>
@stop;
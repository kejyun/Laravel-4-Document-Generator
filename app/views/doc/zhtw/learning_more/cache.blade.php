@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.cache') }}</h1>

<ul>
	<li>
		<a href="#configuration">{{ Lang::get('l4doc.docs_title.learning_more.cache.configuration') }}</a>
	</li>
	<li>
		<a href="#cache-usage">{{ Lang::get('l4doc.docs_title.learning_more.cache.cache_usage') }}</a>
	</li>
	<li>
		<a href="#increments-and-decrements">{{ Lang::get('l4doc.docs_title.learning_more.cache.increments_and_decrements') }}</a>
	</li>
	<li>
		<a href="#cache-sections">{{ Lang::get('l4doc.docs_title.learning_more.cache.cache_sections') }}</a>
	</li>
	<li>
		<a href="#database-cache">{{ Lang::get('l4doc.docs_title.learning_more.cache.database_cache') }}</a>
	</li>
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.cache.configuration') }}</h2>

<p>
	Laravel provides a unified API for various caching systems. The cache configuration is located at <code>app/config/cache.php</code>. In this file you may specify which cache driver you would like used by default throughout your application. Laravel supports popular caching backends like <a href="http://memcached.org">Memcached</a> and <a href="http://redis.io">Redis</a> out of the box.
</p>

<p>
	The cache configuration file also contains various other options, which are documented within the file, so make sure to read over these options. By default, Laravel is configured to use the <code>file</code> cache driver, which stores the serialized, cached objects in the filesystem. For larger applications, it is recommended that you use an in-memory cache such as Memcached or APC.
</p>

<p><a name="cache-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.cache.cache_usage') }}</h2>

<p><strong>Storing An Item In The Cache</strong></p>

<pre><code>Cache::put('key', 'value', $minutes);
</code></pre>

<p><strong>Storing An Item In The Cache If It Doesn't Exist</strong></p>

<pre><code>Cache::add('key', 'value', $minutes);
</code></pre>

<p><strong>Checking For Existence In Cache</strong></p>

<pre><code>if (Cache::has('key'))
{
    //
}
</code></pre>

<p><strong>Retrieving An Item From The Cache</strong></p>

<pre><code>$value = Cache::get('key');
</code></pre>

<p><strong>Retrieving An Item Or Returning A Default Value</strong></p>

<pre><code>$value = Cache::get('key', 'default');

$value = Cache::get('key', function() { return 'default'; });
</code></pre>

<p><strong>Storing An Item In The Cache Permanently</strong></p>

<pre><code>Cache::forever('key', 'value');
</code></pre>

<p>
	Sometimes you may wish to retrieve an item from the cache, but also store a default value if the requested item doesn't exist. You may do this using the <code>Cache::remember</code> method:
</p>

<pre><code>$value = Cache::remember('users', $minutes, function()
{
    return DB::table('users')-&gt;get();
});
</code></pre>

<p>You may also combine the <code>remember</code> and <code>forever</code> methods:</p>

<pre><code>$value = Cache::rememberForever('users', function()
{
    return DB::table('users')-&gt;get();
});
</code></pre>

<p>Note that all items stored in the cache are serialized, so you are free to store any type of data.</p>

<p><strong>Removing An Item From The Cache</strong></p>

<pre><code>Cache::forget('key');
</code></pre>

<p><a name="increments-and-decrements"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.cache.increments_and_decrements') }}</h2>

<p>
	All drivers except <code>file</code> and <code>database</code> support the <code>increment</code> and <code>decrement</code> operations:
</p>

<p><strong>Incrementing A Value</strong></p>

<pre><code>Cache::increment('key');

Cache::increment('key', $amount);
</code></pre>

<p><strong>Decrementing A Value</strong></p>

<pre><code>Cache::decrement('key');

Cache::decrement('key', $amount);
</code></pre>

<p><a name="cache-sections"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.cache.cache_sections') }}</h2>

<blockquote>
  <p><strong>Note:</strong> Cache sections are not supported when using the <code>file</code> or <code>database</code> cache drivers.</p>
</blockquote>

<p>Cache sections allow you to group related items in the cache, and then flush the entire section. To access a section, use the <code>section</code> method:</p>

<p><strong>Accessing A Cache Section</strong></p>

<pre><code>Cache::section('people')-&gt;put('John', $john);

Cache::section('people')-&gt;put('Anne', $anne);
</code></pre>

<p>
	You may also access cached items from the section, as well as use the other cache methods such as <code>increment</code> and <code>decrement</code>:
</p>

<p><strong>Accessing Items In A Cache Section</strong></p>

<pre><code>$anne = Cache::section('people')-&gt;get('Anne');
</code></pre>

<p>Then you may flush all items in the section:</p>

<pre><code>Cache::section('people')-&gt;flush();
</code></pre>

<p><a name="database-cache"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.cache.database_cache') }}</h2>

<p>
	When using the <code>database</code> cache driver, you will need to setup a table to contain the cache items. Below is an example <code>Schema</code> declaration for the table:
</p>

<pre><code>Schema::create('cache', function($table)
{
    $table-&gt;string('key')-&gt;unique();
    $table-&gt;text('value');
    $table-&gt;integer('expiration');
});
</code></pre>
@stop;
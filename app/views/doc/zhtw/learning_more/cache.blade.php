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
    Laravel 為不同的快取系統提供一個統一的 API，快取的設置在 <code>app/config/cache.php</code> 檔案中，在這個檔案，你可以指定你的應用程式，預設要使用哪一種快取驅動程式，Laravel 也支援一些常見的快取應用，像 <a href="http://memcached.org" target="_blank">Memcached</a> 及 <a href="http://redis.io" target="_blank">Redis</a>。
</p>

<p>
    快取設定檔案也包含其他的設定項目，這些項目說明是寫在快取設定檔中，所以要確定讀過這些項目的說明再行設定，Laravel 預設使用 <code>file</code> 的快取驅動程式，將快取資料序列化的存在檔案系統內，對於較大的應用程式，建議你使用記憶體式的快取系統，像是 Memcached 或 APC。
</p>

<p><a name="cache-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.cache.cache_usage') }}</h2>

<p><strong>儲存資料至快取</strong></p>

<pre><code>Cache::put('key', 'value', $minutes);
</code></pre>

<p><strong>如果快取中無此資料，則儲存資料至快取</strong></p>

<pre><code>Cache::add('key', 'value', $minutes);
</code></pre>

<p><strong>檢查是否有此快取資料</strong></p>

<pre><code>if (Cache::has('key'))
{
    //
}
</code></pre>

<p><strong>從快取中讀取資料</strong></p>

<pre><code>$value = Cache::get('key');
</code></pre>

<p><strong>從快取中讀取資料，若無資料回傳預設值</strong></p>

<pre><code>$value = Cache::get('key', 'default');

$value = Cache::get('key', function() { return 'default'; });
</code></pre>

<p><strong>儲存一份永久的資料至快取</strong></p>

<pre><code>Cache::forever('key', 'value');
</code></pre>

<p>
    有時你會想要從快取中讀取資料，但如果在快取沒有此份資料時，儲存此資料的預設值至快取，你可以使用 <code>Cache::remember</code> 方法去完成這件事:
</p>

<pre><code>$value = Cache::remember('users', $minutes, function()
{
    return DB::table('users')-&gt;get();
});
</code></pre>

<p>
    你也可以合併 <code>remember</code> 及 <code>forever</code> 這兩種方法:
</p>

<pre><code>$value = Cache::rememberForever('users', function()
{
    return DB::table('users')-&gt;get();
});
</code></pre>

<p>
    注意到，所有儲存到快取的資料都是序列式的，所以你可以自由的儲存所有類型的資料至快取。
</p>

<p><strong>從快取中移除資料</strong></p>

<pre><code>Cache::forget('key');
</code></pre>

<p><a name="increments-and-decrements"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.cache.increments_and_decrements') }}</h2>

<p>
    在所有驅動程式中，除了 <code>file</code> 及 <code>database</code> 這兩種驅動程式外，都支援 <code>increment</code> 及 <code>decrement</code> 這兩種操作:
</p>

<p><strong>遞增資料值</strong></p>

<pre><code>Cache::increment('key');

Cache::increment('key', $amount);
</code></pre>

<p><strong>遞減資料值</strong></p>

<pre><code>Cache::decrement('key');

Cache::decrement('key', $amount);
</code></pre>

<p><a name="cache-sections"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.cache.cache_sections') }}</h2>

<blockquote>
  <p><strong>注意:</strong> 當使用 <code>file</code> 及 <code>database</code> 這兩種驅動程式時，快取不支援區段功能 (Cache sections)。
</blockquote>

<p>
    快取區段 (Cache sections) 允許你在快取中群組化相關的資料，及清除整個區段的資料，可以使用 <code>section</code> 方法去存取一個快取區段。:
</p>

<p><strong>存取一個快取區段</strong></p>

<pre><code>Cache::section('people')-&gt;put('John', $john);

Cache::section('people')-&gt;put('Anne', $anne);
</code></pre>

<p>
    你也可以使用 <code>increment</code> 及 <code>decrement</code> 的方法，去存取快取區段的資料:
</p>

<p><strong>存取一個快取區段的資料</strong></p>

<pre><code>$anne = Cache::section('people')-&gt;get('Anne');
</code></pre>

<p>
    你可以清除整個快取區段的資料:
</p>

<pre><code>Cache::section('people')-&gt;flush();
</code></pre>

<p><a name="database-cache"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.cache.database_cache') }}</h2>

<p>
    當你使用 <code>database</code> 的快取驅動程式，你將要需要設定一個包含快取資料結構的資料表，下列是一個快取資料表範例的 <code>Schema</code> 定義:
</p>

<pre><code>Schema::create('cache', function($table)
{
    $table-&gt;string('key')-&gt;unique();
    $table-&gt;text('value');
    $table-&gt;integer('expiration');
});
</code></pre>
@stop;
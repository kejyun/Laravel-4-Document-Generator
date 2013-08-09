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

<p>
    <a href="http://redis.io" target="_blank">Redis</a> 是一個開放原始碼，一個進階的 key-value 儲存資料庫，他也參考了伺服器的資料資料結構，所以資料可以包含 <a href="http://redis.io/topics/data-types#strings" target="_blank">字串 (strings)</a> 、 <a href="http://redis.io/topics/data-types#hashes" target="_blank">hashes</a> 、 <a href="http://redis.io/topics/data-types#lists" target="_blank">清單 (lists)</a> 、 <a href="http://redis.io/topics/data-types#sets" target="_blank">集合 (sets)</a> 及 <a href="http://redis.io/topics/data-types#sorted-sets" target="_blank">有順序的集合 (sorted sets)</a>。
</p>

<blockquote>
  <p><strong>注意:</strong> 如果你有透過 PECL 安裝 Redis PHP 套件的話，你需要重新命名在 <code>app/config/app.php</code> 檔案中 Redis 使用套件的設定。</p>
</blockquote>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.redis.configuration') }}</h2>

<p>
    你的應用程式 Redis 相關設定將存放在 <strong>app/config/database.php</strong> 檔案中，在這個檔案裡你會看到 <strong>redis</strong> 陣列，陣列內包含 Redis 伺服器的相關設定:
</p>

<pre><code>'redis' =&gt; array(

    'cluster' =&gt; true,

    'default' =&gt; array('host' =&gt; '127.0.0.1', 'port' =&gt; 6379),

),
</code></pre>

<p>
    預設的伺服器設定應該可以滿足你開發上的需求，當然你也可以根據你的開發環境，去修改這些設定，因為只需要給予每個伺服器的  名字，並且指定 host 及 port 即可。
</p>

<p>
    cluster參數是告 ​​訴Laravel中的Redis客戶端對所有的Redis節點執行客戶端側的分片（sharding），這就賦予你將創建一個節點池，並使用大量的RAM的能力。然而，客戶端的分片機制不能夠處理失效切換，因此，這種方式主要用來訪問其它主數據容器中存放的緩存數據。


    <code>cluster</code> 選項會告訴 Laravel Redis 用戶端去執行跨 Redis 節點的 sharding ，允許你建立 Redis 節點池 (Pool) ，並建立一可使用的大量記憶體，然而用戶端 sharding 沒辦法處理錯誤時的切換，所以主要適合快取其他主要的儲存資料。
</p>

<p><a name="usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.redis.usage') }}</h2>

<p>
    可以使用 <code>Redis::connection</code> 方法，去取得 Redis 實例:
</p>

<pre><code>$redis = Redis::connection();
</code></pre>

<p>
    這將會給你一個預設的 Redis 伺服器實例，假如你沒有使用伺服器分群，你可以傳送伺服器名稱至 <code>connection</code> 方法中，去取得定義在你 Redis 設定檔中特定的伺服器:
</p>

<pre><code>$redis = Redis::connection('other');
</code></pre>

<p>
    一旦獲取到Redis類的實例，我們就可以向其發送任何Redis命令了。Laravel使用一些魔術方法向Redis服務器傳送命令：

    只要你獲得 Redis 用戶端的實例後，我們就可以任何 <a href="http://redis.io/commands" target="_blank">Redis 指令</a> 到這個實例了，Laravel使用一些方法傳送指令到 Redis 伺服器:
</p>

<pre><code>$redis-&gt;set('name', 'Taylor');

$name = $redis-&gt;get('name');

$values = $redis-&gt;lrange('names', 5, 10);
</code></pre>

<p>
    注意，向 Redis 指令傳送的參數簡單的將其傳送到方法中，當然你也可以不使用這些方法，你可以使用 <code>command</code> 方法傳送指令到 Redis 伺服器:
</p>

<pre><code>$values = $redis-&gt;command('lrange', array(5, 10));
</code></pre>

<p>
    只要使用 <code>Redis</code> 類別靜態的方法，就可以簡單的執行指令到預設的 Redis 連線實例中:
</p>

<pre><code>Redis::set('name', 'Taylor');

$name = Redis::get('name');

$values = Redis::lrange('names', 5, 10);
</code></pre>

<blockquote>
  <p><strong>注意:</strong> Redis <a href="../../docs/cache">{{ Lang::get('l4doc.layout.docs_menu.cache') }}</a> 及 <a href="../../docs/session">{{ Lang::get('l4doc.layout.docs_menu.session') }}</a> 的驅動是包含在 Laravel 框架中</p>
</blockquote>

<p><a name="pipelining"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.redis.pipelining') }}</h2>

<p>
    當你需要在同一個操作中，傳送多個指令到伺服器中，就需要使用管線 (Pipelining) ，在開始使用 Redis 時，使用 <code>pipeline</code> 指令即可:
</p>

<p><strong>管線 (Piping) 傳送多個指令到 Redis 伺服器</strong></p>

<pre><code>Redis::pipeline(function($pipe)
{
    for ($i = 0; $i &lt; 1000; $i++)
    {
        $pipe-&gt;set("key:$i", $i);
    }
});
</code></pre>
@stop;
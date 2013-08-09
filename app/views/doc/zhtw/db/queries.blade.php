@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.queries') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.db.queries.introduction') }}</a>
    </li>
    <li>
        <a href="#selects">{{ Lang::get('l4doc.docs_title.db.queries.selects') }}</a>
    </li>
    <li>
        <a href="#joins">{{ Lang::get('l4doc.docs_title.db.queries.joins') }}</a>
    </li>
    <li>
        <a href="#advanced-wheres">{{ Lang::get('l4doc.docs_title.db.queries.advanced_wheres') }}</a>
    </li>
    <li>
        <a href="#aggregates">{{ Lang::get('l4doc.docs_title.db.queries.aggregates') }}</a>
    </li>
    <li>
        <a href="#raw-expressions">{{ Lang::get('l4doc.docs_title.db.queries.raw_expressions') }}</a>
    </li>
    <li>
        <a href="#inserts">{{ Lang::get('l4doc.docs_title.db.queries.inserts') }}</a>
    </li>
    <li>
        <a href="#updates">{{ Lang::get('l4doc.docs_title.db.queries.updates') }}</a>
    </li>
    <li>
        <a href="#deletes">{{ Lang::get('l4doc.docs_title.db.queries.deletes') }}</a>
    </li>
    <li>
        <a href="#unions">{{ Lang::get('l4doc.docs_title.db.queries.unions') }}</a>
    </li>
    <li>
        <a href="#caching-queries">{{ Lang::get('l4doc.docs_title.db.queries.caching_queries') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.introduction') }}</h2>

<p>
    資料庫查詢產生器提供一個方便流暢的介面，去建立並執行資料庫的查詢，他可以產生資料庫大部分的查詢語法，並且支援所有 Laravel 支援的資料庫系統。
</p>

<blockquote>
  <p><strong>注意:</strong> Laravel 查詢產生器使用 PDO 參數綁定，保護你的應用程式部會受到 SQL Injection攻擊，所以說在傳遞參數到查詢產生器時，你不需要對字串進行過濾。</p>
</blockquote>

<p><a name="selects"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.selects') }}</h2>

<p><strong>從資料表取得所有資料列</strong></p>

<pre><code>$users = DB::table('users')-&gt;get();

foreach ($users as $user)
{
    var_dump($user-&gt;name);
}
</code></pre>

<p><strong>從資料表取得單一資料列</strong></p>

<pre><code>$user = DB::table('users')-&gt;where('name', 'John')-&gt;first();

var_dump($user-&gt;name);
</code></pre>

<p><strong>從資料表取得單一資料列的資料欄位</strong></p>

<pre><code>$name = DB::table('users')-&gt;where('name', 'John')-&gt;pluck('name');
</code></pre>

<p><strong>取得資料表欄位值的清單</strong></p>

<pre><code>$roles = DB::table('roles')-&gt;lists('title');
</code></pre>

<p>
    這個方法將會回傳欄位 title 值的組合陣列，你也可以自訂回傳的陣列 key 名稱:
</p>

<pre><code>$roles = DB::table('roles')-&gt;lists('title', 'name');
</code></pre>

<p><strong>指定 SELECT 欄位</strong></p>

<pre><code>$users = DB::table('users')-&gt;select('name', 'email')-&gt;get();

$users = DB::table('users')-&gt;distinct()-&gt;get();

$users = DB::table('users')-&gt;select('name as user_name')-&gt;get();
</code></pre>

<p><strong>再以存在的查詢加入 SELECT 的欄位</strong></p>

<pre><code>$query = DB::table('users')-&gt;select('name');

$users = $query-&gt;addSelect('age')-&gt;get();
</code></pre>

<p><strong>使用 WHERE 的語句</strong></p>

<pre><code>$users = DB::table('users')-&gt;where('votes', '&gt;', 100)-&gt;get();
</code></pre>

<p><strong>使用 OR 的語句</strong></p>

<pre><code>$users = DB::table('users')
                    -&gt;where('votes', '&gt;', 100)
                    -&gt;orWhere('name', 'John')
                    -&gt;get();
</code></pre>

<p><strong>使用 WHERE Between 的語句</strong></p>

<pre><code>$users = DB::table('users')
                    -&gt;whereBetween('votes', array(1, 100))-&gt;get();
</code></pre>

<p><strong>使用 WHERE IN 的語句，並指定 IN 陣列值</strong></p>

<pre><code>$users = DB::table('users')
                    -&gt;whereIn('id', array(1, 2, 3))-&gt;get();

$users = DB::table('users')
                    -&gt;whereNotIn('id', array(1, 2, 3))-&gt;get();
</code></pre>

<p><strong>使用 WHERE NULL 的語句，去找到還沒設定值的紀錄</strong></p>

<pre><code>$users = DB::table('users')
                    -&gt;whereNull('updated_at')-&gt;get();
</code></pre>

<p><strong>Order By 、 Group By 及 Having</strong></p>

<pre><code>$users = DB::table('users')
                    -&gt;orderBy('name', 'desc')
                    -&gt;groupBy('count')
                    -&gt;having('count', '&gt;', 100)
                    -&gt;get();
</code></pre>

<p><strong>Offset &amp; Limit</strong></p>

<pre><code>$users = DB::table('users')-&gt;skip(10)-&gt;take(5)-&gt;get();
</code></pre>

<p><a name="joins"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.joins') }}</h2>

<p>
    查詢產生器也可以使用 join 語句，可以看看下列的使用範例:
</p>

<p><strong>基本 Join 語句</strong></p>

<pre><code>DB::table('users')
            -&gt;join('contacts', 'users.id', '=', 'contacts.user_id')
            -&gt;join('orders', 'users.id', '=', 'orders.user_id')
            -&gt;select('users.id', 'contacts.phone', 'orders.price');
</code></pre>

<p>你也可以指定更多進階的 join 條件:</p>

<pre><code>DB::table('users')
        -&gt;join('contacts', function($join)
        {
            $join-&gt;on('users.id', '=', 'contacts.user_id')-&gt;orOn(...);
        })
        -&gt;get();
</code></pre>

<p><a name="advanced-wheres"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.advanced_wheres') }}</h2>

<p>
    有時你或許需要建立更多進階的 WHERE 條件，像是 "WHERE EXISTS" 或者巢狀的參數群組，Laravel 的查詢產生器也可以將這些查詢條件處理得很好:
</p>

<p><strong>參數群組</strong></p>

<pre><code>DB::table('users')
            -&gt;where('name', '=', 'John')
            -&gt;orWhere(function($query)
            {
                $query-&gt;where('votes', '&gt;', 100)
                      -&gt;where('title', '&lt;&gt;', 'Admin');
            })
            -&gt;get();
</code></pre>

<p>上列的查詢會產生下列的 SQL 語法:</p>

<pre><code>select * from users where name = 'John' or (votes &gt; 100 and title &lt;&gt; 'Admin')
</code></pre>

<p><strong>EXISTS 語句</strong></p>

<pre><code>DB::table('users')
            -&gt;whereExists(function($query)
            {
                $query-&gt;select(DB::raw(1))
                      -&gt;from('orders')
                      -&gt;whereRaw('orders.user_id = users.id');
            })
            -&gt;get();
</code></pre>

<p>上列的查詢會產生下列的 SQL 語法:</p>

<pre><code>select * from users
where exists (
    select 1 from orders where orders.user_id = users.id
)
</code></pre>

<p><a name="aggregates"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.aggregates') }}</h2>

<p>
    查詢產生器也提供各個不同的統計方法，像是 <code>count</code> 、 <code>max</code> 、 <code>min</code> 、 <code>avg</code> 及 <code>sum</code>。
</p>

<p><strong>使用統計方法</strong></p>

<pre><code>$users = DB::table('users')-&gt;count();

$price = DB::table('orders')-&gt;max('price');

$price = DB::table('orders')-&gt;min('price');

$price = DB::table('orders')-&gt;avg('price');

$total = DB::table('users')-&gt;sum('votes');
</code></pre>

<p><a name="raw-expressions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.raw_expressions') }}</h2>

<p>
    有時，你可能需要使用原始的查詢表達式，這種表達式需要直接插入最終的sql語句中,所以，請特別注意防範sql注入!使用DB::raw方法實現原始查詢表達式：

    有時你可能需要在查詢中使用原始的 SQL 語句，你可以使用 <code>DB::raw</code> 方法去達到這樣的查詢需求，這個原始 SQL 語句將會被被當作字串連接在產生的 SQL 語法當中，所以必須注意不要讓程式產生 SQL Injecttion 的情況發生:
</p>

<p><strong>Using A Raw Expression</strong></p>

<pre><code>$users = DB::table('users')
                     -&gt;select(DB::raw('count(*) as user_count, status'))
                     -&gt;where('status', '&lt;&gt;', 1)
                     -&gt;groupBy('status')
                     -&gt;get();
</code></pre>

<p><strong>欄位的遞增或遞減值</strong></p>

<pre><code>DB::table('users')-&gt;increment('votes');

DB::table('users')-&gt;decrement('votes');
</code></pre>

<p><a name="inserts"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.inserts') }}</h2>

<p><strong>新增一筆紀錄</strong></p>

<pre><code>DB::table('users')-&gt;insert(
    array('email' =&gt; 'john@example.com', 'votes' =&gt; 0)
);
</code></pre>

<p>
    假如資料表有自動增加的編號欄位，可以使用 <code>insertGetId</code> 方法去新增一筆紀錄，並取得其新增的編號值:
</p>

<p><strong>新增帶有自訂增加編號的紀錄</strong></p>

<pre><code>$id = DB::table('users')-&gt;insertGetId(
    array('email' =&gt; 'john@example.com', 'votes' =&gt; 0)
);
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 當使用 PostgreSQL 資料庫時，insertGetId 會預設將自動增加的欄位名稱命名為 "id"。</p>
</blockquote>

<p><strong>新增多筆記錄</strong></p>

<pre><code>DB::table('users')-&gt;insert(array(
    array('email' =&gt; 'taylor@example.com', 'votes' =&gt; 0),
    array('email' =&gt; 'dayle@example.com', 'votes' =&gt; 0),
));
</code></pre>

<p><a name="updates"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.updates') }}</h2>

<p><strong>更新資料表的紀錄</strong></p>

<pre><code>DB::table('users')
            -&gt;where('id', 1)
            -&gt;update(array('votes' =&gt; 1));
</code></pre>

<p><a name="deletes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.deletes') }}</h2>

<p><strong>刪除紀錄</strong></p>

<pre><code>DB::table('users')-&gt;where('votes', '&lt;', 100)-&gt;delete();
</code></pre>

<p><strong>刪除資料表所有紀錄</strong></p>

<pre><code>DB::table('users')-&gt;delete();
</code></pre>

<p><strong>清空資料表</strong></p>

<pre><code>DB::table('users')-&gt;truncate();
</code></pre>

<p><a name="unions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.unions') }}</h2>

<p>
    查詢產生器也提供快速的方法去 "聯集 ("union")" 兩個查詢結果:
</p>

<p><strong>執行查詢聯集</strong></p>

<pre><code>$first = DB::table('users')-&gt;whereNull('first_name');

$users = DB::table('users')-&gt;whereNull('last_name')-&gt;union($first)-&gt;get();
</code></pre>

<p>
    也可以使用 <code>unionAll</code> 方法，也有一些其他有 <code>union</code> 特徵的方法。
</p>

<p><a name="caching-queries"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.caching_queries') }}</h2>

<p>
    使用 <code>remember</code> 方法時，你可以很容易的將查詢結果記錄到快取中:
</p>

<p><strong>快取查詢結果</strong></p>

<pre><code>$users = DB::table('users')-&gt;remember(10)-&gt;get();
</code></pre>

<p>
    在這個範例，查詢結果將會被快取10分鐘，當結果被快取起來時，這個查詢將不會再去資料庫重新查詢，會直接透過你應用程式設定的快取驅動，載入將快取起來的結果。
</p>
@stop;
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
	Laravel讓連線資料庫及執行查詢時變得相當的簡單，資料庫的相關設定存放在 <code>app/config/db.php</code> 檔案中，在這個檔案你可以定義你所有的資料庫連連線，並指定哪一個連線是預設的資料庫連線，所有支援的資料庫系統都寫在這個檔案中。
</p>

<p>
	Laravel支援四個資料庫系統: MySQL 、 Postgres 、 SQLite 及 SQL Server。
</p>

<p><a name="running-queries"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.database.running_queries') }}</h2>

<p>
	完成資料庫連線的設定後，你就可以使用 <code>DB</code> 類別進行資料庫的查詢了。
</p>

<p><strong>執行 Select 語法</strong></p>

<pre><code>$results = DB::select('select * from users where id = ?', array(1));
</code></pre>

<p><code>select</code> 方法都會回傳一個<code>陣列 (array)</code> 的結果</p>

<p><strong>執行 Insert 語法</strong></p>

<pre><code>DB::insert('insert into users (id, name) values (?, ?)', array(1, 'Dayle'));
</code></pre>

<p><strong>執行 Update 語法</strong></p>

<pre><code>DB::update('update users set votes = 100 where name = ?', array('John'));
</code></pre>

<p><strong>執行 Delete 語法</strong></p>

<pre><code>DB::delete('delete from users');
</code></pre>

<blockquote>
  <p><strong>注意:</strong> <code>update</code> 和 <code>delete</code> 語法將會回傳在這個操作中，共影響了幾筆資料的結果</p>
</blockquote>

<p><strong>執行一般語法</strong></p>

<pre><code>DB::statement('drop table users');
</code></pre>

<p>
	你可以使用 <code>DB::listen</code> 方法，去監聽查詢事件:
</p>

<p><strong>Listening For Query Events</strong></p>

<pre><code>DB::listen(function($sql, $bindings, $time)
{
    //
});
</code></pre>

<p><a name="db-transactions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.database.database_transactions') }}</h2>

<p>
	你可以使用 <code>transaction</code> 方法，去執行一組資料庫交易集合的操作語法:
</p>

<pre><code>DB::transaction(function()
{
    DB::table('users')-&gt;update(array('votes' =&gt; 1));

    DB::table('posts')-&gt;delete();
});
</code></pre>

<p><a name="accessing-connections"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.database.accessing_connections') }}</h2>

<p>
	你可以使用 <code>DB::connection</code> 方法，去使用數個不同的資料庫連線:
</p>

<pre><code>$users = DB::connection('foo')-&gt;select(...);
</code></pre>

<p>
	你也可以使用 PDO 實例去存取資料:
</p>

<pre><code>$pdo = DB::connection()-&gt;getPdo();
</code></pre>

<p>
	有時你可能需要重新連結資料庫:
</p>

<pre><code>DB::reconnect('foo');
</code></pre>

<p><a name="query-logging"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.database.query_logging') }}</h2>

<p>
	預設的情況下， Laravel 會將目前 HTTP 請求中，所執行過的查詢紀錄存放在記憶體中，在一些情況下，像是增加 (Insert) 大量的資料時，這樣可能會造成應用程式使用過多多餘的記憶體資源，所以你可以使用 <code>disableQueryLog</code> 方法去關閉紀錄查詢到記憶體的動作:
</p>

<pre><code>DB::connection()-&gt;disableQueryLog();
</code></pre>
@stop;
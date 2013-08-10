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

<p>
    因為 HTTP 驅動的應用是無狀態的，所以 session 提供了一個方法去儲存使用者跨請求 (across requests) 的資訊，Laravel 提供數種的後端存取方式，並使用乾淨、統一的 API，並支援熱門的後端資訊儲存應用，像是 <a href="http://memcached.org" target="_blank">Memcached</a> 或是 <a href="http://redis.io" target="_blank">Redis</a>。
</p>

<p>
    session 的設定檔是放在 <code>app/config/session.php</code>，請務必檢視一下設定檔中選項前的註解說明，，預設視使用 <code>native</code> 原生的 session 驅動，這個驅動在大多數的應用都可以執行的非常好。
</p>

<p><a name="session-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.session.session_usage') }}</h2>

<p><strong>儲存資料至 Session</strong></p>

<pre><code>Session::put('key', 'value');

Session::put('user', array('name'=>'john' , 'age'=> 28));
</code></pre>

<p><strong>從 Session 取得資料</strong></p>

<pre><code>$value = Session::get('key');
// value

$value = Session::get('user.name');
// john

$value = Session::get('user.age');
// 28
</code></pre>

<p><strong>從 Session 取得資料，若無資料回傳預設值</strong></p>

<pre><code>$value = Session::get('key', 'default');

$value = Session::get('key', function() { return 'default'; });
</code></pre>

<p><strong>判斷資料是否存在 Session 當中</strong></p>

<pre><code>if (Session::has('users'))
{
    //
}
</code></pre>

<p><strong>移除 Session 中的指定資料</strong></p>

<pre><code>Session::forget('key');
</code></pre>

<p><strong>移除 Session 中的所有資料</strong></p>

<pre><code>Session::flush();
</code></pre>

<p><strong>重新產生 Session ID</strong></p>

<pre><code>Session::regenerate();
</code></pre>

<p><a name="flash-data"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.session.flash_data') }}</h2>

<p>
    有時你可能僅想儲存下一次請求所需要的　session，你可以使用　<code>Session::flash</code>　方法去達到這樣的目的:
</p>

<pre><code>Session::flash('key', 'value');
</code></pre>

<p><strong>更新目前閃存資料到下一個請求前</strong></p>

<pre><code>Session::reflash();
</code></pre>

<p><strong>更新目前部分的閃存資料到下一個請求前</strong></p>

<pre><code>Session::keep(array('username', 'email'));
</code></pre>

<p><a name="database-sessions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.session.database_sessions') }}</h2>

<p>
    當使用 <code>database</code> 做為 session 驅動，你會需要設定包含 session 項目的資料表，下列是使用 <code>Schema</code> 去定義 session 項目資料表的例子:
</p>

<pre><code>Schema::create('sessions', function($table)
{
    $table-&gt;string('id')-&gt;unique();
    $table-&gt;text('payload');
    $table-&gt;integer('last_activity');
});
</code></pre>

<p>
    當然你可以使用 <code>session:table</code> 的 Artisan 指令去產生這個 session 資料表!
</p>

<pre><code>php artisan session:table

composer dump-autoload

php artisan migrate
</code></pre>
@stop;
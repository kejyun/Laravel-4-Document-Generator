@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.pagination') }}</h1>

<ul>
    <li>
        <a href="#configuration">{{ Lang::get('l4doc.docs_title.learning_more.pagination.configuration') }}</a>
    </li>
    <li>
        <a href="#usage">{{ Lang::get('l4doc.docs_title.learning_more.pagination.usage') }}</a>
    </li>
    <li>
        <a href="#appending-to-pagination-links">{{ Lang::get('l4doc.docs_title.learning_more.pagination.appending_to_pagination_links') }}</a>
    </li>
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.pagination.configuration') }}</h2>

<p>
    在其它的框架中，實做分頁是令人痛苦的事，Laravel 卻讓分頁變得非常的簡單，在 <code>app/config/view.php</code> 設定檔中只有一個 <code>pagination</code> 選項需要設定，選項必須指定要用哪一種視圖 (view) 來建立分頁連結， Laravel 預設有兩種可以顯示的視圖。
</p>

<p>
    <code>pagination::slider</code> 視圖將會聰明的產生以目前頁數為主的範圍頁數連結，而 <code>pagination::simple</code> 視圖則僅僅是產生 "上一頁" 與 "下一頁" 按鈕，<strong>而兩種視圖都能支援 Twitter Bootstrap 框架</strong>
</p>

<p><a name="usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.pagination.usage') }}</h2>

<p>
    Laravel 有樹種方法去產生分頁項目，簡單的是在 "Query產生器" 或 "Eloquent 模型" 中使用 <code>paginate</code> 方法
</p>

<p><strong>分頁資料庫查詢結果</strong></p>

<pre><code>$users = DB::table('users')-&gt;paginate(15);
</code></pre>

<p>
    你也可以在 <a href="../../docs/eloquent">{{ Lang::get('l4doc.layout.docs_menu.eloquent') }}</a> 模型做分頁查詢:
</p>

<p><strong>分頁 Eloquent 模型查詢結果</strong></p>

<pre><code>$users = User::where('votes', '&gt;', 100)-&gt;paginate(15);
</code></pre>

<p>
    傳送給 <code>paginate</code> 方法的參數是你希望每頁要顯示的項目選項數目，只要你取得查詢結果後，你可以在視圖中顯示，並使用 <code>links</code> 方法去建立分頁連結:
</p>

<pre><code>&lt;div class="container"&gt;
    &lt;?php foreach ($users as $user): ?&gt;
        &lt;?php echo $user-&gt;name; ?&gt;
    &lt;?php endforeach; ?&gt;
&lt;/div&gt;

&lt;?php echo $users-&gt;links(); ?&gt;
</code></pre>

<p>
    這就是所有產生分頁系統的步驟了! 你會注意到我們還沒有告知 Laravel 我們目前的頁面是哪一頁，這個資訊 Laravel 會自動幫你做好。
</p>

<p>
    你也可以透過下列的方法去取得分頁的資訊:
</p>

<ul>
    <li><code>getCurrentPage</code></li>
    <li><code>getLastPage</code></li>
    <li><code>getPerPage</code></li>
    <li><code>getTotal</code></li>
    <li><code>getFrom</code></li>
    <li><code>getTo</code></li>
</ul>

<p>
    有時候你可能會想要自己手動建立分頁，只需要用 <code>Paginator::make</code> 方法即可手動建立分頁。
</p>

<p><strong>Creating A Paginator Manually</strong></p>

<pre><code>$paginator = Paginator::make($items, $totalItems, $perPage);
</code></pre>

<p><a name="appending-to-pagination-links"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.pagination.appending_to_pagination_links') }}</h2>

<p>
    你可以使用 <code>appends</code> 方法加入查詢字串到分頁連結中:
</p>

<pre><code>&lt;?php echo $users-&gt;appends(array('sort' =&gt; 'votes'))-&gt;links(); ?&gt;
</code></pre>

<p>
    這樣會產生像是下列的連結結果:
</p>

<pre><code>http://example.com/something?page=2&amp;sort=votes
</code></pre>
@stop;
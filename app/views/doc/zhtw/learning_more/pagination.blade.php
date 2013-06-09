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
	In other frameworks, pagination can be very painful. Laravel makes it a breeze. There is a single configuration option in the <code>app/config/view.php</code> file. The <code>pagination</code> option specifies which view should be used to create pagination links. By default, Laravel includes two views.
</p>

<p>
	The <code>pagination::slider</code> view will show an intelligent "range" of links based on the current page, while the <code>pagination::simple</code> view will simply show "previous" and "next" buttons. <strong>Both views are compatible with Twitter Bootstrap out of the box.</strong>
</p>

<p><a name="usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.pagination.usage') }}</h2>

<p>
	There are several ways to paginate items. The simplest is by using the <code>paginate</code> method on the query builder or an Eloquent model.
</p>

<p><strong>Paginating Database Results</strong></p>

<pre><code>$users = DB::table('users')-&gt;paginate(15);
</code></pre>

<p>You may also paginate <a href="/docs/eloquent">Eloquent</a> models:</p>

<p><strong>Paginating An Eloquent Model</strong></p>

<pre><code>$users = User::where('votes', '&gt;', 100)-&gt;paginate(15);
</code></pre>

<p>
	The argument passed to the <code>paginate</code> method is the number of items you wish to display per page. Once you have retrieved the results, you may display them on your view, and create the pagination links using the <code>links</code> method:
</p>

<pre><code>&lt;div class="container"&gt;
    &lt;?php foreach ($users as $user): ?&gt;
        &lt;?php echo $user-&gt;name; ?&gt;
    &lt;?php endforeach; ?&gt;
&lt;/div&gt;

&lt;?php echo $users-&gt;links(); ?&gt;
</code></pre>

<p>
	This is all it takes to create a pagination system! Note that we did not have to inform the framework of the current page. Laravel will determine this for you automatically.
</p>

<p>You may also access additional pagination information via the following methods:</p>

<ul>
	<li><code>getCurrentPage</code></li>
	<li><code>getLastPage</code></li>
	<li><code>getPerPage</code></li>
	<li><code>getTotal</code></li>
	<li><code>getFrom</code></li>
	<li><code>getTo</code></li>
</ul>

<p>
	Sometimes you may wish to create a pagination instance manually, passing it an array of items. You may do so using the <code>Paginator::make</code> method:
</p>

<p><strong>Creating A Paginator Manually</strong></p>

<pre><code>$paginator = Paginator::make($items, $totalItems, $perPage);
</code></pre>

<p><a name="appending-to-pagination-links"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.pagination.appending_to_pagination_links') }}</h2>

<p>
	You can add to the query string of pagination links using the <code>appends</code> method on the Paginator:
</p>

<pre><code>&lt;?php echo $users-&gt;appends(array('sort' =&gt; 'votes'))-&gt;links(); ?&gt;
</code></pre>

<p>This will generate URLs that look something like this:</p>

<pre><code>http://example.com/something?page=2&amp;sort=votes
</code></pre>
@stop;
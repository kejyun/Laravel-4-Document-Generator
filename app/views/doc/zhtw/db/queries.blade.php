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
    The database query builder provides a convenient, fluent interface to creating and running database queries. It can be used to perform most database operations in your application, and works on all supported database systems.
</p>

<blockquote>
  <p><strong>Note:</strong> The Laravel query builder uses PDO parameter binding throughout to protect your application against SQL injection attacks. There is no need to clean strings being passed as bindings.</p>
</blockquote>

<p><a name="selects"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.selects') }}</h2>

<p><strong>Retrieving All Rows From A Table</strong></p>

<pre><code>$users = DB::table('users')-&gt;get();

foreach ($users as $user)
{
    var_dump($user-&gt;name);
}
</code></pre>

<p><strong>Retrieving A Single Row From A Table</strong></p>

<pre><code>$user = DB::table('users')-&gt;where('name', 'John')-&gt;first();

var_dump($user-&gt;name);
</code></pre>

<p><strong>Retrieving A Single Column From A Row</strong></p>

<pre><code>$name = DB::table('users')-&gt;where('name', 'John')-&gt;pluck('name');
</code></pre>

<p><strong>Retrieving A List Of Column Values</strong></p>

<pre><code>$roles = DB::table('roles')-&gt;lists('title');
</code></pre>

<p>This method will return an array of role titles. You may also specify a custom key column for the returned array:</p>

<pre><code>$roles = DB::table('roles')-&gt;lists('title', 'name');
</code></pre>

<p><strong>Specifying A Select Clause</strong></p>

<pre><code>$users = DB::table('users')-&gt;select('name', 'email')-&gt;get();

$users = DB::table('users')-&gt;distinct()-&gt;get();

$users = DB::table('users')-&gt;select('name as user_name')-&gt;get();
</code></pre>

<p><strong>Adding A Select Clause To An Existing Query</strong></p>

<pre><code>$query = DB::table('users')-&gt;select('name');

$users = $query-&gt;addSelect('age')-&gt;get();
</code></pre>

<p><strong>Using Where Operators</strong></p>

<pre><code>$users = DB::table('users')-&gt;where('votes', '&gt;', 100)-&gt;get();
</code></pre>

<p><strong>Or Statements</strong></p>

<pre><code>$users = DB::table('users')
                    -&gt;where('votes', '&gt;', 100)
                    -&gt;orWhere('name', 'John')
                    -&gt;get();
</code></pre>

<p><strong>Using Where Between</strong></p>

<pre><code>$users = DB::table('users')
                    -&gt;whereBetween('votes', array(1, 100))-&gt;get();
</code></pre>

<p><strong>Using Where In With An Array</strong></p>

<pre><code>$users = DB::table('users')
                    -&gt;whereIn('id', array(1, 2, 3))-&gt;get();

$users = DB::table('users')
                    -&gt;whereNotIn('id', array(1, 2, 3))-&gt;get();
</code></pre>

<p><strong>Using Where Null To Find Records With Unset Values</strong></p>

<pre><code>$users = DB::table('users')
                    -&gt;whereNull('updated_at')-&gt;get();
</code></pre>

<p><strong>Order By, Group By, And Having</strong></p>

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

<p>The query builder may also be used to write join statements. Take a look at the following examples:</p>

<p><strong>Basic Join Statement</strong></p>

<pre><code>DB::table('users')
            -&gt;join('contacts', 'users.id', '=', 'contacts.user_id')
            -&gt;join('orders', 'users.id', '=', 'orders.user_id')
            -&gt;select('users.id', 'contacts.phone', 'orders.price');
</code></pre>

<p>You may also specify more advanced join clauses:</p>

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
    Sometimes you may need to create more advanced where clauses such as "where exists" or nested parameter groupings. The Laravel query builder can handle these as well:
</p>

<p><strong>Parameter Grouping</strong></p>

<pre><code>DB::table('users')
            -&gt;where('name', '=', 'John')
            -&gt;orWhere(function($query)
            {
                $query-&gt;where('votes', '&gt;', 100)
                      -&gt;where('title', '&lt;&gt;', 'Admin');
            })
            -&gt;get();
</code></pre>

<p>The query above will produce the following SQL:</p>

<pre><code>select * from users where name = 'John' or (votes &gt; 100 and title &lt;&gt; 'Admin')
</code></pre>

<p><strong>Exists Statements</strong></p>

<pre><code>DB::table('users')
            -&gt;whereExists(function($query)
            {
                $query-&gt;select(DB::raw(1))
                      -&gt;from('orders')
                      -&gt;whereRaw('orders.user_id = users.id');
            })
            -&gt;get();
</code></pre>

<p>The query above will produce the following SQL:</p>

<pre><code>select * from users
where exists (
    select 1 from orders where orders.user_id = users.id
)
</code></pre>

<p><a name="aggregates"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.aggregates') }}</h2>

<p>
    The query builder also provides a variety of aggregate methods, such as <code>count</code>, <code>max</code>, <code>min</code>, <code>avg</code>, and <code>sum</code>.
</p>

<p><strong>Using Aggregate Methods</strong></p>

<pre><code>$users = DB::table('users')-&gt;count();

$price = DB::table('orders')-&gt;max('price');

$price = DB::table('orders')-&gt;min('price');

$price = DB::table('orders')-&gt;avg('price');

$total = DB::table('users')-&gt;sum('votes');
</code></pre>

<p><a name="raw-expressions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.raw_expressions') }}</h2>

<p>
    Sometimes you may need to use a raw expression in a query. These expressions will be injected into the query as strings, so be careful not to create any SQL injection points! To create a raw expression, you may use the <code>DB::raw</code> method:
</p>

<p><strong>Using A Raw Expression</strong></p>

<pre><code>$users = DB::table('users')
                     -&gt;select(DB::raw('count(*) as user_count, status'))
                     -&gt;where('status', '&lt;&gt;', 1)
                     -&gt;groupBy('status')
                     -&gt;get();
</code></pre>

<p><strong>Incrementing or decrementing a value of a column</strong></p>

<pre><code>DB::table('users')-&gt;increment('votes');

DB::table('users')-&gt;decrement('votes');
</code></pre>

<p><a name="inserts"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.inserts') }}</h2>

<p><strong>Inserting Records Into A Table</strong></p>

<pre><code>DB::table('users')-&gt;insert(
    array('email' =&gt; 'john@example.com', 'votes' =&gt; 0)
);
</code></pre>

<p>If the table has an auto-incrementing id, use <code>insertGetId</code> to insert a record and retrieve the id:</p>

<p><strong>Inserting Records Into A Table With An Auto-Incrementing ID</strong></p>

<pre><code>$id = DB::table('users')-&gt;insertGetId(
    array('email' =&gt; 'john@example.com', 'votes' =&gt; 0)
);
</code></pre>

<blockquote>
  <p><strong>Note:</strong> When using PostgreSQL the insertGetId method expects the auto-incrementing column to be named "id".</p>
</blockquote>

<p><strong>Inserting Multiple Records Into A Table</strong></p>

<pre><code>DB::table('users')-&gt;insert(array(
    array('email' =&gt; 'taylor@example.com', 'votes' =&gt; 0),
    array('email' =&gt; 'dayle@example.com', 'votes' =&gt; 0),
));
</code></pre>

<p><a name="updates"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.updates') }}</h2>

<p><strong>Updating Records In A Table</strong></p>

<pre><code>DB::table('users')
            -&gt;where('id', 1)
            -&gt;update(array('votes' =&gt; 1));
</code></pre>

<p><a name="deletes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.deletes') }}</h2>

<p><strong>Deleting Records In A Table</strong></p>

<pre><code>DB::table('users')-&gt;where('votes', '&lt;', 100)-&gt;delete();
</code></pre>

<p><strong>Deleting All Records From A Table</strong></p>

<pre><code>DB::table('users')-&gt;delete();
</code></pre>

<p><strong>Truncating A Table</strong></p>

<pre><code>DB::table('users')-&gt;truncate();
</code></pre>

<p><a name="unions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.unions') }}</h2>

<p>The query builder also provides a quick way to "union" two queries together:</p>

<p><strong>Performing A Query Union</strong></p>

<pre><code>$first = DB::table('users')-&gt;whereNull('first_name');

$users = DB::table('users')-&gt;whereNull('last_name')-&gt;union($first)-&gt;get();
</code></pre>

<p>The <code>unionAll</code> method is also available, and has the same method signature as <code>union</code>.</p>

<p><a name="caching-queries"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.queries.caching_queries') }}</h2>

<p>You may easily cache the results of a query using the <code>remember</code> method:</p>

<p><strong>Caching A Query Result</strong></p>

<pre><code>$users = DB::table('users')-&gt;remember(10)-&gt;get();
</code></pre>

<p>
    In this example, the results of the query will be cached for ten minutes. While the results are cached, the query will not be run against the database, and the results will be loaded from the default cache driver specified for your application.
</p>
@stop;
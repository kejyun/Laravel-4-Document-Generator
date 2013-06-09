@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.schema') }}</h1>

<ul>
  <li>
    <a href="#introduction">{{ Lang::get('l4doc.docs_title.db.schema.introduction') }}</a>
  </li>
  <li>
    <a href="#creating-and-dropping-tables">{{ Lang::get('l4doc.docs_title.db.schema.creating_and_dropping_tables') }}</a>
  </li>
  <li>
    <a href="#adding-columns">{{ Lang::get('l4doc.docs_title.db.schema.adding_columns') }}</a>
  </li>
  <li>
    <a href="#renaming-columns">{{ Lang::get('l4doc.docs_title.db.schema.renaming_columns') }}</a>
  </li>
  <li>
    <a href="#dropping-columns">{{ Lang::get('l4doc.docs_title.db.schema.dropping_columns') }}</a>
  </li>
  <li>
    <a href="#checking-existence">{{ Lang::get('l4doc.docs_title.db.schema.checking_existence') }}</a>
  </li>
  <li>
    <a href="#adding-indexes">{{ Lang::get('l4doc.docs_title.db.schema.adding_indexes') }}</a>
  </li>
  <li>
    <a href="#foreign-keys">{{ Lang::get('l4doc.docs_title.db.schema.foreign_keys') }}</a>
  </li>
  <li>
    <a href="#dropping-indexes">{{ Lang::get('l4doc.docs_title.db.schema.dropping_indexes') }}</a>
  </li>
  <li>
    <a href="#storage-engines">{{ Lang::get('l4doc.docs_title.db.schema.storage_engines') }}</a>
  </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.introduction') }}</h2>

<p>
  The Laravel <code>Schema</code> class provides a database agnostic way of manipulating tables. It works well with all of the databases supported by Laravel, and has a unified API across all of these systems.
</p>

<p><a name="creating-and-dropping-tables"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.creating_and_dropping_tables') }}</h2>

<p>To create a new database table, the <code>Schema::create</code> method is used:</p>

<pre><code>Schema::create('users', function($table)
{
    $table-&gt;increments('id');
});
</code></pre>

<p>
  The first argument passed to the <code>create</code> method is the name of the table, and the second is a <code>Closure</code> which will receive a <code>Blueprint</code> object which may be used to define the new table.
</p>

<p>To rename an existing database table, the <code>rename</code> method may be used:</p>

<pre><code>Schema::rename($from, $to);
</code></pre>

<p>
  To specify which connection the schema operation should take place on, use the <code>Schema::connection</code> method:
</p>

<pre><code>Schema::connection('foo')-&gt;create('users', function($table)
{
    $table-&gt;increments('id'):
});
</code></pre>

<p>To drop a table, you may use the <code>Schema::drop</code> method:</p>

<pre><code>Schema::drop('users');

Schema::dropIfExists('users');
</code></pre>

<p><a name="adding-columns"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.adding_columns') }}</h2>

<p>To update an existing table, we will use the <code>Schema::table</code> method:</p>

<pre><code>Schema::table('users', function($table)
{
    $table-&gt;string('email');
});
</code></pre>

<p>The table builder contains a variety of column types that you may use when building your tables:</p>

<table>
  <thead>
    <tr>
      <th>Command</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>$table-&gt;increments('id');</code></td>
      <td>Incrementing ID to the table (primary key).</td>
    </tr>
    <tr>
      <td><code>$table-&gt;string('email');</code></td>
      <td>VARCHAR equivalent column</td>
    </tr>
    <tr>
      <td><code>$table-&gt;string('name', 100);</code></td>
      <td>VARCHAR equivalent with a length</td>
    </tr>
    <tr>
      <td><code>$table-&gt;integer('votes');</code></td>
      <td>INTEGER equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;bigInteger('votes');</code></td>
      <td>BIGINT equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;smallInteger('votes');</code></td>
      <td>SMALLINT equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;float('amount');</code></td>
      <td>FLOAT equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;decimal('amount', 5, 2);</code></td>
      <td>DECIMAL equivalent with a precision and scale</td>
    </tr>
    <tr>
      <td><code>$table-&gt;boolean('confirmed');</code></td>
      <td>BOOLEAN equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;date('created_at');</code></td>
      <td>DATE equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;dateTime('created_at');</code></td>
      <td>DATETIME equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;time('sunrise');</code></td>
      <td>TIME equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;timestamp('added_on');</code></td>
      <td>TIMESTAMP equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;timestamps();</code></td>
      <td>Adds <strong>created&#95;at</strong> and <strong>updated&#95;at</strong> columns</td>
    </tr>
    <tr>
      <td><code>$table-&gt;softDeletes();</code></td>
      <td>Adds <strong>deleted&#95;at</strong> column for soft deletes</td>
    </tr>
    <tr>
      <td><code>$table-&gt;text('description');</code></td>
      <td>TEXT equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;binary('data');</code></td>
      <td>BLOB equivalent to the table</td>
    </tr>
    <tr>
      <td><code>$table-&gt;enum('choices', array('foo', 'bar'));</code></td>
      <td>ENUM equivalent to the table</td>
    </tr>
    <tr>
      <td><code>-&gt;nullable()</code></td>
      <td>Designate that the column allows NULL values</td>
    </tr>
    <tr>
      <td><code>-&gt;default($value)</code></td>
      <td>Declare a default value for a column</td>
    </tr>
    <tr>
      <td><code>-&gt;unsigned()</code></td>
      <td>Set INTEGER to UNSIGNED</td>
    </tr>
  </tbody>
</table>

<p>
  If you are using the MySQL database, you may use the <code>after</code> method to specify the order of columns:
</p>

<p><strong>Using After On MySQL</strong></p>

<pre><code>$table-&gt;string('name')-&gt;after('email');
</code></pre>

<p><a name="renaming-columns"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.renaming_columns') }}</h2>

<p>To rename a column, you may use the <code>renameColumn</code> method on the Schema builder:</p>

<p><strong>Renaming A Column</strong></p>

<pre><code>Schema::table('users', function($table)
{
    $table-&gt;renameColumn('from', 'to');
});
</code></pre>

<blockquote>
  <p><strong>Note:</strong> Renaming <code>enum</code> column types is not supported.</p>
</blockquote>

<p><a name="dropping-columns"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.dropping_columns') }}</h2>

<p><strong>Dropping A Column From A Database Table</strong></p>

<pre><code>Schema::table('users', function($table)
{
    $table-&gt;dropColumn('votes');
});
</code></pre>

<p><strong>Dropping Multiple Columns From A Database Table</strong></p>

<pre><code>Schema::table('users', function($table)
{
    $table-&gt;dropColumn('votes', 'avatar', 'location');
});
</code></pre>

<p><a name="checking-existence"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.checking_existence') }}</h2>

<p>
  You may easily check for the existence of a table or column using the <code>hasTable</code> and <code>hasColumn</code> methods:
</p>

<p><strong>Checking For Existence Of Table</strong></p>

<pre><code>if (Schema::hasTable('users'))
{
    //
}
</code></pre>

<p><strong>Checking For Existence Of Columns</strong></p>

<pre><code>if (Schema::hasColumn('users', 'email'))
{
    //
}
</code></pre>

<p><a name="adding-indexes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.adding_indexes') }}</h2>

<p>
  The schema builder supports several types of indexes. There are two ways to add them. First, you may fluently define them on a column definition, or you may add them separately:
</p>

<p><strong>Fluently Creating A Column And Index</strong></p>

<pre><code>$table-&gt;string('email')-&gt;unique();
</code></pre>

<p>Or, you may choose to add the indexes on separate lines. Below is a list of all available index types:</p>

<table>
  <thead>
    <tr>
      <th>Command</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>$table-&gt;primary('id');</code></td>
      <td>Adding a primary key</td>
    </tr>
    <tr>
      <td><code>$table-&gt;primary(array('first', 'last'));</code></td>
      <td>Adding composite keys</td>
    </tr>
    <tr>
      <td><code>$table-&gt;unique('email');</code></td>
      <td>Adding a unique index</td>
    </tr>
    <tr>
      <td><code>$table-&gt;index('state');</code></td>
      <td>Adding a basic index</td>
    </tr>
  </tbody>
</table>

<p><a name="foreign-keys"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.foreign_keys') }}</h2>

<p>Laravel also provides support for adding foreign key constraints to your tables:</p>

<p><strong>Adding A Foreign Key To A Table</strong></p>

<pre><code>$table-&gt;foreign('user_id')-&gt;references('id')-&gt;on('users');
</code></pre>

<p>
  In this example, we are stating that the <code>user_id</code> column references the <code>id</code> column on the <code>users</code> table.
</p>

<p>You may also specify options for the "on delete" and "on update" actions of the constraint:</p>

<pre><code>$table-&gt;foreign('user_id')
      -&gt;references('id')-&gt;on('users')
      -&gt;onDelete('cascade');
</code></pre>

<p>
  To drop a foreign key, you may use the <code>dropForeign</code> method. A similar naming convention is used for foreign keys as is used for other indexes:
</p>

<pre><code>$table-&gt;dropForeign('posts_user_id_foreign');
</code></pre>

<blockquote>
  <p><strong>Note:</strong> When creating a foreign key that references an incrementing integer, remember to always make the foreign key column <code>unsigned</code>.</p>
</blockquote>

<p><a name="dropping-indexes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.dropping_indexes') }}</h2>

<p>
  To drop an index you must specify the index's name. Laravel assigns a reasonable name to the indexes by default. Simply concatenate the table name, the names of the column in the index, and the index type. Here are some examples:
</p>

<table>
<thead>
<tr>
  <th>Command</th>
  <th>Description</th>
</tr>
</thead>
<tbody>
<tr>
  <td><code>$table-&gt;dropPrimary('users_id_primary');</code></td>
  <td>Dropping a primary key from the "users" table</td>
</tr>
<tr>
  <td><code>$table-&gt;dropUnique('users_email_unique');</code></td>
  <td>Dropping a unique index from the "users" table</td>
</tr>
<tr>
  <td><code>$table-&gt;dropIndex('geo_state_index');</code></td>
  <td>Dropping a basic index from the "geo" table</td>
</tr>
</tbody>
</table>

<p><a name="storage-engines"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.storage_engines') }}</h2>

<p>To set the storage engine for a table, set the <code>engine</code> property on the schema builder:</p>

<pre><code>Schema::create('users', function($table)
{
    $table-&gt;engine = 'InnoDB';

    $table-&gt;string('email');
});
</code></pre>
@stop;
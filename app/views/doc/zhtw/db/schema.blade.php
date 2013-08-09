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
  Laravel <code>Schema</code> 類別提供一個與資料庫語法不相關的方法，讓你可以透過語意對資料表進行操作及異動，在 Laravel 支援的資料庫，都可以用此統一的API去對不同的資料庫進行管理。
</p>

<p><a name="creating-and-dropping-tables"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.creating_and_dropping_tables') }}</h2>

<p>
  使用 <code>Schema::create</code> 方法，去建立新的資料表:
</p>

<pre><code>Schema::create('users', function($table)
{
    $table-&gt;increments('id');
});
</code></pre>

<p>
  <code>create</code> 方法的第一個參數是資料表的名稱，第二個 <code>閉合(Closure)</code> 函式會收到 <code>Blueprint</code> 物件，這個物件可以讓你用來定義新的資料表的屬性。
</p>

<p>
  使用 <code>Schema::rename</code> 方法可以去重新命名已存在的資料表:
</p>

<pre><code>Schema::rename($from, $to);
</code></pre>

<p>
  在 schema 的操作中，可以使用 <code>Schema::connection</code> 方法去指定你想要使用的資料庫連線:
</p>

<pre><code>Schema::connection('foo')-&gt;create('users', function($table)
{
    $table-&gt;increments('id'):
});
</code></pre>

<p>
  使用 <code>Schema::drop</code> 方法，可以移除資料表:
</p>

<pre><code>Schema::drop('users');

Schema::dropIfExists('users');
</code></pre>

<p><a name="adding-columns"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.adding_columns') }}</h2>

<p>
  使用 <code>Schema::table</code> 方法，可以更新已存在資料表的屬性:
</p>

<pre><code>Schema::table('users', function($table)
{
    $table-&gt;string('email');
});
</code></pre>

<p>
  在你使用資料表產生器建立資料表屬性時，可以使用各種不同的欄位類型:
</p>

<table>
  <thead>
    <tr>
      <th>指令</th>
      <th>描述</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>$table-&gt;increments('id');</code></td>
      <td>建立自動增加 (Incrementing) 的編號的欄位到資料表 (primary key).</td>
    </tr>
    <tr>
      <td><code>$table-&gt;string('email');</code></td>
      <td>建立長度為 255 的 VARCHAR 欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;string('name', 100);</code></td>
      <td>建立指定長度的 VARCHAR 欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;integer('votes');</code></td>
      <td>建立 INTEGER 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;bigInteger('votes');</code></td>
      <td>建立 BIGINT 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;smallInteger('votes');</code></td>
      <td>建立 SMALLINT 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;float('amount');</code></td>
      <td>建立 FLOAT 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;decimal('amount', 5, 2);</code></td>
      <td>建立有效位數為5 (precision)，小數位數為2 (scale) 的 DECIMAL 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;boolean('confirmed');</code></td>
      <td>建立 BOOLEAN 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;date('created_at');</code></td>
      <td>建立 DATE 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;dateTime('created_at');</code></td>
      <td>建立 DATETIME 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;time('sunrise');</code></td>
      <td>建立 TIME 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;timestamp('added_on');</code></td>
      <td>建立 TIMESTAMP 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;timestamps();</code></td>
      <td>加入 <strong>created&#95;at</strong> 及 <strong>updated&#95;at</strong> 欄位，屬性為 DATETIME</td>
    </tr>
    <tr>
      <td><code>$table-&gt;softDeletes();</code></td>
      <td>加入 <strong>deleted&#95;at</strong> 欄位給微刪除用 (soft deletes)</td>
    </tr>
    <tr>
      <td><code>$table-&gt;text('description');</code></td>
      <td>建立 TEXT 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;binary('data');</code></td>
      <td>建立 BLOB 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>$table-&gt;enum('choices', array('foo', 'bar'));</code></td>
      <td>建立 ENUM 屬性的欄位</td>
    </tr>
    <tr>
      <td><code>-&gt;nullable()</code></td>
      <td>指定欄位可以使用 null 值</td>
    </tr>
    <tr>
      <td><code>-&gt;default($value)</code></td>
      <td>定義欄位預設值</td>
    </tr>
    <tr>
      <td><code>-&gt;unsigned()</code></td>
      <td>設定整數 (INTEGER) 為非負整數</td>
    </tr>
  </tbody>
</table>

<p>
  如果你使用 MySQL 資料庫，你可以使用 <code>after</code> 方法去指定欄位的順序:
</p>

<p><strong>在 MySQL 使用 After 方法</strong></p>

<pre><code>$table-&gt;string('name')-&gt;after('email');
</code></pre>

<p><a name="renaming-columns"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.renaming_columns') }}</h2>

<p>
  使用 <code>renameColumn</code> 方法，可以重新命名欄位名稱:
</p>

<p><strong>重新命名欄位名稱</strong></p>

<pre><code>Schema::table('users', function($table)
{
    $table-&gt;renameColumn('from', 'to');
});
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 尚未支援重新命名 <code>enum</code> 欄位類型的名稱</p>
</blockquote>

<p><a name="dropping-columns"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.dropping_columns') }}</h2>

<p><strong>從資料表移除單個欄位</strong></p>

<pre><code>Schema::table('users', function($table)
{
    $table-&gt;dropColumn('votes');
});
</code></pre>

<p><strong>從資料表移除多個欄位</strong></p>

<pre><code>Schema::table('users', function($table)
{
    $table-&gt;dropColumn('votes', 'avatar', 'location');
});
</code></pre>

<p><a name="checking-existence"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.checking_existence') }}</h2>

<p>
  你可以使用 <code>hasTable</code> 及 <code>hasColumn</code> 方法，很容易的分別檢查資料表或欄位是否存在:
</p>

<p><strong>檢查資料表是否存在</strong></p>

<pre><code>if (Schema::hasTable('users'))
{
    //
}
</code></pre>

<p><strong>檢查欄位是否存在</strong></p>

<pre><code>if (Schema::hasColumn('users', 'email'))
{
    //
}
</code></pre>

<p><a name="adding-indexes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.adding_indexes') }}</h2>

<p>
  schema 產生器支援數種不同類型的索引，這裡可以使用兩種方法去加入索引，首先你可以在欄位定義後面去加入索引，或者分別去加入欄位及索引:
</p>

<p><strong>欄位定義後面加入索引</strong></p>

<pre><code>$table-&gt;string('email')-&gt;unique();
</code></pre>

<p>
  或者在不同行分別加入欄位及索引，以下是所有可用的索引類型清單:
</p>

<table>
  <thead>
    <tr>
      <th>指令</th>
      <th>描述</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>$table-&gt;primary('id');</code></td>
      <td>加入主鍵 (primary key)</td>
    </tr>
    <tr>
      <td><code>$table-&gt;primary(array('first', 'last'));</code></td>
      <td>加入組合鍵</td>
    </tr>
    <tr>
      <td><code>$table-&gt;unique('email');</code></td>
      <td>加入唯一值索引 (unique)</td>
    </tr>
    <tr>
      <td><code>$table-&gt;index('state');</code></td>
      <td>加入基本的索引 (index)</td>
    </tr>
  </tbody>
</table>

<p><a name="foreign-keys"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.foreign_keys') }}</h2>

<p>
  Laravel 也支援加入外來鍵限制的功能到你的資料表:
</p>

<p><strong>加入外來見到資料表</strong></p>

<pre><code>$table-&gt;foreign('user_id')-&gt;references('id')-&gt;on('users');
</code></pre>

<p>
  在這個範例，我們將指定 <code>user_id</code> 欄位狀態，去參考 <code>users</code> 資料表的 <code>id</code> 欄位。
</p>

<p>
  我們也可以指定在 "資料刪除時 (on delete)" 及 "資料更新時 (on update)" 關聯限制的操作:
</p>

<pre><code>$table-&gt;foreign('user_id')
      -&gt;references('id')-&gt;on('users')
      -&gt;onDelete('cascade');
</code></pre>

<p>
  使用 <code>dropForeign</code> 方法，可移除外來鍵，這是方法命名是相似於移除索引的方法名稱 <code>dropIndex</code>:
</p>

<pre><code>$table-&gt;dropForeign('posts_user_id_foreign');
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 當建立一個外來鍵參照到自動增加整數的欄位時，記得要指定外來鍵欄位屬性為非負整數的 <code>unsigned</code></p>
</blockquote>

<p><a name="dropping-indexes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.dropping_indexes') }}</h2>

<p>
  為了移除索引，你必須指定索引的名稱，Laravel 預設使用合乎邏輯的索引名稱，簡單的連接 "資料表名稱" 、 "索引欄位名稱" 以及 "索引類型" 即可，以下是一些相關的範例:
</p>

<table>
<thead>
<tr>
  <th>指令</th>
  <th>描述</th>
</tr>
</thead>
<tbody>
<tr>
  <td><code>$table-&gt;dropPrimary('users_id_primary');</code></td>
  <td>從 "users" 資料表移除主鍵 (primary key)</td>
</tr>
<tr>
  <td><code>$table-&gt;dropUnique('users_email_unique');</code></td>
  <td>從 "users" 資料表移除唯一鍵 (unique)</td>
</tr>
<tr>
  <td><code>$table-&gt;dropIndex('geo_state_index');</code></td>
  <td>從 "geo" 資料表移除基本的索引 (index)</td>
</tr>
</tbody>
</table>

<p><a name="storage-engines"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.schema.storage_engines') }}</h2>

<p>
  在 schema 產生器中，可以使用  <code>engine</code> 屬性，去設定資料表的儲存引擎:
</p>

<pre><code>Schema::create('users', function($table)
{
    $table-&gt;engine = 'InnoDB';

    $table-&gt;string('email');
});
</code></pre>
@stop;
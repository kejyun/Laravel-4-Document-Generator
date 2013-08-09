@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.migrations') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.db.migrations.introduction') }}</a>
    </li>
    <li>
        <a href="#creating-migrations">{{ Lang::get('l4doc.docs_title.db.migrations.creating_migrations') }}</a>
    </li>
    <li>
        <a href="#running-migrations">{{ Lang::get('l4doc.docs_title.db.migrations.running_migrations') }}</a>
    </li>
    <li>
        <a href="#rolling-back-migrations">{{ Lang::get('l4doc.docs_title.db.migrations.rolling_back_migrations') }}</a>
    </li>
    <li>
        <a href="#database-seeding">{{ Lang::get('l4doc.docs_title.db.migrations.database_seeding') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.migrations.introduction') }}</h2>

<p>
    Migration 是資料庫的版本控制系統，可以讓你們團隊去修改資料庫的結構，並保持彼此的資料庫結構都在最新狀態， Migration 搭配 <a href="../../docs/schema">{{ Lang::get('l4doc.layout.docs_menu.schema') }}</a> 方便的管理你應用程式資料庫的結構。
</p>

<p><a name="creating-migrations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.migrations.creating_migrations') }}</h2>

<p>
    你可以在 <a href="../../docs/artisan">Artisan CLI</a> 中使用 <code>migrate:make</code> 去建立一個新的 Migration:
</p>

<p><strong>建立新的 Migration</strong></p>

<pre><code>php artisan migrate:make create_users_table
</code></pre>

<p>
    產生的 Migration 檔案將會被放在 <code>app/database/migrations</code> 資料夾當中，檔名中會包含時間戳記，讓 Laravel 可以知道這些 Migration 執行的順序。
</p>

<p>
    在建立 Migration 時你也可以使用 <code>--path</code> 選項去指定 Migration 產生的路徑，這個路徑是相對於你安裝 Laravel 的根目錄:
</p>

<pre><code>php artisan migrate:make foo --path=app/migrations
</code></pre>

<p>
    <code>--table</code> 跟 <code>--create</code> 選項可以用來指定自動產生的 Migration 檔案中，要使用什麼樣的資料表名稱，以及告訴 Migration 要做建立資料表的動作:
</p>

<pre><code>php artisan migrate:make create_users_table --table=users --create
</code></pre>

<p><a name="running-migrations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.migrations.running_migrations') }}</h2>

<p><strong>執行所有尚未執行的 Migration</strong></p>

<pre><code>php artisan migrate
</code></pre>

<p><strong>執行指定路徑中，所有中尚未執行的 Migration</strong></p>

<pre><code>php artisan migrate --path=app/foo/migrations
</code></pre>

<p><strong>執行指定套件中，所有尚未執行的 Migration</strong></p>

<pre><code>php artisan migrate --package=vendor/package
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 如果你在執行 Migration 時收到 "class not found" 的錯誤訊息，可以試著執行 <code>composer update</code> 指令去更新套件。</p>
</blockquote>

<p><a name="rolling-back-migrations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.migrations.rolling_back_migrations') }}</h2>

<p><strong>復原最後一筆 migration 紀錄</strong></p>

<pre><code>php artisan migrate:rollback
</code></pre>

<p><strong>重設所有的 migration 紀錄</strong></p>

<pre><code>php artisan migrate:reset
</code></pre>

<p><strong>重設所有的 migration，並重新執行所有的 migration</strong></p>

<pre><code>php artisan migrate:refresh

php artisan migrate:refresh --seed
</code></pre>

<p><a name="database-seeding"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.migrations.database_seeding') }}</h2>

<p>
    Laravel還包括一個簡單的方法你的數據庫的測試數據，使用種子類種子。所有種子類存儲在應用程序/數據庫/種子。種子類可能有任何你希望的名字，但默認情況下應該遵循一些明智的慣例，如UserTableSeeder等，為您定義一個DatabaseSeeder類。從這個類，你可以使用呼叫的方法來運行其他種子類，允許你控制播種順序。

    Laravel 亦提供簡單的 seed 類別方法，去產生資料庫的測試資料，所有的 seed 類別存放在 <code>app/database/seeds</code> 目錄中， seed 類別名稱可以隨意的命名，但必須遵循一些規則，像是 <code>UserTableSeeder</code> ，預設情況下會為你定義 <code>DatabaseSeeder</code> 類別，從這個類別你可以使用 <code>call</code> 方法去執行你的測試資料種子的類別方法，讓你可以控制測試資料的順序。
</p>

<p><strong>資料庫 Seed 類別範例</strong></p>

<pre><code>class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this-&gt;call('UserTableSeeder');

        $this-&gt;command-&gt;info('User table seeded!');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')-&gt;delete();

        User::create(array('email' =&gt; 'foo@bar.com'));
    }

}
</code></pre>

<p>
    你可以在 <a href="../../docs/artisan">Artisan CLI</a> 使用 <code>db:seed</code> 去執行產生你 Seed 的測試資料:
</p>

<pre><code>php artisan db:seed
</code></pre>

<p>
    你也可以使用 <code>migrate:refresh</code> 指令去產生你 Seed 的測試資料，這個指令會回復並重新執行所有的 Migration:
</p>

<pre><code>php artisan migrate:refresh --seed
</code></pre>
@stop;
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
    Migrations are a type of version control for your database. They allow a team to modify the database schema and stay up to date on the current schema state. Migrations are typically paired with the <a href="/docs/schema">Schema Builder</a> to easily manage your application's scheme.
</p>

<p><a name="creating-migrations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.migrations.creating_migrations') }}</h2>

<p>To create a migration, you may use the <code>migrate:make</code> command on the Artisan CLI:</p>

<p><strong>Creating A Migration</strong></p>

<pre><code>php artisan migrate:make create_users_table
</code></pre>

<p>
    The migration will be placed in your <code>app/database/migrations</code> folder, and will contain a timestamp which allows the framework to determine the order of the migrations.
</p>

<p>
    You may also specify a <code>--path</code> option when creating the migration. The path should be relative to the root directory of your installation:
</p>

<pre><code>php artisan migrate:make foo --path=app/migrations
</code></pre>

<p>
    The <code>--table</code> and <code>--create</code> options may also be used to indicate the name of the table, and whether the migration will be creating a new table:
</p>

<pre><code>php artisan migrate:make create_users_table --table=users --create
</code></pre>

<p><a name="running-migrations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.migrations.running_migrations') }}</h2>

<p><strong>Running All Outstanding Migrations</strong></p>

<pre><code>php artisan migrate
</code></pre>

<p><strong>Running All Outstanding Migrations For A Path</strong></p>

<pre><code>php artisan migrate --path=app/foo/migrations
</code></pre>

<p><strong>Running All Outstanding Migrations For A Package</strong></p>

<pre><code>php artisan migrate --package=vendor/package
</code></pre>

<blockquote>
  <p><strong>Note:</strong> If you receive a "class not found" error when running migrations, try running the <code>composer update</code> command.</p>
</blockquote>

<p><a name="rolling-back-migrations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.migrations.rolling_back_migrations') }}</h2>

<p><strong>Rollback The Last Migration Operation</strong></p>

<pre><code>php artisan migrate:rollback
</code></pre>

<p><strong>Rollback all migrations</strong></p>

<pre><code>php artisan migrate:reset
</code></pre>

<p><strong>Rollback all migrations and run them all again</strong></p>

<pre><code>php artisan migrate:refresh

php artisan migrate:refresh --seed
</code></pre>

<p><a name="database-seeding"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.migrations.database_seeding') }}</h2>

<p>
    Laravel also includes a simple way to seed your database with test data using seed classes. All seed classes are stored in <code>app/database/seeds</code>. Seed classes may have any name you wish, but probably should follow some sensible convention, such as <code>UserTableSeeder</code>, etc. By default, a <code>DatabaseSeeder</code> class is defined for you. From this class, you may use the <code>call</code> method to run other seed classes, allowing you to control the seeding order.
</p>

<p><strong>Example Database Seed Class</strong></p>

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

<p>To seed your database, you may use the <code>db:seed</code> command on the Artisan CLI:</p>

<pre><code>php artisan db:seed
</code></pre>

<p>
    You may also seed your database using the <code>migrate:refresh</code> command, which will also rollback and re-run all of your migrations:
</p>

<pre><code>php artisan migrate:refresh --seed
</code></pre>
@stop;
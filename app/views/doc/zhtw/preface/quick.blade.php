@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.quick') }}</h1>

<ul>
    <li>
        <a href="#installation">{{ Lang::get('l4doc.docs_title.preface.quick.installation') }}</a>
    </li>
    <li>
        <a href="#routing">{{ Lang::get('l4doc.docs_title.preface.quick.routing') }}</a>
    </li>
    <li>
        <a href="#creating-a-view">{{ Lang::get('l4doc.docs_title.preface.quick.creating_a_view') }}</a>
    </li>
    <li>
        <a href="#creating-a-migration">{{ Lang::get('l4doc.docs_title.preface.quick.creating_a_migration') }}</a>
    </li>
    <li>
        <a href="#eloquent-orm">{{ Lang::get('l4doc.docs_title.preface.quick.eloquent_orm') }}</a>
    </li>
    <li>
        <a href="#displaying-data">{{ Lang::get('l4doc.docs_title.preface.quick.displaying_data') }}</a>
    </li>
</ul>

<p><a name="installation"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.quick.installation') }}</h2>

<p>To install the Laravel framework, you may issue the following command from your terminal:</p>

<pre>
    <code>composer create-project laravel/laravel</code>
</pre>

<p>
    Or, you may also download a copy of the <a href="https://github.com/laravel/laravel/archive/master.zip">repository from Github</a>. Next, after <a href="http://getcomposer.org">installing Composer</a>, run the <code>composer install</code> command in the root of your project directory. This command will download and install the framework's dependencies.
</p>

<p>
    After installing the framework, take a glance around the project to familiarize yourself with the directory structure. The <code>app</code> directory contains folders such as <code>views</code>, <code>controllers</code>, and <code>models</code>. Most of your application's code will reside somewhere in this directory. You may also wish to explore the <code>app/config</code> directory and the configuration options that are available to you.
</p>

<p><a name="routing"></a></p>
<h2>{{ Lang::get('l4doc.docs_title.preface.quick.routing') }}</h2>

<p>
    To get started, let's create our first route. In Laravel, the simplest route is a route to a Closure. Pop open the <code>app/routes.php</code> file and add the following route to the bottom of the file:
</p>

<pre><code>Route::get('users', function()
{
    return 'Users!';
});</code></pre>

<p>
    Now, if you hit the <code>/users</code> route in your web browser, you should see <code>Users!</code> displayed as the response. Great! You've just created your first route.
</p>

<p>
    Routes can also be attached to controller classes. For example:
</p>

<pre><code>Route::get('users', 'UserController@getIndex');</code></pre>

<p>
    This route informs the framework that requests to the <code>/users</code> route should call the <code>getIndex</code> method on the <code>UserController</code> class. For more information on controller routing, check out the <a href="/docs/controllers">controller documentation</a>.
</p>

<p><a name="creating-a-view"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.quick.creating_a_view') }}</h2>

<p>
    Next, we'll create a simple view to display our user data. Views live in the <code>app/views</code> directory and contain the HTML of your application. We're going to place two new views in this directory: <code>docs_title.blade.php</code> and <code>users.blade.php</code>. First, let's create our <code>docs_title.blade.php</code> file:
</p>

<pre><code>&lt;html&gt;
    &lt;body&gt;
        &lt;h1&gt;Laravel Quickstart&lt;/h1&gt;

        (@)yield('content')
    &lt;/body&gt;
&lt;/html&gt;</code></pre>

<p>Next, we'll create our <code>users.blade.php</code> view:</p>

<pre><code>(@)extends('docs_title')

(@)section('content')
    Users!
(@)stop
</code></pre>

<p>
    Some of this syntax probably looks quite strange to you. That's because we're using Laravel's templating system: Blade. Blade is very fast, because it is simply a handful of regular expressions that are run against your templates to compile them to pure PHP. Blade provides powerful functionality like template inheritance, as well as some syntax sugar on typical PHP control structures such as <code>if</code> and <code>for</code>. Check out the <a href="/docs/templates">Blade documentation</a> for more details.
</p>

<p>Now that we have our views, let's return it from our <code>/users</code> route. Instead of returning <code>Users!</code> from the route, return the view instead:</p>

<pre><code>Route::get('users', function()
{
    return View::make('users');
});
</code></pre>

<p>Wonderful! Now you have setup a simple view that extends a docs_title. Next, let's start working on our database layer.</p>

<p><a name="creating-a-migration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.quick.creating_a_migration') }}</h2>

<p>
    To create a table to hold our data, we'll use the Laravel migration system. Migrations let you expressively define modifications to your database, and easily share them with the rest of your team.
</p>

<p>
    First, let's configure a database connection. You may configure all of your database connections from the <code>app/config/database.php</code> file. By default, Laravel is configured to use SQLite, and an SQLite database is included in the <code>app/database</code> directory. If you wish, you may change the <code>driver</code> option to <code>mysql</code> and configure the <code>mysql</code> connection credentials within the database configuration file.
</p>

<p>
    Next, to create the migration, we'll use the <a href="/docs/artisan">Artisan CLI</a>. From the root of your project, run the following from your terminal:
</p>

<pre><code>php artisan migrate:make create_users_table
</code></pre>

<p>
    Next, find the generated migration file in the <code>app/database/migrations</code> folder. This file contains a class with two methods: <code>up</code> and <code>down</code>. In the <code>up</code> method, you should make the desired changes to your database tables, and in the <code>down</code> method you simply reverse them.
</p>

<p>Let's define a migration that looks like this:</p>

<pre><code>public function up()
{
    Schema::create('users', function($table)
    {
        $table-&gt;increments('id');
        $table-&gt;string('email')-&gt;unique();
        $table-&gt;string('name');
        $table-&gt;timestamps();
    });
}

public function down()
{
    Schema::drop('users');
}
</code></pre>

<p>
    Next, we can run our migrations from our terminal using the <code>migrate</code> command. Simply execute this command from the root of your project:
</p>

<pre><code>php artisan migrate
</code></pre>

<p>
    If you wish to rollback a migration, you may issue the <code>migrate:rollback</code> command. Now that we have a database table, let's start pulling some data!
</p>

<p><a name="eloquent-orm"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.quick.eloquent_orm') }}</h2>

<p>
    Laravel ships with a superb ORM: Eloquent. If you have used the Ruby on Rails framework, you will find Eloquent familiar, as it follows the ActiveRecord ORM style of database interaction.
</p>

<p>
    First, let's define a model. An Eloquent model can be used to query an associated database table, as well as represent a given row within that table. Don't worry, it will all make sense soon! Models are typically stored in the <code>app/models</code> directory. Let's define a <code>User.php</code> model in that directory like so:
</p>

<pre><code>class User extends Eloquent {}
</code></pre>

<p>Note that we do not have to tell Eloquent which table to use. Eloquent has a variety of conventions, one of which is to use the plural form of the model name as the model's database table. Convenient!</p>

<p>Using your preferred database administration tool, insert a few rows into your <code>users</code> table, and we'll use Eloquent to retrieve them and pass them to our view.</p>

<p>Now let's modify our <code>/users</code> route to look like this:</p>

<pre><code>Route::get('users', function()
{
    $users = User::all();

    return View::make('users')-&gt;with('users', $users);
});
</code></pre>

<p>
    Let's walk through this route. First, the <code>all</code> method on the <code>User</code> model will retrieve all of the rows in the <code>users</code> table. Next, we're passing these records to the view via the <code>with</code> method. The <code>with</code> method accepts a key and a value, and is used to make a piece of data available to a view.
</p>

<p>Awesome. Now we're ready to display the users in our view!</p>

<p><a name="displaying-data"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.quick.displaying_data') }}</h2>

<p>Now that we have made the <code>users</code> available to our view. We can display them like so:</p>

<pre><code>(@)extends('docs_title')

(@)section('content')
    (@)foreach($users as $user)
        &lt;p&gt;{ { $user-&gt;name } }&lt;/p&gt;
    (@)endforeach
(@)stop
</code></pre>

<p>
    You may be wondering where to find our <code>echo</code> statements. When using Blade, you may echo data by surrounding it with double curly braces. It's a cinch. Now, you should be able to hit the <code>/users</code> route and see the names of your users displayed in the response.
</p>

<p>
    This is just the beginning. In this tutorial, you've seen the very basics of Laravel, but there are so many more exciting things to learn. Keep reading through the documentation and dig deeper into the powerful features available to you in <a href="/docs/eloquent">Eloquent</a> and <a href="/docs/templates">Blade</a>. Or, maybe you're more interested in <a href="/docs/queues">Queues</a> and <a href="/docs/testing">Unit Testing</a>. Then again, maybe you want to flex your architecture muscles with the <a href="/docs/ioc">IoC Container</a>. The choice is yours!
</p>
@stop;
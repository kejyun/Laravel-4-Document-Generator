@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.eloquent') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.db.eloquent.introduction') }}</a>
    </li>
    <li>
        <a href="#basic-usage">{{ Lang::get('l4doc.docs_title.db.eloquent.basic_usage') }}</a>
    </li>
    <li>
        <a href="#mass-assignment">{{ Lang::get('l4doc.docs_title.db.eloquent.mass_assignment') }}</a>
    </li>
    <li>
        <a href="#insert-update-delete">{{ Lang::get('l4doc.docs_title.db.eloquent.insert_update_delete') }}</a>
    </li>
    <li>
        <a href="#soft-deleting">{{ Lang::get('l4doc.docs_title.db.eloquent.soft_deleting') }}</a>
    </li>
    <li>
        <a href="#timestamps">{{ Lang::get('l4doc.docs_title.db.eloquent.timestamps') }}</a>
    </li>
    <li>
        <a href="#query-scopes">{{ Lang::get('l4doc.docs_title.db.eloquent.query_scopes') }}</a>
    </li>
    <li>
        <a href="#relationships">{{ Lang::get('l4doc.docs_title.db.eloquent.relationships') }}</a>
    </li>
    <li>
        <a href="#querying-relations">{{ Lang::get('l4doc.docs_title.db.eloquent.querying_relations') }}</a>
    </li>
    <li>
        <a href="#eager-loading">{{ Lang::get('l4doc.docs_title.db.eloquent.eager_loading') }}</a>
    </li>
    <li>
        <a href="#inserting-related-models">{{ Lang::get('l4doc.docs_title.db.eloquent.inserting_related_models') }}</a>
    </li>
    <li>
        <a href="#touching-parent-timestamps">{{ Lang::get('l4doc.docs_title.db.eloquent.touching_parent_timestamps') }}</a>
    </li>
    <li>
        <a href="#working-with-pivot-tables">{{ Lang::get('l4doc.docs_title.db.eloquent.working_with_pivot_tables') }}</a>
    </li>
    <li>
        <a href="#collections">{{ Lang::get('l4doc.docs_title.db.eloquent.collections') }}</a>
    </li>
    <li>
        <a href="#accessors-and-mutators">{{ Lang::get('l4doc.docs_title.db.eloquent.accessors_and_mutators') }}</a>
    </li>
    <li>
        <a href="#date-mutators">{{ Lang::get('l4doc.docs_title.db.eloquent.date_mutators') }}</a>
    </li>
    <li>
        <a href="#model-events">{{ Lang::get('l4doc.docs_title.db.eloquent.model_events') }}</a>
    </li>
    <li>
        <a href="#model-observers">{{ Lang::get('l4doc.docs_title.db.eloquent.model_observers') }}</a>
    </li>
    <li>
        <a href="#converting-to-arrays-or-json">{{ Lang::get('l4doc.docs_title.db.eloquent.converting_to_arrays_or_json') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.introduction') }}</h2>

<p>
    The Eloquent ORM included with Laravel provides a beautiful, simple ActiveRecord implementation for working with your database. Each database table has a corresponding "Model" which is used to interact with that table.
</p>

<p>Before getting started, be sure to configure a database connection in <code>app/config/database.php</code>.</p>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.basic_usage') }}</h2>

<p>
    To get started, create an Eloquent model. Models typically live in the <code>app/models</code> directory, but you are free to place them anywhere that can be auto-loaded according to your <code>composer.json</code> file.
</p>

<p><strong>Defining An Eloquent Model</strong></p>

<pre><code>class User extends Eloquent {}
</code></pre>

<p>
    Note that we did not tell Eloquent which table to use for our <code>User</code> model. The lower-case, plural name of the class will be used as the table name unless another name is explicitly specified. So, in this case, Eloquent will assume the <code>User</code> model stores records in the <code>users</code> table. You may specify a custom table by defining a <code>table</code> property on your model:
</p>

<pre><code>class User extends Eloquent {

    protected $table = 'my_users';

}
</code></pre>

<blockquote>
  <p><strong>Note:</strong> Eloquent will also assume that each table has a primary key column named <code>id</code>. You may define a <code>primaryKey</code> property to override this convention. Likewise, you may define a <code>connection</code> property to override the name of the database connection that should be used when utilizing the model.</p>
</blockquote>

<p>
    Once a model is defined, you are ready to start retrieving and creating records in your table. Note that you will need to place <code>updated_at</code> and <code>created_at</code> columns on your table by default. If you do not wish to have these columns automatically maintained, set the <code>$timestamps</code> property on your model to <code>false</code>.
</p>

<p><strong>Retrieving All Models</strong></p>

<pre><code>$users = User::all();
</code></pre>

<p><strong>Retrieving A Record By Primary Key</strong></p>

<pre><code>$user = User::find(1);

var_dump($user-&gt;name);
</code></pre>

<blockquote>
  <p><strong>Note:</strong> All methods available on the <a href="/docs/queries">query builder</a> are also available when querying Eloquent models.</p>
</blockquote>

<p><strong>Retrieving A Model By Primary Key Or Throw An Exception</strong></p>

<p>
    Sometimes you may wish to throw an exception if a model is not found, allowing you to catch the exceptions using an <code>App::error</code> handler and display a 404 page.
</p>

<pre><code>$model = User::findOrFail(1);

$model = User::where('votes', '&gt;', 100)-&gt;firstOrFail();
</code></pre>

<p>To register the error handler, listen for the <code>ModelNotFoundException</code></p>

<pre><code>use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return Response::make('Not Found', 404);
});
</code></pre>

<p><strong>Querying Using Eloquent Models</strong></p>

<pre><code>$users = User::where('votes', '&gt;', 100)-&gt;take(10)-&gt;get();

foreach ($users as $user)
{
    var_dump($user-&gt;name);
}
</code></pre>

<p>Of course, you may also use the query builder aggregate functions.</p>

<p><strong>Eloquent Aggregates</strong></p>

<pre><code>$count = User::where('votes', '&gt;', 100)-&gt;count();
</code></pre>

<p><a name="mass-assignment"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.mass_assignment') }}</h2>

<p>
    When creating a new model, you pass an array of attributes to the model constructor. These attributes are then assigned to the model via mass-assignment. This is convenient; however, can be a <strong>serious</strong> security concern when blindly passing user input into a model. If user input is blindly passed into a model, the user is free to modify <strong>any</strong> and <strong>all</strong> of the model's attributes. For this reason, all Eloquent models protect against mass-assignment by default.
</p>

<p>To get started, set the <code>fillable</code> or <code>guarded</code> properties on your model.</p>

<p>
    The <code>fillable</code> property specifies which attributes should be mass-assignable. This can be set at the class or instance level.
</p>

<p><strong>Defining Fillable Attributes On A Model</strong></p>

<pre><code>class User extends Eloquent {

    protected $fillable = array('first_name', 'last_name', 'email');

}
</code></pre>

<p>
    In this example, only the three listed attributes will be mass-assignable.
</p>

<p>
    The inverse of <code>fillable</code> is <code>guarded</code>, and serves as a "black-list" instead of a "white-list":
</p>

<p><strong>Defining Guarded Attributes On A Model</strong></p>

<pre><code>class User extends Eloquent {

    protected $guarded = array('id', 'password');

}
</code></pre>

<p>
    In the example above, the <code>id</code> and <code>password</code> attributes may <strong>not</strong> be mass assigned. All other attributes will be mass assignable. You may also block <strong>all</strong> attributes from mass assignment using the guard method:
</p>

<p><strong>Blocking All Attributes From Mass Assignment</strong></p>

<pre><code>protected $guarded = array('*');
</code></pre>

<p><a name="insert-update-delete"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.insert_update_delete') }}</h2>

<p>
    To create a new record in the database from a model, simply create a new model instance and call the <code>save</code> method.
</p>

<p><strong>Saving A New Model</strong></p>

<pre><code>$user = new User;

$user-&gt;name = 'John';

$user-&gt;save();
</code></pre>

<blockquote>
  <p><strong>Note:</strong> Typically, your Eloquent models will have auto-incrementing keys. However, if you wish to specify your own keys, set the <code>incrementing</code> property on your model to <code>false</code>.</p>
</blockquote>

<p>
    You may also use the <code>create</code> method to save a new model in a single line. The inserted model instance will be returned to you from the method. However, before doing so, you will need to specify either a <code>fillable</code> or <code>guarded</code> attribute on the model, as all Eloquent models protect against mass-assignment.
</p>

<p><strong>Setting The Guarded Attributes On The Model</strong></p>

<pre><code>class User extends Eloquent {

    protected $guarded = array('id', 'account_id');

}
</code></pre>

<p><strong>Using The Model Create Method</strong></p>

<pre><code>$user = User::create(array('name' =&gt; 'John'));
</code></pre>

<p>To update a model, you may retrieve it, change an attribute, and use the <code>save</code> method:</p>

<p><strong>Updating A Retrieved Model</strong></p>

<pre><code>$user = User::find(1);

$user-&gt;email = 'john@foo.com';

$user-&gt;save();
</code></pre>

<p>
    Sometimes you may wish to save not only a model, but also all of its relationships. To do so, you may use the <code>push</code> method:
</p>

<p><strong>Saving A Model And Relationships</strong></p>

<pre><code>$user-&gt;push();
</code></pre>

<p>You may also run updates as queries against a set of models:</p>

<pre><code>$affectedRows = User::where('votes', '&gt;', 100)-&gt;update(array('status' =&gt; 2));
</code></pre>

<p>To delete a model, simply call the <code>delete</code> method on the instance:</p>

<p><strong>Deleting An Existing Model</strong></p>

<pre><code>$user = User::find(1);

$user-&gt;delete();
</code></pre>

<p><strong>Deleting An Existing Model By Key</strong></p>

<pre><code>User::destroy(1);

User::destroy(1, 2, 3);
</code></pre>

<p>Of course, you may also run a delete query on a set of models:</p>

<pre><code>$affectedRows = User::where('votes', '&gt;', 100)-&gt;delete();
</code></pre>

<p>If you wish to simply update the timestamps on a model, you may use the <code>touch</code> method:</p>

<p><strong>Updating Only The Model's Timestamps</strong></p>

<pre><code>$user-&gt;touch();
</code></pre>

<p><a name="soft-deleting"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.soft_deleting') }}</h2>

<p>
    When soft deleting a model, it is not actually removed from your database. Instead, a <code>deleted_at</code> timestamp is set on the record. To enable soft deletes for a model, specify the <code>softDelete</code> property on the model:
</p>

<pre><code>class User extends Eloquent {

    protected $softDelete = true;

}
</code></pre>

<p>
    To add a <code>deleted_at</code> column to your table, you may use the <code>softDeletes</code> method from a migration:
</p>

<pre><code>$table-&gt;softDeletes();
</code></pre>

<p>
    Now, when you call the <code>delete</code> method on the model, the <code>deleted_at</code> column will be set to the current timestamp. When querying a model that uses soft deletes, the "deleted" models will not be included in query results. To force soft deleted models to appear in a result set, use the <code>withTrashed</code> method on the query:
</p>

<p><strong>Forcing Soft Deleted Models Into Results</strong></p>

<pre><code>$users = User::withTrashed()-&gt;where('account_id', 1)-&gt;get();
</code></pre>

<p>If you wish to <strong>only</strong> receive soft deleted models in your results, you may use the <code>onlyTrashed</code> method:</p>

<pre><code>$users = User::onlyTrashed()-&gt;where('account_id', 1)-&gt;get();
</code></pre>

<p>To restore a soft deleted model into an active state, use the <code>restore</code> method:</p>

<pre><code>$user-&gt;restore();
</code></pre>

<p>You may also use the <code>restore</code> method on a query:</p>

<pre><code>User::withTrashed()-&gt;where('account_id', 1)-&gt;restore();
</code></pre>

<p>The <code>restore</code> method may also be used on relationships:</p>

<pre><code>$user-&gt;posts()-&gt;restore();
</code></pre>

<p>If you wish to truly remove a model from the database, you may use the <code>forceDelete</code> method:</p>

<pre><code>$user-&gt;forceDelete();
</code></pre>

<p>The <code>forceDelete</code> method also works on relationships:</p>

<pre><code>$user-&gt;posts()-&gt;forceDelete();
</code></pre>

<p>To determine if a given model instance has been soft deleted, you may use the <code>trashed</code> method:</p>

<pre><code>if ($user-&gt;trashed())
{
    //
}
</code></pre>

<p><a name="timestamps"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.timestamps') }}</h2>

<p>
    By default, Eloquent will maintain the <code>created_at</code> and <code>updated_at</code> columns on your database table automatically. Simply add these <code>datetime</code> columns to your table and Eloquent will take care of the rest. If you do not wish for Eloquent to maintain these columns, add the following property to your model:
</p>

<p><strong>Disabling Auto Timestamps</strong></p>

<pre><code>class User extends Eloquent {

    protected $table = 'users';

    public $timestamps = false;

}
</code></pre>

<p>
    If you wish to customize the format of your timestamps, you may override the <code>freshTimestamp</code> method in your model:
</p>

<p><strong>Providing A Custom Timestamp Format</strong></p>

<pre><code>class User extends Eloquent {

    public function freshTimestamp()
    {
        return time();
    }

}
</code></pre>

<p><a name="query-scopes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.query_scopes') }}</h2>

<p>
    Scopes allow you to easily re-use query logic in your models. To define a scope, simply prefix a model method with <code>scope</code>:
</p>

<p><strong>Defining A Query Scope</strong></p>

<pre><code>class User extends Eloquent {

    public function scopePopular($query)
    {
        return $query-&gt;where('votes', '&gt;', 100);
    }

}
</code></pre>

<p><strong>Utilizing A Query Scope</strong></p>

<pre><code>$users = User::popular()-&gt;orderBy('created_at')-&gt;get();
</code></pre>

<p><a name="relationships"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.relationships') }}</h2>

<p>
    Of course, your database tables are probably related to one another. For example, a blog post may have many comments, or an order could be related to the user who placed it. Eloquent makes managing and working with these relationships easy. Laravel supports four types of relationships:
</p>

<ul>
<li><a href="#one-to-one">One To One</a></li>
<li><a href="#one-to-many">One To Many</a></li>
<li><a href="#many-to-many">Many To Many</a></li>
<li><a href="#polymorphic-relations">Polymorphic Relations</a></li>
</ul>

<p><a name="one-to-one"></a></p>

<h3>One To One</h3>

<p>
    A one-to-one relationship is a very basic relation. For example, a <code>User</code> model might have one <code>Phone</code>. We can define this relation in Eloquent:
</p>

<p><strong>Defining A One To One Relation</strong></p>

<pre><code>class User extends Eloquent {

    public function phone()
    {
        return $this-&gt;hasOne('Phone');
    }

}
</code></pre>

<p>
    The first argument passed to the <code>hasOne</code> method is the name of the related model. Once the relationship is defined, we may retrieve it using Eloquent's <a href="#dynamic-properties">dynamic properties</a>:
</p>

<pre><code>$phone = User::find(1)-&gt;phone;
</code></pre>

<p>The SQL performed by this statement will be as follows:</p>

<pre><code>select * from users where id = 1

select * from phones where user_id = 1
</code></pre>

<p>
    Take note that Eloquent assumes the foreign key of the relationship based on the model name. In this case, <code>Phone</code> model is assumed to use a <code>user_id</code> foreign key. If you wish to override this convention, you may pass a second argument to the <code>hasOne</code> method:
</p>

<pre><code>return $this-&gt;hasOne('Phone', 'custom_key');
</code></pre>

<p>
    To define the inverse of the relationship on the <code>Phone</code> model, we use the <code>belongsTo</code> method:
</p>

<p><strong>Defining The Inverse Of A Relation</strong></p>

<pre><code>class Phone extends Eloquent {

    public function user()
    {
        return $this-&gt;belongsTo('User');
    }

}
</code></pre>

<p><a name="one-to-many"></a></p>

<h3>One To Many</h3>

<p>
    An example of a one-to-many relation is a blog post that "has many" comments. We can model this relation like so:
</p>

<pre><code>class Post extends Eloquent {

    public function comments()
    {
        return $this-&gt;hasMany('Comment');
    }

}
</code></pre>

<p>Now we can access the post's comments through the <a href="#dynamic-properties">dynamic property</a>:</p>

<pre><code>$comments = Post::find(1)-&gt;comments;
</code></pre>

<p>
    If you need to add further constraints to which comments are retrieved, you may call the <code>comments</code> method and continue chaining conditions:
</p>

<pre><code>$comments = Post::find(1)-&gt;comments()-&gt;where('title', '=', 'foo')-&gt;first();
</code></pre>

<p>
    Again, you may override the conventional foreign key by passing a second argument to the <code>hasMany</code> method:
</p>

<pre><code>return $this-&gt;hasMany('Comment', 'custom_key');
</code></pre>

<p>
    To define the inverse of the relationship on the <code>Comment</code> model, we use the <code>belongsTo</code> method:
</p>

<p><strong>Defining The Inverse Of A Relation</strong></p>

<pre><code>class Comment extends Eloquent {

    public function post()
    {
        return $this-&gt;belongsTo('Post');
    }

}
</code></pre>

<p><a name="many-to-many"></a></p>

<h3>Many To Many</h3>

<p>
    Many-to-many relations are a more complicated relationship type. An example of such a relationship is a user with many roles, where the roles are also shared by other users. For example, many users may have the role of "Admin". Three database tables are needed for this relationship: <code>users</code>, <code>roles</code>, and <code>role_user</code>. The <code>role_user</code> table is derived from the alphabetical order of the related model names, and should have <code>user_id</code> and <code>role_id</code> columns.
</p>

<p>We can define a many-to-many relation using the <code>belongsToMany</code> method:</p>

<pre><code>class User extends Eloquent {

    public function roles()
    {
        return $this-&gt;belongsToMany('Role');
    }

}
</code></pre>

<p>Now, we can retrieve the roles through the <code>User</code> model:</p>

<pre><code>$roles = User::find(1)-&gt;roles;
</code></pre>

<p>
    If you would like to use an unconventional table name for your pivot table, you may pass it as the second argument to the <code>belongsToMany</code> method:
</p>

<pre><code>return $this-&gt;belongsToMany('Role', 'user_roles');
</code></pre>

<p>You may also override the conventional associated keys:</p>

<pre><code>return $this-&gt;belongsToMany('Role', 'user_roles', 'user_id', 'foo_id');
</code></pre>

<p>Of course, you may also define the inverse of the relationship on the <code>Role</code> model:</p>

<pre><code>class Role extends Eloquent {

    public function users()
    {
        return $this-&gt;belongsToMany('User');
    }

}
</code></pre>

<p><a name="polymorphic-relations"></a></p>

<h3>Polymorphic Relations</h3>

<p>
    Polymorphic relations allow a model to belong to more than one other model, on a single association. For example, you might have a photo model that belongs to either a staff model or an order model. We would define this relation like so:
</p>

<pre><code>class Photo extends Eloquent {

    public function imageable()
    {
        return $this-&gt;morphTo();
    }

}

class Staff extends Eloquent {

    public function photos()
    {
        return $this-&gt;morphMany('Photo', 'imageable');
    }

}

class Order extends Eloquent {

    public function photos()
    {
        return $this-&gt;morphMany('Photo', 'imageable');
    }

}
</code></pre>

<p>Now, we can retrieve the photos for either a staff member or an order:</p>

<p><strong>Retrieving A Polymorphic Relation</strong></p>

<pre><code>$staff = Staff::find(1);

foreach ($staff-&gt;photos as $photo)
{
    //
}
</code></pre>

<p>
    However, the true "polymorphic" magic is when you access the staff or order from the <code>Photo</code> model:
</p>

<p><strong>Retrieving The Owner Of A Polymorphic Relation</strong></p>

<pre><code>$photo = Photo::find(1);

$imageable = $photo-&gt;imageable;
</code></pre>

<p>The <code>imageable</code> relation on the <code>Photo</code> model will return either a <code>Staff</code> or <code>Order</code> instance, depending on which type of model owns the photo.</p>

<p>To help understand how this works, let's explore the database structure for a polymorphic relation:</p>

<p><strong>Polymorphic Relation Table Structure</strong></p>

<pre><code>staff
    id - integer
    name - string

orders
    id - integer
    price - integer

photos
    id - integer
    path - string
    imageable_id - integer
    imageable_type - string
</code></pre>

<p>
    The key fields to notice here are the <code>imageable_id</code> and <code>imageable_type</code> on the <code>photos</code> table. The ID will contain the ID value of, in this example, the owning staff or order, while the type will contain the class name of the owning model. This is what allows the ORM to determine which type of owning model to return when accessing the <code>imageable</code> relation.
</p>

<p><a name="querying-relations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.querying_relations') }}</h2>

<p>
    When accessing the records for a model, you may wish to limit your results based on the existence of a relationship. For example, you wish to pull all blog posts that have at least one comment. To do so, you may use the <code>has</code> method:
</p>

<p><strong>Checking Relations When Selecting</strong></p>

<pre><code>$posts = Post::has('comments')-&gt;get();
</code></pre>

<p>You may also specify an operator and a count:</p>

<pre><code>$posts = Post::has('comments', '&gt;=', 3)-&gt;get();
</code></pre>

<p><a name="dynamic-properties"></a></p>

<h3>Dynamic Properties</h3>

<p>
    Eloquent allows you to access your relations via dynamic properties. Eloquent will automatically load the relationship for you, and is even smart enough to know whether to call the <code>get</code> (for one-to-many relationships) or <code>first</code> (for one-to-one relationships) method.  It will then be accessible via a dynamic property by the same name as the relation. For example, with the following model <code>$phone</code>:
</p>

<pre><code>class Phone extends Eloquent {

    public function user()
    {
        return $this-&gt;belongsTo('User');
    }

}

$phone = Phone::find(1);
</code></pre>

<p>Instead of echoing the user's email like this:</p>

<pre><code>echo $phone-&gt;user()-&gt;first()-&gt;email;
</code></pre>

<p>It may be shortened to simply:</p>

<pre><code>echo $phone-&gt;user-&gt;email;
</code></pre>

<p><a name="eager-loading"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.eager_loading') }}</h2>

<p>
    Eager loading exists to alleviate the N + 1 query problem. For example, consider a <code>Book</code> model that is related to <code>Author</code>. The relationship is defined like so:
</p>

<pre><code>class Book extends Eloquent {

    public function author()
    {
        return $this-&gt;belongsTo('Author');
    }

}
</code></pre>

<p>Now, consider the following code:</p>

<pre><code>foreach (Book::all() as $book)
{
    echo $book-&gt;author-&gt;name;
}
</code></pre>

<p>
    This loop will execute 1 query to retrieve all of the books on the table, then another query for each book to retrieve the author. So, if we have 25 books, this loop would run 26 queries.
</p>

<p>
    Thankfully, we can use eager loading to drastically reduce the number of queries. The relationships that should be eager loaded may be specified via the <code>with</code> method:
</p>

<pre><code>foreach (Book::with('author')-&gt;get() as $book)
{
    echo $book-&gt;author-&gt;name;
}
</code></pre>

<p>In the loop above, only two queries will be executed:</p>

<pre><code>select * from books

select * from authors where id in (1, 2, 3, 4, 5, ...)
</code></pre>

<p>Wise use of eager loading can drastically increase the performance of your application.</p>

<p>Of course, you may eager load multiple relationships at one time:</p>

<pre><code>$books = Book::with('author', 'publisher')-&gt;get();
</code></pre>

<p>You may even eager load nested relationships:</p>

<pre><code>$books = Book::with('author.contacts')-&gt;get();
</code></pre>

<p>In the example above, the <code>author</code> relationship will be eager loaded, and the author's <code>contacts</code> relation will also be loaded.</p>

<h3>Eager Load Constraints</h3>

<p>
    Sometimes you may wish to eager load a relationship, but also specify a condition for the eager load. Here's an example:
</p>

<pre><code>$users = User::with(array('posts' =&gt; function($query)
{
    $query-&gt;where('title', 'like', '%first%');
}))-&gt;get();
</code></pre>

<p>
    In this example, we're eager loading the user's posts, but only if the post's title column contains the word "first".
</p>

<h3>Lazy Eager Loading</h3>

<p>
    It is also possible to eagerly load related models directly from an already existing model collection. This may be useful when dynamically deciding whether to load related models or not, or in combination with caching.
</p>

<pre><code>$books = Book::all();

$books-&gt;load('author', 'publisher');
</code></pre>

<p><a name="inserting-related-models"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.inserting_related_models') }}</h2>

<p>
    You will often need to insert new related models. For example, you may wish to insert a new comment for a post. Instead of manually setting the <code>post_id</code> foreign key on the model, you may insert the new comment from its parent <code>Post</code> model directly:
</p>

<p><strong>Attaching A Related Model</strong></p>

<pre><code>$comment = new Comment(array('message' =&gt; 'A new comment.'));

$post = Post::find(1);

$comment = $post-&gt;comments()-&gt;save($comment);
</code></pre>

<p>In this example, the <code>post_id</code> field will automatically be set on the inserted comment.</p>

<h3>Associating Models (Belongs To)</h3>

<p>
    When updating a <code>belongsTo</code> relationship, you may use the <code>associate</code> method. This method will set the foreign key on the child model:
</p>

<pre><code>$account = Account::find(10);

$user-&gt;account()-&gt;associate($account);

$user-&gt;save();
</code></pre>

<h3>Inserting Related Models (Many To Many)</h3>

<p>
    You may also insert related models when working with many-to-many relations. Let's continue using our <code>User</code> and <code>Role</code> models as examples. We can easily attach new roles to a user using the <code>attach</code> method:
</p>

<p><strong>Attaching Many To Many Models</strong></p>

<pre><code>$user = User::find(1);

$user-&gt;roles()-&gt;attach(1);
</code></pre>

<p>You may also pass an array of attributes that should be stored on the pivot table for the relation:</p>

<pre><code>$user-&gt;roles()-&gt;attach(1, array('expires' =&gt; $expires));
</code></pre>

<p>Of course, the opposite of <code>attach</code> is <code>detach</code>:</p>

<pre><code>$user-&gt;roles()-&gt;detach(1);
</code></pre>

<p>
    You may also use the <code>sync</code> method to attach related models. The <code>sync</code> method accepts an array of IDs to place on the pivot table. After this operation is complete, only the IDs in the array will be on the intermediate table for the model:
</p>

<p><strong>Using Sync To Attach Many To Many Models</strong></p>

<pre><code>$user-&gt;roles()-&gt;sync(array(1, 2, 3));
</code></pre>

<p>You may also associate other pivot table values with the given IDs:</p>

<p><strong>Adding Pivot Data When Syncing</strong></p>

<pre><code>$user-&gt;roles()-&gt;sync(array(1 =&gt; array('expires' =&gt; true)));
</code></pre>

<p>
    Sometimes you may wish to create a new related model and attach it in a single command. For this operation, you may use the <code>save</code> method:
</p>

<pre><code>$role = new Role(array('name' =&gt; 'Editor'));

User::find(1)-&gt;roles()-&gt;save($role);
</code></pre>

<p>
    In this example, the new <code>Role</code> model will be saved and attached to the user model. You may also pass an array of attributes to place on the joining table for this operation:
</p>

<pre><code>User::find(1)-&gt;roles()-&gt;save($role, array('expires' =&gt; $expires));
</code></pre>

<p><a name="touching-parent-timestamps"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.touching_parent_timestamps') }}</h2>

<p>
    When a model <code>belongsTo</code> another model, such as a <code>Comment</code> which belongs to a <code>Post</code>, it is often helpful to update the parent's timestamp when the child model is updated. For example, when a <code>Comment</code> model is updated, you may want to automatically touch the <code>updated_at</code> timestamp of the owning <code>Post</code>. Eloquent makes it easy. Just add a <code>touches</code> property containing the names of the relationships to the child model:
</p>

<pre><code>class Comment extends Eloquent {

    protected $touches = array('post');

    public function post()
    {
        return $this-&gt;belongsTo('Post');
    }

}
</code></pre>

<p>
    Now, when you update a <code>Comment</code>, the owning <code>Post</code> will have its <code>updated_at</code> column updated:
</p>

<pre><code>$comment = Comment::find(1);

$comment-&gt;text = 'Edit to this comment!';

$comment-&gt;save();
</code></pre>

<p><a name="working-with-pivot-tables"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.working_with_pivot_tables') }}</h2>

<p>
    As you have already learned, working with many-to-many relations requires the presence of an intermediate table. Eloquent provides some very helpful ways of interacting with this table. For example, let's assume our <code>User</code> object has many <code>Role</code> objects that it is related to. After accessing this relationship, we may access the <code>pivot</code> table on the models:
</p>

<pre><code>$user = User::find(1);

foreach ($user-&gt;roles as $role)
{
    echo $role-&gt;pivot-&gt;created_at;
}
</code></pre>

<p>
    Notice that each <code>Role</code> model we retrieve is automatically assigned a <code>pivot</code> attribute. This attribute contains a model representing the intermediate table, and may be used as any other Eloquent model.
</p>

<p>
    By default, only the keys will be present on the <code>pivot</code> object. If your pivot table contains extra attributes, you must specify them when defining the relationship:
</p>

<pre><code>return $this-&gt;belongsToMany('Role')-&gt;withPivot('foo', 'bar');
</code></pre>

<p>
    Now the <code>foo</code> and <code>bar</code> attributes will be accessible on our <code>pivot</code> object for the <code>Role</code> model.
</p>

<p>
    If you want your pivot table to have automatically maintained <code>created_at</code> and <code>updated_at</code> timestamps, use the <code>withTimestamps</code> method on the relationship definition:
</p>

<pre><code>return $this-&gt;belongsToMany('Role')-&gt;withTimestamps();
</code></pre>

<p>To delete all records on the pivot table for a model, you may use the <code>detach</code> method:</p>

<p><strong>Deleting Records On A Pivot Table</strong></p>

<pre><code>User::find(1)-&gt;roles()-&gt;detach();
</code></pre>

<p>
    Note that this operation does not delete records from the <code>roles</code> table, but only from the pivot table.
</p>

<p><a name="collections"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.collections') }}</h2>

<p>
    All multi-result sets returned by Eloquent either via the <code>get</code> method or a relationship return an Eloquent <code>Collection</code> object. This object implements the <code>IteratorAggregate</code> PHP interface so it can be iterated over like an array. However, this object also has a variety of other helpful methods for working with result sets.
</p>

<p>For example, we may determine if a result set contains a given primary key using the <code>contains</code> method:</p>

<p><strong>Checking If A Collection Contains A Key</strong></p>

<pre><code>$roles = User::find(1)-&gt;roles;

if ($roles-&gt;contains(2))
{
    //
}
</code></pre>

<p>Collections may also be converted to an array or JSON:</p>

<pre><code>$roles = User::find(1)-&gt;roles-&gt;toArray();

$roles = User::find(1)-&gt;roles-&gt;toJson();
</code></pre>

<p>If a collection is cast to a string, it will be returned as JSON:</p>

<pre><code>$roles = (string) User::find(1)-&gt;roles;
</code></pre>

<p>Eloquent collections also contain a few helpful methods for looping and filtering the items they contain:</p>

<p><strong>Iterating &amp; Filtering Collections</strong></p>

<pre><code>$roles = $user-&gt;roles-&gt;each(function($role)
{

});

$roles = $user-&gt;roles-&gt;filter(function($role)
{

});
</code></pre>

<p><strong>Applying A Callback To Each Collection Object</strong></p>

<pre><code>$roles = User::find(1)-&gt;roles;

$roles-&gt;each(function($role)
{
    //  
});
</code></pre>

<p><strong>Sorting A Collection By A Value</strong></p>

<pre><code>$roles = $roles-&gt;sortBy(function($role)
{
    return $role-&gt;created_at;
});
</code></pre>

<p>
    Sometimes, you may wish to return a custom Collection object with your own added methods. You may specify this on your Eloquent model by overriding the <code>newCollection</code> method:
</p>

<p><strong>Returning A Custom Collection Type</strong></p>

<pre><code>class User extends Eloquent {

    public function newCollection(array $models = array())
    {
        return new CustomCollection($models);
    }

}
</code></pre>

<p><a name="accessors-and-mutators"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.accessors_and_mutators') }}</h2>

<p>
    Eloquent provides a convenient way to transform your model attributes when getting or setting them. Simply define a <code>getFooAttribute</code> method on your model to declare an accessor. Keep in mind that the methods should follow camel-casing, even though your database columns are snake-case:
</p>

<p><strong>Defining An Accessor</strong></p>

<pre><code>class User extends Eloquent {

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

}
</code></pre>

<p>
    In the example above, the <code>first_name</code> column has an accessor. Note that the value of the attribute is passed to the accessor.
</p>

<p>Mutators are declared in a similar fashion:</p>

<p><strong>Defining A Mutator</strong></p>

<pre><code>class User extends Eloquent {

    public function setFirstNameAttribute($value)
    {
        $this-&gt;attributes['first_name'] = strtolower($value);
    }

}
</code></pre>

<p><a name="date-mutators"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.date_mutators') }}</h2>

<p>
    By default, Eloquent will convert the <code>created_at</code>, <code>updated_at</code>, and <code>deleted_at</code> columns to instances of <a href="https://github.com/briannesbitt/Carbon">Carbon</a>, which provides an assortment of helpful methods, and extends the native PHP <code>DateTime</code> class.
</p>

<p>
    You may customize which fields are automatically mutated, and even completely disable this mutation, by overriding the <code>getDates</code> method of the model:
</p>

<pre><code>public function getDates()
{
    return array('created_at');
}
</code></pre>

<p>When a column is considered a date, you may set its value to a UNIX timetamp, date string (<code>Y-m-d</code>), date-time string, and of course a <code>DateTime</code> / <code>Carbon</code> instance.</p>

<p>To totally disable date mutations, simply return an empty array from the <code>getDates</code> method:</p>

<pre><code>public function getDates()
{
    return array();
}
</code></pre>

<p><a name="model-events"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.model_events') }}</h2>

<p>
    Eloquent models fire several events, allowing you to hook into various points in the model's lifecycle using the following methods: <code>creating</code>, <code>created</code>, <code>updating</code>, <code>updated</code>, <code>saving</code>, <code>saved</code>, <code>deleting</code>, <code>deleted</code>. If <code>false</code> is returned from the <code>creating</code>, <code>updating</code>, or <code>saving</code> events, the action will be cancelled:
</p>

<p><strong>Cancelling Save Operations Via Events</strong></p>

<pre><code>User::creating(function($user)
{
    if ( ! $user-&gt;isValid()) return false;
});
</code></pre>

<p>Eloquent models also contain a static <code>boot</code> method, which may provide a convenient place to register your event bindings.</p>

<p><strong>Setting A Model Boot Method</strong></p>

<pre><code>class User extends Eloquent {

    public static function boot()
    {
        parent::boot();

        // Setup event bindings...
    }

}
</code></pre>

<p><a name="model-observers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.model_observers') }}</h2>

<p>
    To consolidate the handling of model events, you may register a model observer. An observer class may have methods that correspond to the various model events. For example, <code>creating</code>, <code>updating</code>, <code>saving</code> methods may be on an observer, in addition to any other model event name.
</p>

<p>So, for example, a model observer might look like this:</p>

<pre><code>class UserObserver {

    public function saving($model)
    {
        //
    }

    public function saved($model)
    {
        //
    }

}
</code></pre>

<p>You may register an observer instance using the <code>observe</code> method:</p>

<pre><code>User::observe(new UserObserver);
</code></pre>

<p><a name="converting-to-arrays-or-json"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.converting_to_arrays_or_json') }}</h2>

<p>
    When building JSON APIs, you may often need to convert your models and relationships to arrays or JSON. So, Eloquent includes methods for doing so. To convert a model and its loaded relationship to an array, you may use the <code>toArray</code> method:
</p>

<p><strong>Converting A Model To An Array</strong></p>

<pre><code>$user = User::with('roles')-&gt;first();

return $user-&gt;toArray();
</code></pre>

<p>Note that entire collections of models may also be converted to arrays:</p>

<pre><code>return User::all()-&gt;toArray();
</code></pre>

<p>To convert a model to JSON, you may use the <code>toJson</code> method:</p>

<p><strong>Converting A Model To JSON</strong></p>

<pre><code>return User::find(1)-&gt;toJson();
</code></pre>

<p>
    Note that when a model or collection is cast to a string, it will be converted to JSON, meaning you can return Eloquent objects directly from your application's routes!
</p>

<p><strong>Returning A Model From A Route</strong></p>

<pre><code>Route::get('users', function()
{
    return User::all();
});
</code></pre>

<p>
    Sometimes you may wish to limit the attributes that are included in your model's array or JSON form, such as passwords. To do so, add a <code>hidden</code> property definition to your model:
</p>

<p><strong>Hiding Attributes From Array Or JSON Conversion</strong></p>

<pre><code>class User extends Eloquent {

    protected $hidden = array('password');

}
</code></pre>

<p>Alternatively, you may use the <code>visible</code> property to define a white-list:</p>

<pre><code>protected $visible = array('first_name', 'last_name');
</code></pre>
@stop;
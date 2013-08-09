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
    Eloquent ORM 是 Laravel 提供的一個優雅、簡單的 ActiveRecord 實作資料庫的操作的方法，每個資料表有一個相對應的 "模型 (Model)" ，讓你可以對相對應的資料表進行互動操作。
</p>

<p>
    在開始之前，要先確定你有在 <code>app/config/database.php</code> 檔案中設定好資料庫的連線資訊。
</p>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.basic_usage') }}</h2>

<p>
    在開始要建立 Eloquent 模型時，通常這些模型的檔案都放在 <code>app/models</code> 目錄下，但你也可以放在任何你想放的地方，只要能夠透過 <code>composer.json</code> 檔案中的設定去載入模型即可。
</p>

<p><strong>定義 Eloquent 模型</strong></p>

<pre><code>class User extends Eloquent {}
</code></pre>

<p>
    你會注意到，我們並沒有告訴 Eloquent 我們的 <code>User</code> 模型是要用哪一個資料表去做存取控制，除非你有另外指定要使用的資料表名稱，否則 Eloquent 將會使用類別名稱的"小寫"及"複數"的單字去當作預設的資料表名稱，所以在這個例子中， Eloquent 會假設 <code>User</code> 模型的資料是存放在 <code>users</code> 資料表中，你也可以在你的模型中使用 <code>table</code> 變數去指定你想要的使用的資料表名稱:
</p>

<pre><code>class User extends Eloquent {

    protected $table = 'my_users';

}
</code></pre>

<blockquote>
  <p><strong>注意:</strong> Eloquent 會假設每一個資料表的主鍵 (primary key) 名稱為 <code>id</code> ，你也可以使用 <code>primaryKey</code> 變數去複寫原來的規則，同樣的，你也可以定義 <code>connection</code> 變數去複寫你想要在這個模型中使用的資料庫連線。</p>
</blockquote>

<p>
    只要模型一定義完成，你就可以開始取得或建立資料到你的資料表了，但這裡必須注意到，預設的情況下，你必須在資料表中建立 <code>updated_at</code> 及 <code>created_at</code> 這兩個欄位，用來記錄資料的建立時間及更新時間，如果你不希望模型去幫你自動維護資料建立時間及更新時間，在你的模型中你只要將 <code>$timestamps</code> 變數設定為 <code>false</code> 即可。
</p>

<p><strong>取得所有模型的資料</strong></p>

<pre><code>$users = User::all();
</code></pre>

<p><strong>透過主鍵 (Primary Key) 取得單筆資料</strong></p>

<pre><code>$user = User::find(1);

var_dump($user-&gt;name);
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 所有在 <a href="../../docs/queries">{{ Lang::get('l4doc.layout.docs_menu.queries') }}</a> 的方法，在使用 Eloquent 模型時也可以使用。</p>
</blockquote>

<p><strong>透過主鍵 (Primary Key) 取得單筆資料，或丟出例外狀況</strong></p>

<p>
    假如模型沒有找到指定的資料，有時你可能想要丟出例外狀況，讓你的例外狀況可以讓 <code>App::error</code> 捕捉到，並且呈現 404 頁面給使用者。
</p>

<pre><code>$model = User::findOrFail(1);

$model = User::where('votes', '&gt;', 100)-&gt;firstOrFail();
</code></pre>

<p>
    傾聽 <code>ModelNotFoundException</code> 可以註冊一個模型錯誤處理器
</p>

<pre><code>use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return Response::make('Not Found', 404);
});
</code></pre>

<p><strong>使用 Eloquent 模型進行查詢</strong></p>

<pre><code>$users = User::where('votes', '&gt;', 100)-&gt;take(10)-&gt;get();

foreach ($users as $user)
{
    var_dump($user-&gt;name);
}
</code></pre>

<p>
    當然你也可以使用查詢產生器去整合這些函式。
</p>

<p><strong>Eloquent 整合</strong></p>

<pre><code>$count = User::where('votes', '&gt;', 100)-&gt;count();
</code></pre>

<p><a name="mass-assignment"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.mass_assignment') }}</h2>

<p>
    當建立模型時，你傳遞一個陣列屬性到模型建構子，這些屬性會經由大量指定 (mass-assignment) 的方式去指定到模型中，這樣是相當方便的，但是，當綁定使用者傳入的資料到模型中，也可能是一個 <strong>嚴重</strong> 的安全性問題，假如使用者傳入的資料綁定到模型，使用者就可以任意的修改 <strong>任何 (any)</strong> 和 <strong>所有 (all)</strong> 模型中的屬性，出於這個原因，所有的 Eloquent 模型預設會避免及保護資料不會被大量指定的方式所覆寫。
</p>

<p>
    為了使用大量指定的功能，你必須在你的模型設定 <code>fillable</code> 或 <code>guarded</code> 變數資料。
</p>

<p>
    <code>fillable</code> 變數指定那些欄位可以使用被大量指定功能指定資料，可以設定類別 (class) 或 實例 (instance) 層級的變數。
</p>

<p><strong>定義可大量指定的屬性欄位到模型</strong></p>

<pre><code>class User extends Eloquent {

    protected $fillable = array('first_name', 'last_name', 'email');

}
</code></pre>

<p>
    在這個範例，只有清單中的三個變數屬性資料可以被使用大量指定方式修改
</p>

<p>
    在 <code>fillable</code> 的反義屬性就是 <code>guarded</code>，這屬性可以設定 "黑名單" 而不只是設定 "白名單" :
</p>

<p><strong>定義受保護的屬性欄位到模型</strong></p>

<pre><code>class User extends Eloquent {

    protected $guarded = array('id', 'password');

}
</code></pre>

<p>
    在上述範例 <code>id</code> 及 <code>password</code> 屬性將不會被大量指定方式修改原模型的變數資料，所有除了這兩個變數外的變數，都可以被使用大量指定方式指定去修改資料，你也可以保護 <strong>所有</strong> 的屬性都不會被大量指定的方式修改資料值:
</p>

<p><strong>封鎖所有變數不被大量指定方式修改資料內容</strong></p>

<pre><code>protected $guarded = array('*');
</code></pre>

<p><a name="insert-update-delete"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.insert_update_delete') }}</h2>

<p>
    為了透過模型建立一筆新的資料到資料庫，只需要建立新的模型實例後，並且呼叫 <code>save</code> 方法即可。
</p>

<p><strong>儲存新的模型資料</strong></p>

<pre><code>$user = new User;

$user-&gt;name = 'John';

$user-&gt;save();
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 通常你的 Eloquent 模型都會有一個自動增加的鍵值 (key)，但你如果想要指定你自己的鍵值在模型中有自動增加的屬性，只要將 <code>incrementing</code> 設定為 <code>自動增加 (incrementing)</code> 即可。</p>
</blockquote>

<p>
    你可以使用 <code>create</code> 方法在單一行去儲存資料到模型中，插入 (INSERT) 的模型實例將會被回傳，但是在使用這樣的方式去儲存資料前，你需要在模型中指定 <code>fillable</code> 或 <code>guarded</code> 屬性，這樣 Eloquent 模型會保護你的模型不被大量指定方式所攻擊。
</p>

<p><strong>設定保護 (Guarded) 屬性到模型中</strong></p>

<pre><code>class User extends Eloquent {

    protected $guarded = array('id', 'account_id');

}
</code></pre>

<p><strong>使用模型的新增 (Create) 方法</strong></p>

<pre><code>$user = User::create(array('name' =&gt; 'John'));
</code></pre>

<p>
    為了更新資料，你需要取得資料後，並改變一個你要更新的屬性欄，並使用 <code>save</code> 方法即可更新資料:
</p>

<p><strong>更新一個已取得資料的模型</strong></p>

<pre><code>$user = User::find(1);

$user-&gt;email = 'john@foo.com';

$user-&gt;save();
</code></pre>

<p>
    有時你會須希望不僅儲存模型中的資料，也希望能夠儲存所有關聯的資料，你可以使用 <code>push</code> 的方法，去達到這樣的目的:
</p>

<p><strong>儲存模型資料及關連的資料</strong></p>

<pre><code>$user-&gt;push();
</code></pre>

<p>
    你也可以對一個集合的模型資料進行更新:
</p>

<pre><code>$affectedRows = User::where('votes', '&gt;', 100)-&gt;update(array('status' =&gt; 2));
</code></pre>

<p>
    只需要在模型實例使用 <code>delete</code> 方法，即可刪除模型的資料:
</p>

<p><strong>刪除一存在的模型資料</strong></p>

<pre><code>$user = User::find(1);

$user-&gt;delete();
</code></pre>

<p><strong>透過鍵值刪除一存在的模型資料</strong></p>

<pre><code>User::destroy(1);

User::destroy(1, 2, 3);
</code></pre>

<p>
    單然你也可以對一模型資料集合執行刪除的動作:
</p>

<pre><code>$affectedRows = User::where('votes', '&gt;', 100)-&gt;delete();
</code></pre>

<p>
    如果你只想要更新模型的時間戳記，你可以使用 <code>touch</code> 方法去進行更新:
</p>

<p><strong>僅更新模型的時間戳記</strong></p>

<pre><code>$user-&gt;touch();
</code></pre>

<p><a name="soft-deleting"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.soft_deleting') }}</h2>

<p>
    當微刪除模型資料時，資料不會真的從資料庫中移除，而是會去更新 <code>deleted_at</code> 時間戳記欄位，在模型中設定 <code>softDelete</code> 變數，就可以讓模型開啟微刪除的功能:
</p>

<pre><code>class User extends Eloquent {

    protected $softDelete = true;

}
</code></pre>

<p>
    你可以在 Migration 中使用 <code>softDeletes</code> 方法，在資料表中加入 <code>deleted_at</code> 欄位:
</p>

<pre><code>$table-&gt;softDeletes();
</code></pre>

<p>
    現在當你在模型中呼叫 <code>delete</code> 方法時，資料表中的 <code>deleted_at</code> 欄位值會被設定為現在的時間戳記，當使用微刪除的模型在對資料庫進行查詢撈取資料時，被 "微刪除 (deleted)" 的資料將不會被撈取出來，如果要強制模型去撈取被微刪除的資料，在查詢過程中使用 <code>withTrashed</code> 方法即可:
</p>

<p><strong>強制微刪除的資料也出現在查詢結果中</strong></p>

<pre><code>$users = User::withTrashed()-&gt;where('account_id', 1)-&gt;get();
</code></pre>

<p>
    如果你 <strong>只 (only)</strong> 希望撈取微刪除的資料出來，你可以使用 <code>onlyTrashed</code> 去達成這件事:
</p>

<pre><code>$users = User::onlyTrashed()-&gt;where('account_id', 1)-&gt;get();
</code></pre>

<p>
    使用 <code>restore</code> 方法，可以回復原本被微刪除的資料:
</p>

<pre><code>$user-&gt;restore();
</code></pre>

<p>
    你可以在查詢過程中使用 <code>restore</code> 方法:
</p>

<pre><code>User::withTrashed()-&gt;where('account_id', 1)-&gt;restore();
</code></pre>

<p><code>restore</code> 方法也可以用在關聯的資料上:</p>

<pre><code>$user-&gt;posts()-&gt;restore();
</code></pre>

<p>
    使用 <code>forceDelete</code> 方法，可以真的將資料從資料庫中移除:
</p>

<pre><code>$user-&gt;forceDelete();
</code></pre>

<p><code>forceDelete</code> 方法也可以用在關聯資料上:</p>

<pre><code>$user-&gt;posts()-&gt;forceDelete();
</code></pre>

<p>
    使用 <code>trashed</code> 方法，可以知道模型中是否有被微刪除的資料:
</p>

<pre><code>if ($user-&gt;trashed())
{
    //
}
</code></pre>

<p><a name="timestamps"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.timestamps') }}</h2>

<p>
    預設的情況下， Eloquent 會自動在你的資料表加入並維護 <code>created_at</code> 及 <code>updated_at</code> 這兩個欄位資料，欄位會被設定為 <code>datetime</code> 的資料型態，這兩個欄位的資料異動都交給 Eloquent 去處理，若你不希望 Eloquent 去幫你維護這兩個欄位的資料，在你的模型中將參數 <code>$timestamps</code> 設定為 <code>false</code> 即可，如下範例所示::
</p>

<p><strong>關閉自動維護時間戳記功能</strong></p>

<pre><code>class User extends Eloquent {

    protected $table = 'users';

    public $timestamps = false;

}
</code></pre>

<p>
    如果你希望自訂時間戳記格式，你可以在模型中使用 <code>freshTimestamp</code> 方法去複寫原始設定的格式:
</p>

<p><strong>提供自訂時間戳記格式</strong></p>

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
    Scopes 允許你容易地在模型中去重複使用查詢邏輯，只要使用 <code>scope</code> 當作模型中方法的前綴字，即可定義 Scope:
</p>

<p><strong>定義查詢 Scope</strong></p>

<pre><code>class User extends Eloquent {

    public function scopePopular($query)
    {
        return $query-&gt;where('votes', '&gt;', 100);
    }

}
</code></pre>

<p><strong>使用查詢 Scope</strong></p>

<pre><code>$users = User::popular()-&gt;orderBy('created_at')-&gt;get();
</code></pre>

<p><a name="relationships"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.relationships') }}</h2>

<p>
    當然，你的資料表總會關連到其他資料表的資料，舉例來說，一篇部落格文章會有數個文章評論，或者會有不同的使用者資料放到不同的排序資料中， Eloquent 可以讓你容易的管理這些關聯關係， Laravel 支援四種不同型態的關聯:
</p>

<ul>
<li><a href="#one-to-one">一對一 (One To One)</a></li>
<li><a href="#one-to-many">一對多 (One To Many)</a></li>
<li><a href="#many-to-many">多對多 (Many To Many)</a></li>
<li><a href="#polymorphic-relations">多型態的關聯 (Polymorphic Relations)</a></li>
</ul>

<p><a name="one-to-one"></a></p>

<h3>一對一 (One To One)</h3>

<p>
    一對一的關聯資料是非常基本的關聯，舉例來說 <code>User</code> 模型中的使用，有一筆 <code>Phone</code> 模型中的電話資料，我們可以在 Eloquent 定義這個關聯關係:
</p>

<p><strong>定義一對一關聯</strong></p>

<pre><code>class User extends Eloquent {

    public function phone()
    {
        return $this-&gt;hasOne('Phone');
    }

}
</code></pre>

<p>
    傳送給 <code>hasOne</code> 方法的第一個參數是要關聯的模組名稱，只要關聯定義完成，你可以使用 Eloquent 的 <a href="#dynamic-properties">動態屬性</a> 去取得被關聯的資料:
</p>

<pre><code>$phone = User::find(1)-&gt;phone;
</code></pre>

<p>
    SQL 將會執行下列的語法去做查詢:
</p>

<pre><code>select * from users where id = 1

select * from phones where user_id = 1
</code></pre>

<p>
    這裡要注意到， Eloquent 認定要做關聯的外來鍵 (foreign key) 是基於模組名稱去做設定的，在這個例子中， <code>Phone</code> 模型會被認定要用 <code>user_id</code> 做關聯時的外來鍵，假如你要變更這個預設的外來鍵名稱設定，你可以在 <code>hasOne</code> 方法中的第二個參數傳送你要自訂的外來鍵名稱:
</p>

<pre><code>return $this-&gt;hasOne('Phone', 'custom_key');
</code></pre>

<p>
    我們可以使用 <code>belongsTo</code> 方法，在 <code>Phone</code> 模型中定義反向的關聯:
</p>

<p><strong>定義反向關聯</strong></p>

<pre><code>class Phone extends Eloquent {

    public function user()
    {
        return $this-&gt;belongsTo('User');
    }

}
</code></pre>

<p><a name="one-to-many"></a></p>

<h3>一對多 (One To Many)</h3>

<p>
    一對多關聯的範例，就像一個部落格文章有"多"個評論，所以我們可以在模型中定義這個關聯關係:
</p>

<pre><code>class Post extends Eloquent {

    public function comments()
    {
        return $this-&gt;hasMany('Comment');
    }

}
</code></pre>

<p>
    現在我們可以透過 <a href="#dynamic-properties">動態屬性</a> 去存取部落格文章的評論資料了:
</p>

<pre><code>$comments = Post::find(1)-&gt;comments;
</code></pre>

<p>
    如果需要在取得的評論資料中家更多的限制，可以呼叫 <code>comments</code> 方法，並持續使用方法鏈 (chain) 的方式，做更多的條件的設定:
</p>

<pre><code>$comments = Post::find(1)-&gt;comments()-&gt;where('title', '=', 'foo')-&gt;first();
</code></pre>

<p>
    只要在 <code>hasMany</code> 第二個參數傳送外來鍵的名稱，即可複寫預設的外來鍵名稱:
</p>

<pre><code>return $this-&gt;hasMany('Comment', 'custom_key');
</code></pre>

<p>
    我們可以使用 <code>belongsTo</code> 方法，在 <code>Comment</code> 模型中定義反向的關聯:
</p>

<p><strong>定義反向關聯</strong></p>

<pre><code>class Comment extends Eloquent {

    public function post()
    {
        return $this-&gt;belongsTo('Post');
    }

}
</code></pre>

<p><a name="many-to-many"></a></p>

<h3>多對多 (Many To Many)</h3>

<p>
    多對多關聯是一個較複雜的關連類型，舉例來說，像使用者有多種腳色，而相同的腳色可能有數個不同的使用者扮演，就像許多使用者有 "管理者 (Admin)" 的腳色，資料庫中需要三個資料表去表示之間的關係: <code>users</code> 、 <code>roles</code> 及 <code>role_user</code> 這三個資料表，其中 <code>role_user</code> 資料表名稱，是根據關聯的兩個資料表 ( users 及 roles)的字母順序去做命名，在 <code>role_user</code> 資料表中需要有 <code>user_id</code> 及 <code>role_id</code> 這兩個欄位。
</p>

<p>
    我們可以使用 <code>belongsToMany</code> 方法，去定義多對多的關係:
</p>

<pre><code>class User extends Eloquent {

    public function roles()
    {
        return $this-&gt;belongsToMany('Role');
    }

}
</code></pre>

<p>
    現在我們可以透過 <code>User</code> 模型，去取得使用者的腳色資料:
</p>

<pre><code>$roles = User::find(1)-&gt;roles;
</code></pre>

<p>
    在 <code>belongsToMany</code> 方法的第二個參數你可以傳入資料表名稱，使用非預設的名稱當作關聯資料表的名稱:
</p>

<pre><code>return $this-&gt;belongsToMany('Role', 'user_roles');
</code></pre>

<p>你也可以複寫預設使用的關聯鍵值 (associated keys):</p>

<pre><code>return $this-&gt;belongsToMany('Role', 'user_roles', 'user_id', 'foo_id');
</code></pre>

<p>
    你也可以在 <code>Role</code> 模型中定義反向的關聯:
</p>

<pre><code>class Role extends Eloquent {

    public function users()
    {
        return $this-&gt;belongsToMany('User');
    }

}
</code></pre>

<p><a name="polymorphic-relations"></a></p>

<h3>多型態的關聯 (Polymorphic Relations)</h3>

<p>
    多型態的關聯，允許模型可以關聯數個其他的模型，舉例來說，你有一個 photo 模型的資料，其資料是屬於 staff 或 Order 模型，我們可以這樣定義彼此的關聯:
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

<p>
    我們可以用 staff 或 order 資料去取得 photos 模型的資料:
</p>

<p><strong>Retrieving A Polymorphic Relation</strong></p>

<pre><code>$staff = Staff::find(1);

foreach ($staff-&gt;photos as $photo)
{
    //
}
</code></pre>

<p>
    然而，"多型態關聯" 神奇的地方在於，你可以透過 <code>Photo</code> 模型去取得 staff 或 order 模型的資料:
</p>

<p><strong>取得擁有多型態關聯的資料</strong></p>

<pre><code>$photo = Photo::find(1);

$imageable = $photo-&gt;imageable;
</code></pre>

<p>
    在 <code>Photo</code> 模型中 <code>imageable</code> 關聯將會回傳 <code>Staff</code> 或 <code>Order</code> 模型實例，取決於哪個類型的模型擁有這個 photo 的資料。
</p>

<p>
    為了幫助你了解"多型態關聯"是如何運作的，讓我們來多型態關聯中探索資料庫的結構:
</p>

<p><strong>多型態關聯資料表結構</strong></p>

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
    在 <code>photos</code> 資料比中的關鍵欄位在 <code>imageable_id</code> 及 <code>imageable_type</code> 上，可以提醒資料是屬於哪個模型的資料， <code>imageable_id</code> 將會包含關聯模型的 ID 值，在這個例子中，擁有者是 staff 或 order 模型，所以 <code>imageable_type</code> 資料會是擁有的模型名稱，這可以讓 ORM 去決定 <code>imageable</code> 關聯將回傳哪個模型的實例。
</p>

<p><a name="querying-relations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.querying_relations') }}</h2>

<p>
    當存取模型的資料時，你或許想限制關聯資料存取的筆數，舉例來說，你可能想撈取所有的部落格文章，其中文章至少要有一個以上的評論，你可以使用 <code>has</code> 的方法，去達到這樣的目的:
</p>

<p><strong>在撈取資料時檢查關聯</strong></p>

<pre><code>$posts = Post::has('comments')-&gt;get();
</code></pre>

<p>你也可以指定運算子及筆數</p>

<pre><code>$posts = Post::has('comments', '&gt;=', 3)-&gt;get();
</code></pre>

<p><a name="dynamic-properties"></a></p>

<h3>動態屬性</h3>

<p>
    Eloquent 允許你透過動態屬性去存取關聯的資料， Eloquent 將會自動替你建立關聯關係，也可以很聰明地呼叫 <code>get</code> (一對多的關聯關係) 或 <code>first</code> (一對一的關聯關係) 方法去取得關聯資料，以下列的 <code>$phone</code> 模型舉例:
</p>

<pre><code>class Phone extends Eloquent {

    public function user()
    {
        return $this-&gt;belongsTo('User');
    }

}

$phone = Phone::find(1);
</code></pre>

<p>取代像列印使用者的 email:</p>

<pre><code>echo $phone-&gt;user()-&gt;first()-&gt;email;
</code></pre>

<p>可以被簡化為:</p>

<pre><code>echo $phone-&gt;user-&gt;email;
</code></pre>

<p><a name="eager-loading"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.eager_loading') }}</h2>

<p>
    預先加載的存在是為了減輕N +1查詢問題。例如，考慮一個書模型，是關係到作者。關係定義，像這樣：

    預先加載是為了減輕 N + 1 個查詢問題，舉例來說，考慮讓 <code>Book</code> 模型關聯到 <code>Author</code> 模型，其關聯關係可定義成像這樣:
</p>

<pre><code>class Book extends Eloquent {

    public function author()
    {
        return $this-&gt;belongsTo('Author');
    }

}
</code></pre>

<p>現在我們來考慮下列的程式:</p>

<pre><code>foreach (Book::all() as $book)
{
    echo $book-&gt;author-&gt;name;
}
</code></pre>

<p>
    這個迴圈會執行 1 次查詢去取得 "books" 資料表中所有的書籍，而另外一個查詢是去取得其書籍的作者，所以在我們有 25 本書的情況下，這個迴圈將會執行 26 次的查詢。
</p>

<p>
    值得慶幸的是，我們可以用預先加載查詢的數量大幅減少。通過與方法的關係，應該是急於裝可以指定：

    值得慶幸的是，我們可以使用預先加載去減少查詢數量，可以使用 <code>with</code> 方法在關聯中去完成預先加載:
</p>

<pre><code>foreach (Book::with('author')-&gt;get() as $book)
{
    echo $book-&gt;author-&gt;name;
}
</code></pre>

<p>
    在上列的迴圈，只有兩個查詢會被執行:
</p>

<pre><code>select * from books

select * from authors where id in (1, 2, 3, 4, 5, ...)
</code></pre>

<p>
    明智的使用預先加載，可以大大提高你應用程式的效能。
</p>

<p>
    當然你也可以一次就加載數個關聯的資料:
</p>

<pre><code>$books = Book::with('author', 'publisher')-&gt;get();
</code></pre>

<p>
    你也可以預先加載巢狀的關聯:
</p>

<pre><code>$books = Book::with('author.contacts')-&gt;get();
</code></pre>

<p>
    在上述的範例中，<code>author</code> 關聯將會被預先加載，而 author 的 <code>contacts</code> 關聯也會被預先加載。
</p>

<h3>預先加載限制</h3>

<p>
    有時你會希望預先加載關聯資料，並且可以指定加載的條件，這裡有使用範例:
</p>

<pre><code>$users = User::with(array('posts' =&gt; function($query)
{
    $query-&gt;where('title', 'like', '%first%');
}))-&gt;get();
</code></pre>

<p>
    在這個範例中，我們可以預先加載使用者的文章，但只加載文章標題欄位有 "first" 字串的欄位。
</p>

<h3>懶人預先加載</h3>

<p>
    也可以從存在的模型集合中直接預先加載資料，這樣可以根據所需，動態決定是否加載關聯的模型資料，或是快取的組合。
</p>

<pre><code>$books = Book::all();

$books-&gt;load('author', 'publisher');
</code></pre>

<p><a name="inserting-related-models"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.inserting_related_models') }}</h2>

<p>
    你經常需要新增新的資料到關聯的模組中，舉例來說，你也許希望新增一則評論到文章時，能夠幫你自動將 <code>post_id</code> 外來鍵新增到模型當中，你可以透過母模型 <code>Post</code> 去直接新增一則評論到文章中，來達到自動新增外來鍵到模型中的目的:
</p>

<p><strong>附加關聯模型</strong></p>

<pre><code>$comment = new Comment(array('message' =&gt; 'A new comment.'));

$post = Post::find(1);

$comment = $post-&gt;comments()-&gt;save($comment);
</code></pre>

<p>
    在這個範例中，<code>post_id</code> 欄位將會自動的設定到評論的關聯文章資料中。
</p>

<h3>關聯模型 - 屬於 (Belongs To)</h3>

<p>
    當更新一個 <code>屬於 (belongsTo)</code> 關係的關聯資料時，你可以使用 <code>associate</code> 方法去實作，這個方法將會設定外來鍵到子模型中:
</p>

<pre><code>$account = Account::find(10);

$user-&gt;account()-&gt;associate($account);

$user-&gt;save();
</code></pre>

<h3>新增關聯模型 - 多對多 (Many To Many)</h3>

<p>
    你可能會新增資料到 "多對多 (many-to-many)" 關聯模型當中，讓我們用 <code>User</code> 及 <code>Role</code> 模型來當作範例，我們可以使用 <code>attach</code> 方法，附加一個新的腳色給使用者::
</p>

<p><strong>附加多對多模型</strong></p>

<pre><code>$user = User::find(1);

$user-&gt;roles()-&gt;attach(1);
</code></pre>

<p>
    你也可以傳送一個屬性陣列資料，儲存關聯資料到資料表中:
</p>

<pre><code>$user-&gt;roles()-&gt;attach(1, array('expires' =&gt; $expires));
</code></pre>

<p>
    當然，<code>attach</code> 的反向方法就是 <code>detach</code>:
</p>

<pre><code>$user-&gt;roles()-&gt;detach(1);
</code></pre>

<p>
    你也可以使用 <code>sync</code> 方法去附加關聯模型資料，<code>sync</code> 方法接收編號陣列資料，並將編號資料存放到關聯資料中，在操作完成後，陣列中的編號將會建立到關聯資料模型中:
</p>

<p><strong>使用同步附加多對多模型</strong></p>

<pre><code>$user-&gt;roles()-&gt;sync(array(1, 2, 3));
</code></pre>

<p>
    除了關聯給予的陣列編號外，你也可以將其他的資料儲存到關聯模型中:
</p>

<p><strong>同步時加入關聯資料</strong></p>

<pre><code>$user-&gt;roles()-&gt;sync(array(1 =&gt; array('expires' =&gt; true)));
</code></pre>

<p>
    有時你可能希望新增一個新的資料到關聯的模型中，並同時在一行指令中附加新的關聯資料，在這個操作中，你可以使用 <code>save</code> 方法去完成這樣的需求:
</p>

<pre><code>$role = new Role(array('name' =&gt; 'Editor'));

User::find(1)-&gt;roles()-&gt;save($role);
</code></pre>

<p>
    在這個範例中，新的 <code>Role</code> 模型資料將會被儲存，並附加到使用者模型中，你也可以傳遞一屬性陣列值，將此陣列值的資料，也一併存放到關聯資料中:
</p>

<pre><code>User::find(1)-&gt;roles()-&gt;save($role, array('expires' =&gt; $expires));
</code></pre>

<p><a name="touching-parent-timestamps"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.db.eloquent.touching_parent_timestamps') }}</h2>

<p>
    當模型 <code>屬於 (belongsTo)</code>另外一個模型時，像 <code>Comment</code> 模型是附屬在 <code>Post</code> 模型下，如果子模型被更新時，也能夠更新母模型，對應用程式運作是相當方便的，舉例來說，當 <code>Comment</code> 模型被更新，你或許想要自動更新擁有它 <code>Post</code> 模型的 <code>更新時間 (updated_at)</code> 欄位，Eloquent可以讓這樣的功能變得相當容易，只需要在子模型中加入 <code>touches</code> 屬性，其中屬性包含有關連到子模型的母模型名稱:
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
    現在當你更新 <code>Comment</code> 模型的資料時，擁有它的 <code>Post</code> 模型 <code>updated_at</code> 欄位將會自動更新:
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
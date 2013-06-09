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

<p>
    你可以在命列列輸入以下指令安裝 Laravel:
</p>

<pre>
    <code>composer create-project laravel/laravel</code>
</pre>

<p>
    或者，你也可以從 <a href="https://github.com/laravel/laravel/archive/master.zip" target="_blank">Github Repository</a> 下載，下一步則是 <a href="http://getcomposer.org" target="_blank">安裝Composer</a> ，安裝完Composer後接下來在專案的根目錄執行 <code>composer install</code> 指令進行安裝，這個指令將會下載安裝 Laravel 所需要的套件
</p>

<p>
    在安裝完 Laravel 之後，可以看一下專案目錄去熟悉目錄架構，<code>app</code> 目錄包含的資料夾有<code>views(視圖)</code> 、 <code>controllers(控制器)</code> 及 <code>models(模型)</code>，您大多數的程式碼都在 <code>app</code> 的資料夾中進行撰寫。您也可以到 <code>app/config</code> 目錄看看，這裡提供您應用程式可以設定的選項。
</p>

<p><a name="routing"></a></p>
<h2>{{ Lang::get('l4doc.docs_title.preface.quick.routing') }}</h2>

<p>
    為了要開始我們的應用程式，讓我們建立我們第一個路由(route)，在 Laravel 中最簡單的路由是封閉性的路由，打開 <code>app/routes.php</code> 檔案並在檔案下方加入下列路由規則:
</p>

<pre><code>Route::get('users', function()
{
    return 'Users!';
});</code></pre>

<p>
    現在如果你在瀏覽器網址列輸入 <code>/users</code> 的路由，你將會看到網頁輸出 <code>Users!</code> 的字串，太棒了!，你剛剛建立了你的第一個路由~
</p>

<p>
    路由也可以附屬於控制器(Controller)類別，例如:
</p>

<pre><code>Route::get('users', 'UserController@getIndex');</code></pre>

<p>
    這個路由告知了 Laravel ，任何對於網站的 <code>/users</code> 請求，將會導到 <code>UserController</code> 控制器類別中的 <code>getIndex</code>方法，有關於更多的控制器路由資訊，可以參考 <a href="../../docs/controllers"> {{ Lang::get('l4doc.layout.docs_menu.controllers') }}</a> 說明文件
</p>

<p><a name="creating-a-view"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.quick.creating_a_view') }}</h2>

<p>
    下一步我們將建立一個簡單的view(視圖)去呈現我們使用者的資料，view檔案是放在 <code>app/views</code> 目錄，包含網頁應用程式的 HTML 程式碼，我們要在這個目錄建立 <code>docs_title.blade.php</code> 及 <code>users.blade.php</code> 這兩個 view 的檔案，首先我們先建立 <code>docs_title.blade.php</code> 的檔案內容:
</p>

<pre><code>&lt;html&gt;
    &lt;body&gt;
        &lt;h1&gt;Laravel Quickstart&lt;/h1&gt;

        (@)yield('content')
    &lt;/body&gt;
&lt;/html&gt;</code></pre>

<p>
    下一步我們建立 <code>users.blade.php</code> 的檔案內容:
</p>

<pre><code>(@)extends('docs_title')

(@)section('content')
    Users!
(@)stop
</code></pre>

<p>
    有一些語法或對你來說會有點陌生，這是因為我們正在使用 Laravel 的樣板系統 : <code>Blade</code> 。 Blade 執行速度非常快，因為它是一個少數簡單的正規表示式，使用單純的PHP對樣板進行編譯，Blade 提供強大的功能，像樣板繼承(inheritance)，以及一些典型的 PHP 控制結構，像 <code>if</code> 及 <code>for</code>，其他詳情可以參考 <a href="../../docs/templates"> {{ Lang::get('l4doc.layout.docs_menu.templates') }}</a> 說明文件
</p>

<p>
    現在我們有我們的view了，讓我們回到我們 <code>/users</code> 的路由下，將原本回傳路由下回傳 <code>Users!</code> 變更為回傳 view 的內容:
</p>

<pre><code>Route::get('users', function()
{
    return View::make('users');
});
</code></pre>

<p>
    太棒了，現在你已經設定了一個簡單的view，並引用了 docs_title 的 view ，讓我們開始處理資料庫層吧。
</p>

<p><a name="creating-a-migration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.quick.creating_a_migration') }}</h2>

<p>
    為了建立一個資料表去保存我們的資料，我們將使用 Laravel 的 Migration 系統，Migration 讓你能夠透過語意表達，去定義修改你的資料庫，而且可以將這些對資料庫的修改異動，輕易的與團隊中的其他人共享。
</p>

<p>
    首先讓我們來設定資料庫連線吧，你可以在 <code>app/config/database.php</code> 的檔案中設定所有的資料庫連線。 Laravel是使用 SQlite 當作預設使用的資料庫，並保存資料於 <code>app/database</code> 資料夾。 你也可以變更要預設使用的 <code>資料庫類型</code> 為 <code>mysql</code> ，並在資料庫設定檔案中設定 <code>mysql</code> 連線的相關驗證資訊。
</p>

<p>
    接下來我們使用 <a href="../../docs/artisan">{{ Lang::get('l4doc.layout.docs_menu.artisan') }}</a>去建立我們的 Migration，在我們專案的根目錄執行下列指令:
</p>

<pre><code>php artisan migrate:make create_users_table
</code></pre>

<p>
    接下來，找到應用程序/數據庫/遷移文件夾中生成的遷移文件。此文件包含一個類有兩個方法：向上和向下。在方法，你應該作出所需的更改數據庫表，在向下的方法，你根本扭轉。 

    接下來到 <code>app/database/migrations</code> 目錄找到我們產生的 Migration 檔案，這個檔案會包含兩個方法:<code>up</code> 及 <code>down</code> ，在 <code>up</code> 方法中建立你想要對資料表做的異動，在 <code>down</code> 方法中則是做與 <code>up</code> 方法反向的資料表異動。
</p>

<p>
    讓我們來定義 Migration 檔案，看起來會像下列這樣:
</p>

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
    接下來，我們可以從命令列執行我們的 Migration ，只需要在專案的根目錄執行下列 <code>migrate</code> 指令即可
</p>

<pre><code>php artisan migrate
</code></pre>

<p>
    如果你想要復原執行過的 Migration ，可以在命令列輸入 <code>migrate:rollback</code> 指令即可，而現在我們有一個資料表了，讓我們從資料表中來抓取一些資料吧!
</p>

<p><a name="eloquent-orm"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.quick.eloquent_orm') }}</h2>

<p>
    Laravel 擁有一個優秀的 ORM : Eloquent ，如果你使用過 Ruby on Rails 的框架，你會發現 Eloquent 有很熟悉的感覺，因為他遵循著 ActiveRecord ORM 風格的資料庫互動。
</p>

<p>
    首先讓我們定義一個 Model(模型)，一個 Eloquent 可以被用來使用資料庫的關聯查詢，就像在給予的列(row)資料中，表示在資料表中的資料，別擔心，你會很快地了解它的! Model 通常是存放在 <code>app/models</code> 目錄，讓我們在 Model 資料夾中定義一個 <code>User.php</code> 的 Model ，像這樣:
</p>

<pre><code>class User extends Eloquent {}
</code></pre>

<p>
    請注意，我們沒有告訴 Eloquent 要使用哪一個資料表， Eloquent 有很多種預設的規則，其中一個規則是使用 Model 名稱複數名稱 (User => Users) 當作是資料表的名稱，相當的方便!
</p>

<p>
    使用你偏好的資料庫管理工作，在你的 <code>users</code> 資料表新增幾筆資料，我們將使用 Eloquent 去取得這些資料，並將資料傳給我們的 view。
</p>

<p>
    現在我們去修改 <code>/users</code> 的路由規則，改成像這樣子:
</p>

<pre><code>Route::get('users', function()
{
    $users = User::all();

    return View::make('users')-&gt;with('users', $users);
});
</code></pre>

<p>
    讓我們來循序走過在這個路由的過程，首先 在 <code>User</code> Model 中的 <code>all</code> 方法，會取得所有在 <code>users</code> 資料表的所有資料，下一步我們透過 <code>with</code> 方法傳遞這些資料給我們的 view， <code>with</code> 的方法接受一個 key 及 value 的資料，讓資料可以在 view 中被存取使用。
</p>

<p>
    太棒了，現在我們準備在 view 中顯示使用者的資料了!
</p>

<p><a name="displaying-data"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.quick.displaying_data') }}</h2>

<p>
    我們讓 view 可以透過 <code>users</code> 存取我們使用者的資料，所以我們可以像這樣去顯示使用者的資料:
</p>

<pre><code>(@)extends('docs_title')

(@)section('content')
    (@)foreach($users as $user)
        &lt;p&gt;{ { $user-&gt;name } }&lt;/p&gt;
    (@)endforeach
(@)stop
</code></pre>

<p>
    你可能會好奇在哪裡去找到我們的 <code>echo</code> 陳述式，當我們使用 Blade，你可以透過兩個大括號({)({)(})(})去列印資料，這相當的容易，現在你可以到 <code>/users</code> 路由下去看看你的資料表的使用者姓名了。
</p>

<p>
    這僅僅是剛開始而已，在本次教學中，你已經看到基本的 Laravel 的框架了，但是還有更多令人興奮的東西等著我們去學，可以去閱讀 <a href="../../docs/eloquent">{{ Lang::get('l4doc.layout.docs_menu.eloquent') }}</a> 及 <a href="../../docs/templates">{{ Lang::get('l4doc.layout.docs_menu.templates') }}</a> 教學文件去挖掘更深入更強大的功能。或許你會好奇 <a href="../../docs/queues">{{ Lang::get('l4doc.layout.docs_menu.queues') }}</a> 及 <a href="../../docs/testing">{{ Lang::get('l4doc.layout.docs_menu.testing') }}</a>，話又說回來，或許你想要使用 <a href="../../docs/ioc">{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</a> 展示可擴充性的架構，都是可以讓你選擇的!
</p>
@stop;
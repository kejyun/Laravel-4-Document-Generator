@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.controllers') }}</h1>

<ul>
  <li>
    <a href="#basic-controllers">{{ Lang::get('l4doc.docs_title.getting_started.controllers.basic_controllers') }}</a>
  </li>
  <li>
    <a href="#controller-filters">{{ Lang::get('l4doc.docs_title.getting_started.controllers.controller_filters') }}</a>
  </li>
  <li>
    <a href="#restful-controllers">{{ Lang::get('l4doc.docs_title.getting_started.controllers.restful_controllers') }}</a>
  </li>
  <li>
    <a href="#resource-controllers">{{ Lang::get('l4doc.docs_title.getting_started.controllers.resource_controllers') }}</a>
  </li>
  <li>
    <a href="#handling-missing-methods">{{ Lang::get('l4doc.docs_title.getting_started.controllers.handling_missing_methods') }}</a>
  </li>
</ul>

<p><a name="basic-controllers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.basic_controllers') }}</h2>

<p>
  除了在 <code>routes.php</code> 檔案中定義你所有路由層級的邏輯外，你可能希望使用控制器類別去整理這些處理邏輯，控制器可以整合相關的路由邏輯成一個類別，也可以有進階框架功能的優點，像是自動化的 <a href="../../docs/ioc">{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</a>
</p>

<p>
  控制器基本上是存放在 <code>app/controllers</code> 目錄裡，這個目錄已經在預設在 <code>composer.json</code> 檔案中的 <code>classmap</code> 選項預設註冊載入。
</p>

<p>這裡有一個基本控制器的範例:</p>

<pre><code>class UserController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function showProfile($id)
    {
        $user = User::find($id);

        return View::make('user.profile', array('user' =&gt; $user));
    }

}
</code></pre>

<p>
  所有的控制器必須繼承 <code>BaseController</code> 的類別，<code>BaseController</code> 也存放在 <code>app/controllers</code> 的目錄裡，也可以用來放一些共用的控制器邏輯，<code>BaseController</code> 繼承了 Laravel 框架的 <code>Controller</code> 類別，現在我們可以路由到這個控制的的方法，像這樣:
</p>

<pre><code>Route::get('user/{id}', 'UserController@showProfile');
</code></pre>

<p>
  如果你選擇用巢狀或 PHP 命名空間 (namespaces) 的方式去組織你的控制器，在定義路由時，只要使用完整符合類別名稱的規則即可:
</p>

<pre><code>Route::get('foo', 'Namespace\FooController@method');
</code></pre>

<p>你也可以命名控制器的路由</p>

<pre><code>Route::get('foo', array('uses' =&gt; 'FooController@method',
                                        'as' =&gt; 'name'));
</code></pre>

<p>
  為了產生 URL 指到到控制器，你可以使用 <code>URL::action</code> 的方法:
</p>

<pre><code>$url = URL::action('FooController@method');
</code></pre>

<p>
  你可以執行 <code>currentRouteAction</code> 方法去取得目前路由到控制器的方法:
</p>

<pre><code>$action = Route::currentRouteAction();
</code></pre>

<p><a name="controller-filters"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.controller_filters') }}</h2>

<p>
  <a href="../../docs/routing">{{ Lang::get('l4doc.layout.docs_menu.routing') }} : 過濾器</a> 可以指定用在控制器，就像常見的"路由"一樣。
</p>

<pre><code>Route::get('profile', array('before' =&gt; 'auth',
            'uses' =&gt; 'UserController@showProfile'));
</code></pre>

<p>
  然而，你也可以在控制器裡面指定你的過濾器:
</p>

<pre><code>class UserController extends BaseController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this-&gt;beforeFilter('auth');

        $this-&gt;beforeFilter('csrf', array('on' =&gt; 'post'));

        $this-&gt;afterFilter('log', array('only' =&gt;
                            array('fooAction', 'barAction')));
    }

}
</code></pre>

<p>
  你也可以在控制器的過濾器裡使用閉合函式:
</p>

<pre><code>class UserController extends BaseController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this-&gt;beforeFilter(function()
        {
            //
        });
    }

}
</code></pre>

<p><a name="restful-controllers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.restful_controllers') }}</h2>

<p>
  Laravel 允許你使用簡單的 REST 命名規範，去定義一個簡單的路由去處理每一個在控制器裡的方法，首先使用 <code>Route::controller</code> 去定義路由:
</p>

<p><strong>定義一個 RESTful 控制器</strong></p>

<pre><code>Route::controller('users', 'UserController');
</code></pre>

<p>
  <code>controller</code> 方法允許兩個參數，第一個是 URI 為基準的控制器處理方法，第二個是控制器類別名稱，接下來只要增加方法到你的控制器，前綴使用 HTTP 請求方法的動詞去對應即可:
</p>

<pre><code>class UserController extends BaseController {

    public function getIndex()
    {
        //
    }

    public function postProfile()
    {
        //
    }

}
</code></pre>

<p>
  <code>index</code> 方法將會對應到控制器處理 URI 的根目錄，在這個例子是 <code>users</code>
</p>

<p>
  如果你的控制器方法包含數個字詞，你可以在 URI 使用 "破折號 (dash)" 的語法去存取它，舉例來說，在下面 <code>UserController</code> 的動作將會對應到 <code>users/admin-profile</code> 的 URI。
</p>

<pre><code>public function getAdminProfile() {}
</code></pre>

<p><a name="resource-controllers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.resource_controllers') }}</h2>

<p>
  資源 (Resource) 的控制器可以很容易地去建置 RESTful 控制器，舉例來說，你也許希望在你的應用裡，建立一個控制器去管理你的"相片"，在 {{ Lang::get('l4doc.layout.docs_menu.artisancli') }} 使用 <code>controller:make</code> 的指令，和 <code>Route::resource</code> 的方法，我們就可以快速地建立這些控制器。
</p>

<p>
  為了透過命令列建立控制器，你可以執行下列指令:
</p>

<pre><code>php artisan controller:make PhotoController
</code></pre>

<p>
  現在我們可以註冊一個資源化 (resourceful) 的路由到這個控制器:
</p>

<pre><code>Route::resource('photo', 'PhotoController');
</code></pre>

<p>
  這個單一路由的定義，在 photo 建立了多個路由資源，去做不同的 RESTful 動作存取，同樣的，被產生的控制器將會有基本的方法，這些方法動作將會告知你哪個 URI 和 HTTP 請求動作是他們所處理的。
</p>

<p><strong>資源控制器處理的動作</strong></p>

<table>
<thead>
<tr>
  <th>Verb</th>
  <th>Path</th>
  <th>Action</th>
  <th>Route Name</th>
</tr>
</thead>
<tbody>
<tr>
  <td>GET</td>
  <td>/resource</td>
  <td>index</td>
  <td>resource.index</td>
</tr>
<tr>
  <td>GET</td>
  <td>/resource/create</td>
  <td>create</td>
  <td>resource.create</td>
</tr>
<tr>
  <td>POST</td>
  <td>/resource</td>
  <td>store</td>
  <td>resource.store</td>
</tr>
<tr>
  <td>GET</td>
  <td>/resource/{id}</td>
  <td>show</td>
  <td>resource.show</td>
</tr>
<tr>
  <td>GET</td>
  <td>/resource/{id}/edit</td>
  <td>edit</td>
  <td>resource.edit</td>
</tr>
<tr>
  <td>PUT/PATCH</td>
  <td>/resource/{id}</td>
  <td>update</td>
  <td>resource.update</td>
</tr>
<tr>
  <td>DELETE</td>
  <td>/resource/{id}</td>
  <td>destroy</td>
  <td>resource.destroy</td>
</tr>
</tbody>
</table>

<p>
  有時候，你也許只需要處理資源的某些方法:
</p>

<pre><code>php artisan controller:make PhotoController --only=index,show

php artisan controller:make PhotoController --except=index
</code></pre>

<p>
  接下來，也可以指名路由去處理部分的方法動作:
</p>

<pre><code>Route::resource('photo', 'PhotoController',
                array('only' =&gt; array('index', 'show')));
</code></pre>

<p><a name="handling-missing-methods"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.controllers.handling_missing_methods') }}</h2>

<p>
  可以定義一個擷取所有動作的方法，在沒有比對到控制器中的方法時，會呼叫此方法，這個方法是命名為 <code>missingMethod</code>，且接受了的參數陣列為此請求方法的唯一參數:
</p>

<p><strong>定義一個接收所有 (Catch-All) 請求的方法</strong></p>

<pre><code>public function missingMethod($parameters)
{
    //
}
</code></pre>
@stop;
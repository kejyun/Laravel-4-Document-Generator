@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.routing') }}</h1>

<ul>
    <li>
        <a href="#basic-routing">{{ Lang::get('l4doc.docs_title.getting_started.routing.basic_routing') }}</a>
    </li>
    <li>
        <a href="#route-parameters">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_parameters') }}</a>
    </li>
    <li>
        <a href="#route-filters">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_filters') }}</a>
    </li>
    <li>
        <a href="#named-routes">{{ Lang::get('l4doc.docs_title.getting_started.routing.named_routes') }}</a>
    </li>
    <li>
        <a href="#route-groups">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_groups') }}</a>
    </li>
    <li>
        <a href="#sub-domain-routing">{{ Lang::get('l4doc.docs_title.getting_started.routing.sub_domain_routing') }}</a>
    </li>
    <li>
        <a href="#route-prefixing">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_prefixing') }}</a>
    </li>
    <li>
        <a href="#route-model-binding">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_model_binding') }}</a>
    </li>
    <li>
        <a href="#throwing-404-errors">{{ Lang::get('l4doc.docs_title.getting_started.routing.throwing_404_errors') }}</a>
    </li>
    <li>
        <a href="#routing-to-controllers">{{ Lang::get('l4doc.docs_title.getting_started.routing.routing_to_controllers') }}</a>
    </li>
</ul>

<p><a name="basic-routing"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.basic_routing') }}</h2>

<p>
    你的 Laravel 應用程式的路由將會被定義在 <code>app/routes.php</code>  的檔案中，最簡單的 Laravel 路由為一個 URI 及一個封閉呼叫的函式 (Closure callback)
</p>

<p><strong>基本 GET 路由</strong></p>

<pre><code>Route::get('/', function()
{
    return 'Hello World';
});
</code></pre>

<p><strong>基本 POST 路由</strong></p>

<pre><code>Route::post('foo/bar', function()
{
    return 'Hello World';
});
</code></pre>

<p><strong>註冊一個處理任何 HTTP 請求的路由 (GET、POST、PUT及DELETE) </strong></p>

<pre><code>Route::any('foo', function()
{
    return 'Hello World';
});
</code></pre>

<p><strong>強制路由要經過 HTTPS的加密連線</strong></p>

<pre><code>Route::get('foo', array('https', function()
{
    return 'Must be over HTTPS';
}));
</code></pre>

<p>
    通常你可以使用 <code>URL::to</code> 的方法，產生一個網址指向你定義的路由
</p>

<pre><code>$url = URL::to('foo');
</code></pre>

<p><a name="route-parameters"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_parameters') }}</h2>

<pre><code>Route::get('user/{id}', function($id)
{
    return 'User '.$id;
});
</code></pre>

<p><strong>可選擇的路由參數名稱</strong></p>

<pre><code>Route::get('user/{name?}', function($name = null)
{
    return $name;
});
</code></pre>

<p><strong>有預設值的路由參數名稱</strong></p>

<pre><code>Route::get('user/{name?}', function($name = 'John')
{
    return $name;
});
</code></pre>

<p><strong>使用正規表示式限制路由名稱</strong></p>

<pre><code>Route::get('user/{name}', function($name)
{
    //
})
-&gt;where('name', '[A-Za-z]+');

Route::get('user/{id}', function($id)
{
    //
})
-&gt;where('id', '[0-9]+');
</code></pre>

<p><a name="route-filters"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_filters') }}</h2>

<p>
    路由過濾器 (Route filters) 提供一個方便限制路由存取的方法，在限制某些路由需要通過驗證時，是一個很好用的辦法，在 Laravel 中有包含幾個過濾器，有 <code>auth</code> 、 <code>auth.basic</code> 、 <code>guest</code> 跟 <code>csrf</code> 4 個過濾器，這些過濾器是實作在 <code>app/filters.php</code> 的檔案內。
</p>

<p><strong>定義一個路由過濾器</strong></p>

<pre><code>Route::filter('old', function()
{
    if (Input::get('age') &lt; 200)
    {
        return Redirect::to('home');
    }
});
</code></pre>

<p>
    如果已經從過濾器回傳了回應，這個回應會視為這個請求的回應，那麼路由之後的動作將不會被執行，且任何的在路由上的 <code>after</code> 過濾器也不會被執行
</p>

<p><strong>在路由上加載一個過濾器</strong></p>

<pre><code>Route::get('user', array('before' =&gt; 'old', function()
{
    return 'You are over 200 years old!';
}));
</code></pre>

<p><strong>在路由上加載數個過濾器</strong></p>

<pre><code>Route::get('user', array('before' =&gt; 'auth|old', function()
{
    return 'You are authenticated and over 200 years old!';
}));
</code></pre>

<p><strong>指定過濾器的參數</strong></p>

<pre><code>Route::filter('age', function($route, $request, $value)
{
    //
});

Route::get('user', array('before' =&gt; 'age:200', function()
{
    return 'Hello World';
}));
</code></pre>

<p>在過濾器收到回應時，指定第三個參數 <code>$response</code> 傳遞給過濾器:</p>

<pre><code>Route::filter('log', function($route, $request, $response, $value)
{
    //
});
</code></pre>

<p><strong>以模式為基礎的過濾器</strong></p>

<p>
    你也可以指定過濾器給整個集合的 URI 路由
</p>

<pre><code>Route::filter('admin', function()
{
    //
});

Route::when('admin/*', 'admin');
</code></pre>

<p>
    在以上的範例，<code>admin</code> 過濾器將會在路由開頭名稱為 <code>admin/</code> 時去執行， <code>*</code> 是使用萬用字元，將會比對到所有的字元組合。
</p>

<p>
    你也可以限制模式過濾器在指定的 HTTP 請求中執行:
</p>

<pre><code>Route::when('admin/*', 'admin', array('post'));
</code></pre>

<p><strong>過濾類別</strong></p>

<p>
    對於進階的過濾方法，你或許想要一個類別去取代過濾的方法，而不是使用封閉函式的方式，由於過濾器的類別在 <a href="../../docs/ioc">{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</a> 中被解決了，你可以在這些過濾器使用相依注入的方式，獲得更大的可測性。
</p>

<p><strong>定義一個過濾類別</strong></p>

<pre><code>class FooFilter {

    public function filter()
    {
        // Filter logic...
    }

}
</code></pre>

<p><strong>註冊一個類別為基礎的過濾器</strong></p>

<pre><code>Route::filter('foo', 'FooFilter');
</code></pre>

<p><a name="named-routes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.named_routes') }}</h2>

<p>
    路由命名讓我們在產生"重新導向"或"網址"時，能夠更容易地去指向這個路由，你可以像這樣指定一個路由名稱:
</p>

<pre><code>Route::get('user/profile', array('as' =&gt; 'profile', function()
{
    //
}));
</code></pre>

<p>
    你也可以指定一個路由名稱到控制器的任一個方法動作:
</p>

<pre><code>Route::get('user/profile', array('as' =&gt; 'profile', 'uses' =&gt; 'UserController@showProfile'));
</code></pre>

<p>
    現在你可以在產生"重新導向"或"網址"時，使用路由的名稱了:
</p>

<pre><code>$url = URL::route('profile');

$redirect = Redirect::route('profile');
</code></pre>

<p>
    你可以透過執行 <code>currentRouteName</code> 的方法，去取得現在的路由名稱:
</p>

<pre><code>$name = Route::currentRouteName();
</code></pre>

<p><a name="route-groups"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_groups') }}</h2>

<p>
    有時候你或許需要將過濾器應用到一個路由群組中，除了明確地指明每一個要過濾的路由名稱的方法外，你也可以使用路由群組的方式去指定這個過濾器要過濾的路由:
</p>

<pre><code>Route::group(array('before' =&gt; 'auth'), function()
{
    Route::get('/', function()
    {
        // Has Auth Filter
    });

    Route::get('user/profile', function()
    {
        // Has Auth Filter
    });
});
</code></pre>

<p><a name="sub-domain-routing"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.sub_domain_routing') }}</h2>

<p>
    Laravel的路由也可以去處理萬用字元的子網域，傳送一個萬用字元的參數到這個網域下:
</p>

<p><strong>Registering Sub-Domain Routes</strong></p>

<pre><code>Route::group(array('domain' =&gt; '{account}.myapp.com'), function()
{

    Route::get('user/{id}', function($account, $id)
    {
        //
    });

});
</code></pre>

<p><a name="route-prefixing"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_prefixing') }}</h2>

<p>
    一個群組的路由可以使用 <code>prefix</code> 選項當作這個路由的前綴詞:
</p>

<p><strong>Prefixing Grouped Routes</strong></p>

<pre><code>Route::group(array('prefix' =&gt; 'admin'), function()
{

    Route::get('user', function()
    {
        //
    });

});
</code></pre>

<p><a name="route-model-binding"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.route_model_binding') }}</h2>

<p>
    模型 (Model) 可以方便的綁定在你的路由上，舉例來說，除了綁定使用者的編號到路由上，你也可以將整個使用者模型綁訂到路由上，去取得符合使用者編號資料的模型路由，首先使用 <code>Route::model</code> 的方法去指定用於整個模型的參數:
</p>

<p><strong>綁定參數到模型 (Model) 上</strong></p>

<pre><code>Route::model('user', 'User');
</code></pre>

<p>
    下一個，定義一個包含 <code>{user}</code> 參數的路由:
</p>

<pre><code>Route::get('profile/{user}', function(User $user)
{
    //
});
</code></pre>

<p>
    既然我們已經將 <code>{user}</code> 參數綁定到 <code>User</code> 模型上，這個 <code>User</code> 模型的實例將會被實做到這個路由上，因此舉例來說，如果有一個 <code>profile/1</code> 的請求到這個路由，則會將會轉為在 <code>User</code> 模型中編號為1的使用者。
</p>

<blockquote>
  <p><strong>備註:</strong> 如果比對到了模型的實例，但是在資料庫沒有找到這筆資料，則將會丟出 404 錯誤的訊息給使用者</p>
</blockquote>

<p>
    如果你想要指定"未找到""的行為，你可以在第三個參數傳遞一個封閉的函式參數到這個 <code>模型 (Model) </code> 方法中:
</p>

<pre><code>Route::model('user', 'User', function()
{
    throw new NotFoundException;
});
</code></pre>

<p>
    有時你可能會想要使用你自己的路由參數取解析路由，只要簡單的使用 <code>Route::bind</code> 方法即可:
</p>

<pre><code>Route::bind('user', function($value, $route)
{
    return User::where('name', $value)-&gt;first();
});
</code></pre>

<p><a name="throwing-404-errors"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.throwing_404_errors') }}</h2>

<p>
    有兩種方法可以手動的去觸發路由上的 404 錯誤訊息，首先你可以使用 <code>App::abort</code> 的方法去觸發:
</p>

<pre><code>App::abort(404);
</code></pre>

<p>
    第二種，你可以丟出一個 <code>Symfony\Component\HttpKernel\Exception\NotFoundHttpException</code> 的例外實例
</p>

<p>
    更多處理 404 例外，並使用自訂的錯誤回應給使用者的辦法可以在 <a href="../../docs/errors#handling-404-errors">{{ Lang::get('l4doc.layout.docs_menu.errors') }}</a> 章節中，找到相關的說明文件。
</p>

<p><a name="routing-to-controllers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.routing.routing_to_controllers') }}</h2>

<p>
    Laravel 不只允許你使用封閉的函式，也可以使用控制器類別，更允許你建立一個 <a href="../../docs/controllers">Resource {{ Lang::get('l4doc.layout.docs_menu.controllers') }}</a>
</p>

<p>
    更多詳細的說明文件可以在 <a href="../../docs/controllers">{{ Lang::get('l4doc.layout.docs_menu.controllers') }}</a> 中找到。
</p>
@stop;
@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</h1>

<ul>
<li>
    <a href="#introduction">{{ Lang::get('l4doc.docs_title.learning_more.ioc.introduction') }}</a>
</li>
<li>
    <a href="#basic-usage">{{ Lang::get('l4doc.docs_title.learning_more.ioc.basic_usage') }}</a>
</li>
<li>
    <a href="#automatic-resolution">{{ Lang::get('l4doc.docs_title.learning_more.ioc.automatic_resolution') }}</a>
</li>
<li>
    <a href="#practical-usage">{{ Lang::get('l4doc.docs_title.learning_more.ioc.practical_usage') }}</a>
</li>
<li>
    <a href="#service-providers">{{ Lang::get('l4doc.docs_title.learning_more.ioc.service_providers') }}</a>
</li>
<li>
    <a href="#container-events">{{ Lang::get('l4doc.docs_title.learning_more.ioc.container_events') }}</a>
</li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.basic_usage') }}</h2>

<p>
    Laravel 的控制反轉容器(Ioc Container)是一個管理類別依賴關係的強大工具。 依賴注入是一種避免類別依賴關係被寫死(hard-coded)的方法。 反而言之，讓依賴關係在執行階段時進行注入，這樣能使得依賴關係更容易彈性的交換使用。
</p>

<p>
    了解 Laravel 控制反轉容器是必要的，這不單只為了貢獻到 Laravel 核心，並能建立強大應用程式。
</p>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.automatic_resolution') }}</h2>

<p>
    控制反轉容器有兩種方式來分析依賴關係：透過「閉包回呼」函式或「自動分析」。 首先我們將探討閉包回呼部分。 假設有一種"類型"綁定到容器中。:
</p>

<p><strong>綁定一個類型到容器</strong></p>

<pre><code>App::bind('foo', function($app)
{
    return new FooBar;
});
</code></pre>

<p><strong>從容器中分析一個類型</strong></p>

<pre><code>$value = App::make('foo');
</code></pre>

<p>
    當 <code>App::make</code> 函式被呼叫後，閉包回呼內容將被執行並回傳結果。
</p>

<p>
    有時候，你或許想要被綁定到容器的閉包回呼函式執行時，僅被分析一次並回傳相同的物件實例:
</p>

<p><strong>綁定一個"被共享"類型到容器</strong></p>

<pre><code>App::singleton('foo', function()
{
    return new FooBar;
});
</code></pre>

<p>
    你也可能使用 <code>instance</code> 方法來綁定一個已存在的物件實例到容器:
</p>

<p><strong>綁定一個已存在的實例到容器</strong></p>

<pre><code>$foo = new Foo;

App::instance('foo', $foo);
</code></pre>

<p><a name="automatic-resolution"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.automatic_resolution') }}</h2>

<p>
    控制反轉容器相當強大，足夠在很多的情境，根本沒有任何設定下，分析出類別來。例如:
</p>

<p><strong>分析一個類別</strong></p>

<pre><code>class FooBar {

    public function __construct(Baz $baz)
    {
        $this-&gt;baz = $baz;
    }

}

$fooBar = App::make('FooBar');
</code></pre>

<p>
    注意，即便我們未註冊 FooBar 類別到容器中，容器仍然能夠分辦出類別並將 <code>Baz</code> 依賴關係自動注入
</p>

<p>
    當一種類型尚未被綁定到容器中，將會使用 PHP 的 Reflection facilities 去檢查類別以及讀取建構的類型指定。 利用這個特點，容器將會自動的建立類別的實例。
</p>

<p>
    然而，在一些案例中，一個類別也許依賴一個介面的實作，並非一個"具體類型"。 當在這種案例時，使用 <code>App::bind</code> 方法通知容器使用介面實作注入:
</p>

<p><strong>綁定介面到一個實作</strong></p>

<pre><code>App::bind('UserRepositoryInterface', 'DbUserRepository');
</code></pre>

<p>現在讓我們思索一下這個控制器:</p>

<pre><code>class UserController extends BaseController {

    public function __construct(UserRepositoryInterface $users)
    {
        $this-&gt;users = $users;
    }

}
</code></pre>

<p>
    我們綁定 <code>UserRepositoryInterface</code> 到具體類型後，當控制器被建立後， <code>DbUserRepository</code> 將自動地被注入。
</p>

<p><a name="practical-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.practical_usage') }}</h2>

<p>
    Laravel 提供幾個機會去使用控制反轉容器來增加你的應用程式強性和可測試。 分析控制器就是最主要的範例。 所有的控制器都透過控制反轉容器，這意味著你能夠在控制器建構時，給予依賴關係的類型指定，接著這些依賴的部分就會自動的被注入。
</p>

<p><strong>類型指定控制依賴</strong></p>

<pre><code>class OrderController extends BaseController {

    public function __construct(OrderRepository $orders)
    {
        $this-&gt;orders = $orders;
    }

    public function getIndex()
    {
        $all = $this-&gt;orders-&gt;all();

        return View::make('orders', compact('all'));
    }

}
</code></pre>

<p>
    在這個範例中， <code>OrderRepository</code> 類別將自動被注入到這個控制器中。 這表示當 <a href="../../docs/testing">{{ Lang::get('l4doc.layout.docs_menu.testing') }} (unit testing)</a> 進行 "mock" 時， 將會綁定 <code>OrderRepository</code>  到容器中並注入到控制器，無痛的使用資庫層操作。
</p>

<p>

    

    <a href="../../docs/routing#route-filters">{{ Lang::get('l4doc.docs_title.getting_started.routing.route_filters') }}</a> 、 <a href="../../docs/responses">{{ Lang::get('l4doc.docs_title.getting_started.responses.view_composers') }}</a> 與 <a href="../../docs/events">{{ Lang::get('l4doc.docs_title.learning_more.events.using_classes_as_listeners') }}</a> 也都被分辦到控制反轉容器中。 當你註冊它們後，簡單的給個類別名稱就能夠使用:
</p>

<p><strong>其它控制反轉容器的使用範例</strong></p>

<pre><code>Route::filter('foo', 'FooFilter');

View::composer('foo', 'FooComposer');

Event::listen('foo', 'FooHandler');
</code></pre>

<p><a name="service-providers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.service_providers') }}</h2>

<p>
    服務供應器是群組關聯控制反轉容器的一個好方法。 它們可以算是一個應用程式的啟動元件。 透過這個服務供應器，你可以註冊一個自訂的驗證驅動器，應用程式類別庫等到控制反轉容器，或甚至設定一個 Artisan 指令。
</p>

<p>
    事實上，大部分的 Lravel 的核心元件都有服務應供器。 所有已註冊的服務應供器都列表在 <code>app/config/app.php</code> 中 <code>providers</code> 的陣列中。
</p>

<p>
    建立服務供應器，只要簡單的繼承 <code>Illuminate\Support\ServiceProvider</code>  類別並定義 <code>register</code> 方法:
</p>

<p><strong>定義服務供應器</strong></p>

<pre><code>use Illuminate\Support\ServiceProvider;

class FooServiceProvider extends ServiceProvider {

    public function register()
    {
        $this-&gt;app-&gt;bind('foo', function()
        {
            return new Foo;
        });
    }

}
</code></pre>

<p>
    注意 <code>register</code> 方法中，可以使用 <code>$this-&gt;app</code> 屬性來進行控制反轉容器的綁定。 一旦你已建立供應器並已經準備註冊它，只需要簡單將它加到你 <code>app</code> 設定檔中的 <code>providers</code> 陣列。
</p>

<p>
    在執行階段，你也可以使用 <code>App::register</code> 這個方法來註冊你的服務供應器:
</p>

<p><strong>在執行時候註冊一個服務提供者</strong></p>

<pre><code>App::register('FooServiceProvider');
</code></pre>

<p><a name="container-events"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.ioc.container_events') }}</h2>

<p>
    容器事件是每當控制反轉容器執行分析物件時所觸發。 你能夠透過 <code>resolving</code> 方法監聽這些事件:
</p>

<p><strong>註冊分析監聽器</strong></p>

<pre><code>App::resolving(function($object)
{
    //
});
</code></pre>

<p>
    注意，被分析出來的物件將會被傳至回呼函式中。
</p>
@stop;
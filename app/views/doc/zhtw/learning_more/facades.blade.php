@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.facades') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.learning_more.facades.introduction') }}</a>
    </li>
    <li>
        <a href="#explanation">{{ Lang::get('l4doc.docs_title.learning_more.facades.explanation') }}</a>
    </li>
    <li>
        <a href="#practical-usage">{{ Lang::get('l4doc.docs_title.learning_more.facades.practical_usage') }}</a>
    </li>
    <li>
        <a href="#creating-facades">{{ Lang::get('l4doc.docs_title.learning_more.facades.creating_facades') }}</a>
    </li>
    <li>
        <a href="#mocking-facades">{{ Lang::get('l4doc.docs_title.learning_more.facades.mocking_facades') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.introduction') }}</h2>

<p>
    Facades 提供一個 "靜態" 介面讓類別能夠運用在應用程式的 <a href="../../docs/ioc">{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</a> (Ioc container)。 Laravel 裝載很多 facades，甚至你可能不知不覺已經使用過它們了！
</p>

<p>
    有時候，你也許希望為你的應用程式和套件建立自己的 facades，所以讓我們來探討這些類別的概念、開發和用法。
</p>

<blockquote>
  <p><strong>注意:</strong> 在深入 facades 之前，強烈建議先熟悉了解 Laravel 的 <a href="../../docs/ioc">{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</a>。</p>
</blockquote>

<p><a name="explanation"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.explanation') }}</h2>

<p>
    對 Laravel 應用程式而言，facade 是提供從容器存取物件的一個類別。 能讓這裝置正常運作的原因，正是這些 <code>Facade</code> 類別。 Laravel 的 facades 以及任何你所建立的自訂 facades，都將繼承這個類別來當基礎。
</p>

<p>
    你的 facade 類別只需要實作一個方法 <code>getFacadeAccessor</code> 。 <code>getFacadeAccessor</code> 的工作就是去定義哪些東西要從容器分析出來。 而 <code>Facade</code> 基本類別利用 <code>__callStatic()</code> 神奇方法來從你的 facade 呼叫並分析物件。
</p>

<p><a name="practical-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.practical_usage') }}</h2>

<p>
    下面是一個 Laravel 快取系統呼叫的範例。 從程式碼中粗略來看，假設 <code>Cache</code>  類別的靜態方法 <code>get</code> 正被呼叫。
</p>

<pre><code>$value = Cache::get('key');
</code></pre>

<p>
    然而，如果我們試著看看 <code>Illuminate\Support\Facades\Cache</code> 這個類別，你將會發現它並沒有 <code>get</code> 靜態方法:
</p>

<pre><code>class Cache extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'cache'; }

}
</code></pre>

<p>
    這個 Cache 類別繼承了基本的 <code>Facade</code> 類別，並且定義了 <code>getFacadeAccessor()</code> 方法。 記住，這個方法的工作是用來回傳控制反轉所綁定的名稱。
</p>

<p>
    當一個使用者在 <code>Cache</code> 這個 facade 參照任何靜態方法，Laravel 會從控制反轉容器中分析被綁定的 <code>cache</code> ，並執行被請求的方法(這個案例就是 <code>get</code> )。
</p>

<p>
    所以，我們的 <code>Cache::get</code> 呼叫起來，應該會被覆寫像是:
</p>

<pre><code>$value = $app-&gt;make('cache')-&gt;get('key');
</code></pre>

<p><a name="creating-facades"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.creating_facades') }}</h2>

<p>
    為自己的應用程式或套件建立 facade 是相當簡單的。 你只需要三件事:
</p>

<ul>
    <li>一個控制反轉(Ioc)綁定</li>
    <li>一個 facade 類別</li>
    <li>一個 facade 別名設定</li>
</ul>

<p>
    看看這個範例，這裡我們有一個類別 <code>PaymentGateway\Payment</code> 定義如下。
</p>

<pre><code>namespace PaymentGateway;

class Payment {

    public function process()
    {
        //
    }

}
</code></pre>

<p>
    我們需要能夠從控制反轉容器中分析這個類別。 所以我們進行綁定:
</p>

<pre><code>App::bind('payment', function()
{
    return new \PaymentGateway\Payment;
});
</code></pre>

<p>
    綁定後將會建立一個被命名為 <code>PaymentServiceProvider</code> 新的 <a href="../../docs/ioc#service-providers">{{ Lang::get('l4doc.docs_title.learning_more.ioc.service_providers') }} (service provider) </a> 服務供應器。並追加到 <code>register</code> 方法。 你可以從 <code>app/config/app.php</code> 追加設定讓 Laravel 讀取你的服務供應器。
</p>

<p>接下來，我們建立自己的 facade 類別:</p>

<pre><code>use Illuminate\Support\Facades\Facade;

class Payment extends Facade {

    protected static function getFacadeAccessor() { return 'payment'; }

}
</code></pre>

<p>
    最後，如果我們想要的話，可以從 <code>app/config/app.php</code> 的設定檔追加 facade 別名到 <code>aliases</code> 陣列中。 現在，我們能夠從 <code>Payment</code> 實例來呼叫 <code>process</code> 方法。
</p>

<pre><code>Payment::process();
</code></pre>

<p><a name="mocking-facades"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.facades.mocking_facades') }}</h2>

<p>
    單元測試是為什麼要使用 facades 來作業的重要一環。 事實上，可測試性甚至是 facades 存在的主要理由。 更多資訊可參考 <a href="../../docs/testing#service-providers">{{ Lang::get('l4doc.docs_title.learning_more.testing.mocking_facades') }} (mocking facades)</a> 這篇章節。
</p>
@stop;
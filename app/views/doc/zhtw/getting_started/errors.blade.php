@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.errors') }}</h1>

<ul>
    <li>
        <a href="#error-detail">{{ Lang::get('l4doc.docs_title.getting_started.errors.error_detail') }}</a>
    </li>
    <li>
        <a href="#handling-errors">{{ Lang::get('l4doc.docs_title.getting_started.errors.handling_errors') }}</a>
    </li>
    <li>
        <a href="#http-exceptions">{{ Lang::get('l4doc.docs_title.getting_started.errors.http_exceptions') }}</a>
    </li>
    <li>
        <a href="#handling-404-errors">{{ Lang::get('l4doc.docs_title.getting_started.errors.handling_404_errors') }}</a>
    </li>
    <li>
        <a href="#logging">{{ Lang::get('l4doc.docs_title.getting_started.errors.logging') }}</a>
    </li>
</ul>

<p><a name="error-detail"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.error_detail') }}</h2>

<p>
    Laravel 預設會開啟錯誤訊息顯示，所以在發生錯誤時，將會在錯誤頁面顯示詳細的錯誤訊息，你可以在 <code>app/config/app.php</code> 檔案中，藉由將 <code>debug</code> 選項設定為 <code>false</code>，即可關掉這些錯誤顯示，<strong>強烈建議你在產品的環境中做這樣的設定</strong>。
</p>

<p><a name="handling-errors"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.handling_errors') }}</h2>

<p>
    預設的情況下，<code>app/start/global.php</code> 檔案中，包含了所有例外狀況的處理程序:
</p>

<pre><code>App::error(function(Exception $exception)
{
    Log::error($exception);
});
</code></pre>

<p>
    這個是最基本的例外處理程序，然而，如果可以的話，你可能想要定義更多的自訂的例外處理程序，處理程序是根據他們所需要處理的例外類型提示 (type-hint) 而被呼叫的，舉例來說，你可以建立一個只有處理 <code>RuntimeException</code> 例外狀況的處理程序:
</p>

<pre><code>App::error(function(RuntimeException $exception)
{
    // Handle the exception...
});
</code></pre>

<p>
    假如例外處理程序回傳一個回應，則此回應將會傳送給瀏覽器，而沒有其他任何的例外處理程序會被呼叫:
</p>

<pre><code>App::error(function(InvalidUserException $exception)
{
    Log::error($exception);

    return 'Sorry! Something is wrong with this account!';
});
</code></pre>

<p>
    你可以使用 <code>App::fatal</code> 的方法，去擷取 PHP fatal errors 錯誤事件:
</p>

<pre><code>App::fatal(function($exception)
{
    //
});
</code></pre>

<p><a name="http-exceptions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.http_exceptions') }}</h2>

<p>
    在 HTTP 的例外情形，可參考用戶端請求時可能發生的錯誤情況，可能是沒有找到頁面的錯誤 (404)，未授權的錯誤 (401)，甚至是產生 500 錯誤的情況，你可以使用下列方式回傳這樣的錯誤回應:
</p>

<pre><code>App::abort(404, 'Page not found');
</code></pre>

<p>
    第一個參數是 HTTP 的狀態碼，而後面是你想顯示的自訂錯誤訊息。
</p>

<p>
    你可以使用下列方法，產生 401  未授權的錯誤:
</p>

<pre><code>App::abort(401, 'You are not authorized.');
</code></pre>

<p>
    這些例外狀況可以在任何請求的生命週期中被執行。
</p>

<p><a name="handling-404-errors"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.handling_404_errors') }}</h2>

<p>
    你可以在應用程式註冊一個錯誤處理程序處理所有 "404 沒有找到頁面" 的錯誤情況，允許你產生一個自訂的 404 錯誤頁面:
</p>

<pre><code>App::missing(function($exception)
{
    return Response::view('errors.missing', array(), 404);
});
</code></pre>

<p><a name="logging"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.errors.logging') }}</h2>

<p>
    Laravel 的記錄功能，提供一個簡單強大的 <a href="http://github.com/seldaek/monolog">Monolog</a>，預設的情況下，Laravel 會被設定去產生每天的紀錄檔，並將記錄檔存放在 <code>app/storage/logs</code> 目錄中，你也可以些一些資訊到這些紀錄檔中，就像:
</p>

<pre><code>Log::info('This is some useful information.');

Log::warning('Something could be going wrong.');

Log::error('Something is really going wrong.');
</code></pre>

<p>
    紀錄器提供七種在 <a href="http://tools.ietf.org/html/rfc5424">RFC 5424</a> 定義的紀錄級別 : <strong>debug</strong>, <strong>info</strong> 、 <strong>notice</strong> 、 <strong>warning</strong> 、 <strong>error</strong> 、 <strong>critical</strong> 及 <strong>alert</strong>
</p>

<p>
    Monolog 有數種你可以使用的額外的處理程序，如果需要，你可以在 Laravel 存取 Monolog 底層的實例資源:
</p>

<pre><code>$monolog = Log::getMonolog();
</code></pre>

<p>
    你也可以註冊一個事件，去擷取所有訊息並傳送訊息到紀錄裡:
</p>

<p><strong>註冊一個紀錄傾聽器</strong></p>

<pre><code>Log::listen(function($level, $message, $context)
{
    //
});
</code></pre>
@stop;
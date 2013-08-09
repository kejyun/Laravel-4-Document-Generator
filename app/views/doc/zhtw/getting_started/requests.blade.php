@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.requests') }}</h1>

<ul>
    <li>
        <a href="#basic-input">{{ Lang::get('l4doc.docs_title.getting_started.requests.basic_input') }}</a>
    </li>
    <li>
        <a href="#cookies">{{ Lang::get('l4doc.docs_title.getting_started.requests.cookies') }}</a>
    </li>
    <li>
        <a href="#old-input">{{ Lang::get('l4doc.docs_title.getting_started.requests.old_input') }}</a>
    </li>
    <li>
        <a href="#files">{{ Lang::get('l4doc.docs_title.getting_started.requests.files') }}</a>
    </li>
    <li>
        <a href="#request-information">{{ Lang::get('l4doc.docs_title.getting_started.requests.request_information') }}</a>
    </li>
</ul>

<p><a name="basic-input"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.basic_input') }}</h2>

<p>
    你可以透過很簡單的方式，去存取到所有使用者輸入的資料，你不需要擔心任何不同的 HTTP 存取方法 (GET、POST、PUT、DELETE)，只要透過 Input 就可以存取到不同 HTTP 存取方法的資料了。
</p>

<p><strong>取得使用者傳入的資料</strong></p>

<pre><code>$name = Input::get('name');
</code></pre>

<p><strong>取不到使用者傳入的資料時，設定資料的預設值</strong></p>

<pre><code>$name = Input::get('name', 'Sally');
</code></pre>

<p><strong>判斷使用者傳入的資料是否存在</strong></p>

<pre><code>if (Input::has('name'))
{
    //
}
</code></pre>

<p><strong>取得所有使用者傳入任何 HTTP 請求的資料</strong></p>

<pre><code>$input = Input::all();
</code></pre>

<p><strong>取得使用者輸入的部分資料</strong></p>

<pre><code>$input = Input::only('username', 'password');

$input = Input::except('credit_card');
</code></pre>

<p>
    某些 JavaScript 的函式庫會傳給應用程式 JSON 格式的資料，如 Backbone，你也可以透過 <code>Input::get</code> 去存取這些資料。
</p>

<p><a name="cookies"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.cookies') }}</h2>

<p>
    在 Laravel 中的所有 cookies 資料都會被一個驗證碼經過加密，意思是如果 cookies 在 client 端被修改變更後，Laravel 會認為這個是不合法的 cookies。
</p>

<p><strong>取得 Cookie 資料</strong></p>

<pre><code>$value = Cookie::get('name');
</code></pre>

<p><strong>在回應資料中加入 Cookie 資料</strong></p>

<pre><code>$response = Response::make('Hello World');

$response-&gt;withCookie(Cookie::make('name', 'value', $minutes));
</code></pre>

<p><strong>建立一個永遠不會失效的 Cookie</strong></p>

<pre><code>$cookie = Cookie::forever('name', 'value');
</code></pre>

<p><a name="old-input"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.old_input') }}</h2>

<p>
    你或許在使用者做下一次的請求之前，需要保存使用者輸入過的資訊，舉例來說，你在使用者輸入資料後，對資料檢查時發現有誤時，在顯示資料的錯誤訊息外，你可能需要重新顯示使用者先前輸入過的資料。
</p>


<p><strong>將使用者輸入的資料存入 Session</strong></p>

<pre><code>Input::flash();
</code></pre>

<p><strong>將使用者輸入的部分資料存入 Session</strong></p>

<pre><code>Input::flashOnly('username', 'email');

Input::flashExcept('password');
</code></pre>

<p>
    因為你可能需要在將使用者導回先前的頁面時，順便帶有使用者先前輸入過的資料，你可以透過簡單的 chain 的方式在先前的頁面使用這些資料。
</p>

<pre><code>return Redirect::to('form')-&gt;withInput();

return Redirect::to('form')-&gt;withInput(Input::except('password'));
</code></pre>

<blockquote>
  <p><strong>備註:</strong> 你可以使用 <a href="../../docs/session">{{ Lang::get('l4doc.layout.docs_menu.session') }}</a> 去存取在不同的請求中的資料</p>
</blockquote>

<p><strong>取得舊的資料</strong></p>

<pre><code>Input::old('username');
</code></pre>

<p><a name="files"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.files') }}</h2>

<p><strong>取得上傳的資料</strong></p>

<pre><code>$file = Input::file('photo');
</code></pre>

<p><strong>判斷檔案是否已完成上傳</strong></p>

<pre><code>if (Input::hasFile('photo'))
{
    //
}
</code></pre>

<p>
    <code>file</code> 方法回傳的物件是 <code>Symfony\Component\HttpFoundation\File\UploadedFile</code> 類別的實例，引用了 PHP <code>SplFileInfo</code> 類別去提供不同的方法去存取檔案。
</p>

<p><strong>移動上傳的檔案</strong></p>

<pre><code>Input::file('photo')-&gt;move($destinationPath);

Input::file('photo')-&gt;move($destinationPath, $fileName);
</code></pre>

<p><strong>取得上傳檔案的路徑</strong></p>

<pre><code>$path = Input::file('photo')-&gt;getRealPath();
</code></pre>

<p><strong>取得上傳檔案的大小</strong></p>

<pre><code>$size = Input::file('photo')-&gt;getSize();
</code></pre>

<p><strong>取得上傳檔案的 MIME 類型</strong></p>

<pre><code>$mime = Input::file('photo')-&gt;getMimeType();
</code></pre>

<p><a name="request-information"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.request_information') }}</h2>

<p>
    <code>Request</code> 類別提供許多的方法去檢查 HTTP 請求，並引用了 <code>Symfony\Component\HttpFoundation\Request</code> 類別，這裡有一些相關重點整理。
</p>

<p><strong>取得請求的 URI</strong></p>

<pre><code>$uri = Request::path();
</code></pre>

<p><strong>判斷請求是否符合指定的模式</strong></p>

<pre><code>if (Request::is('admin/*'))
{
    //
}
</code></pre>

<p><strong>取得請求 URL</strong></p>

<pre><code>$url = Request::url();
</code></pre>

<p><strong>取得請求 URI 的片段</strong></p>

<pre><code>$segment = Request::segment(1);
</code></pre>

<p><strong>取得請求標頭</strong></p>

<pre><code>$value = Request::header('Content-Type');
</code></pre>

<p><strong>從 $_SERVER 取得資料</strong></p>

<pre><code>$value = Request::server('PATH_INFO');
</code></pre>

<p><strong>判斷是否使用 AJAX 去請求資料</strong></p>

<pre><code>if (Request::ajax())
{
    //
}
</code></pre>

<p><strong>判斷是否透過 HTTPS 去請求資料</strong></p>

<pre><code>if (Request::secure())
{
    //
}
</code></pre>
@stop;
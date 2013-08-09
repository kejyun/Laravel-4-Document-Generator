@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.html') }}</h1>

<ul>
  <li>
    <a href="#opening-a-form">{{ Lang::get('l4doc.docs_title.learning_more.html.opening_a_form') }}</a>
  </li>
  <li>
    <a href="#csrf-protection">{{ Lang::get('l4doc.docs_title.learning_more.html.csrf_protection') }}</a>
  </li>
  <li>
    <a href="#form-model-binding">{{ Lang::get('l4doc.docs_title.learning_more.html.form_model_binding') }}</a>
  </li>
  <li>
    <a href="#labels">{{ Lang::get('l4doc.docs_title.learning_more.html.labels') }}</a>
  </li>
  <li>
    <a href="#text">{{ Lang::get('l4doc.docs_title.learning_more.html.text') }}</a>
  </li>
  <li><a href="#checkboxes-and-radio-buttons">{{ Lang::get('l4doc.docs_title.learning_more.html.checkboxes_and_radio_buttons') }}</a>
  </li>
  <li>
    <a href="#file-input">{{ Lang::get('l4doc.docs_title.learning_more.html.file_input') }}</a>
  </li>
  <li>
    <a href="#drop-down-lists">{{ Lang::get('l4doc.docs_title.learning_more.html.drop_down_lists') }}</a>
  </li>
  <li>
    <a href="#buttons">{{ Lang::get('l4doc.docs_title.learning_more.html.buttons') }}</a>
  </li>
  <li>
    <a href="#custom-macros">{{ Lang::get('l4doc.docs_title.learning_more.html.custom_macros') }}</a>
  </li>
</ul>

<p><a name="opening-a-form"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.opening_a_form') }}</h2>

<p><strong>開啟表單</strong></p>

<pre><code>({)({) Form::open(array('url' =&gt; 'foo/bar')) (})(})
    //
({)({) Form::close() (})(})
</code></pre>

<p>
  預設表單使用 <code>POST</code> 方法，當然你也可以指定其他傳送表單的方法:
</p>

<pre><code>echo Form::open(array('url' =&gt; 'foo/bar', 'method' =&gt; 'put'))
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 因為 HTML表單只支援 <code>POST</code> 方法，所以在使用 <code>PUT</code> 及 <code>DELETE</code> 的方法時，Laravel將會自動加入隱藏的  <code>_method</code> 欄位到表單中，來偽裝表單傳送的方法。</p>
</blockquote>

<p>
  你也可以建立一個指向命名的路由或控制器至表單:
</p>

<pre><code>echo Form::open(array('route' =&gt; 'route.name'))

echo Form::open(array('action' =&gt; 'Controller@method'))
</code></pre>

<p>
  如果你的表單允許上傳檔案，可以加入 <code>files</code> 選項到參數中:
</p>

<pre><code>echo Form::open(array('url' =&gt; 'foo/bar', 'files' =&gt; true))
</code></pre>

<p><a name="csrf-protection"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.csrf_protection') }}</h2>

<p>
  Laravel 提供簡易的方法，讓你可以保護你的應用程式不受到 CSRF (跨網站請求偽造) 攻擊，首先 Laravel 會自動在使用者的 session 中放置一個隨機的標記，這個 CSRF 參數會用隱藏欄位的方式自動加到你的表單中，你也可以使用 <code>token</code> 的方法去產生這個隱藏的 CSRF 標記欄位:
</p>

<p><strong>加入 CSRF 標記到表單</strong></p>

<pre><code>echo Form::token();
</code></pre>

<p>
  <strong>加入 CSRF 標記到路由中</strong>
</p>

<pre><code>Route::post('profile', array('before' =&gt; 'csrf', function()
{
    //
}));
</code></pre>

<p><a name="form-model-binding"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.form_model_binding') }}</h2>

<p>
  你可以使用 <code>Form::model</code> 的方法，將模型 (model) 中的內容加入到表單中:
</p>

<p><strong>開啟模型表單</strong></p>

<pre><code>echo Form::model($user, array('route' =&gt; array('user.update', $user-&gt;id)))
</code></pre>

<p>
  當你產生表單元素時，像是 text 欄位，模型的值將會自動比對到欄位名稱，並設定此欄位值，舉例來說，使用者模組的 <code>email</code> 屬性，將會設定到名稱為 <code>email</code> 的 text 欄位的欄位值，不僅如此，當 Session 中有與欄位名稱相符的名稱， Session 的值將會優先於模型的值，而優先順序如下所示:
</p>

<ol>
  <li>Session 的資料 (舊的輸入值)</li>
  <li>明確傳遞的資料</li>
  <li>模組屬性資料</li>
</ol>

<p>
  這樣可以快速地建立表單，不僅是綁定模組資料，也可以在伺服器端資料驗證錯誤時，輕鬆的回填使用者輸入的舊資料!
</p>

<blockquote>
  <p><strong>注意:</strong> 當使用 <code>Form::model</code> 方法時，必須確保有使用 <code>Form::close</code> 方法去關閉表單!</p>
</blockquote>

<p><a name="labels"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.labels') }}</h2>

<p><strong>產生標籤 (Label) 元素</strong></p>

<pre><code>echo Form::label('email', 'E-Mail Address');
</code></pre>

<p><strong>指定額外的 HTML 屬性</strong></p>

<pre><code>echo Form::label('email', 'E-Mail Address', array('class' =&gt; 'awesome'));
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 在建立標籤時，任何你建立的表單元素名稱與標籤相符時，將會自動在 ID 屬性建立與標籤名稱相同的 ID</p>
</blockquote>

<p><a name="text"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.text') }}</h2>

<p><strong>產生 Text 輸入欄位</strong></p>

<pre><code>echo Form::text('username');
</code></pre>

<p><strong>指定預設值</strong></p>

<pre><code>echo Form::text('email', 'example@gmail.com');
</code></pre>

<blockquote>
  <p><strong>注意:</strong> <em>hidden</em> 及 <em>textarea</em> 方法與 <em>text</em> 使用屬性參數是相同的</p>
</blockquote>

<p><strong>產生 Password 輸入欄位</strong></p>

<pre><code>echo Form::password('password');
</code></pre>

<p><a name="checkboxes-and-radio-buttons"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.checkboxes_and_radio_buttons') }}</h2>

<p><strong>產生 Checkbox 或 Radio 輸入欄位</strong></p>

<pre><code>echo Form::checkbox('name', 'value');

echo Form::radio('name', 'value');
</code></pre>

<p><strong>產生已被選擇的 Checkbox 或 Radio 輸入欄位</strong></p>

<pre><code>echo Form::checkbox('name', 'value', true);

echo Form::radio('name', 'value', true);
</code></pre>

<p><a name="file-input"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.file_input') }}</h2>

<p><strong>產生 File 輸入欄位</strong></p>

<pre><code>echo Form::file('image');
</code></pre>

<p><a name="drop-down-lists"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.drop_down_lists') }}</h2>

<p><strong>產生下拉選單</strong></p>

<pre><code>echo Form::select('size', array('L' =&gt; 'Large', 'S' =&gt; 'Small'));
</code></pre>

<p><strong>產生選擇預設值的下拉選單</strong></p>

<pre><code>echo Form::select('size', array('L' =&gt; 'Large', 'S' =&gt; 'Small'), 'S');
</code></pre>

<p><strong>產生群組清單</strong></p>

<pre><code>echo Form::select('animal', array(
    'Cats' =&gt; array('leopard' =&gt; 'Leopard'),
    'Dogs' =&gt; array('spaniel' =&gt; 'Spaniel'),
));
</code></pre>

<p><a name="buttons"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.buttons') }}</h2>

<p><strong>產生 Submit 輸入欄位</strong></p>

<pre><code>echo Form::submit('Click Me!');
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 需要產生 Button 元素嗎? 可以試著使用  <em>button</em> 方法去產生 Button元素，<em>button</em> 方法與 <em>submit</em> 使用屬性參數是相同的</p>
</blockquote>

<p><a name="custom-macros"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.custom_macros') }}</h2>

<p>
  你可以輕鬆的定義你自己的表單類別 Helper 叫 "巨集 (macros)"，首先只要註冊 巨集 ，並給預期名稱及封閉函式，以下是巨集的使用範例:
</p>

<p><strong>註冊表單巨集</strong></p>

<pre><code>Form::macro('myField', function()
{
    return '&lt;input type="awesome"&gt;';
});
</code></pre>

<p>使用 macro 註冊名稱呼叫你的自訂方法:</p>

<p><strong>呼叫自訂表單巨集</strong></p>

<pre><code>echo Form::myField();
</code></pre>
@stop;
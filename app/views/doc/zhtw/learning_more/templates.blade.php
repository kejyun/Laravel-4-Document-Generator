@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.templates') }}</h1>

<ul>
    <li>
        <a href="#controller-layouts">{{ Lang::get('l4doc.docs_title.learning_more.templates.controller_layouts') }}</a>
    </li>
    <li>
        <a href="#blade-templating">{{ Lang::get('l4doc.docs_title.learning_more.templates.blade_templating') }}</a>
    </li>
    <li>
        <a href="#other-blade-control-structures">{{ Lang::get('l4doc.docs_title.learning_more.templates.other_blade_control_structures') }}</a>
    </li>
</ul>

<p><a name="controller-layouts"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.templates.controller_layouts') }}</h2>

<p>
    Laravel 其中一個使用樣板的方法是透過 "控制器 (Controller)" 的 layout，藉由設定在控制器的 <code>layout</code> 屬性值，指定特定的視圖作為預設回傳的回應資料。
</p>

<p><strong>在控制器定義 Layout</strong></p>

<pre><code>class UserController extends BaseController {

    /**
     * layout會被用在請求回應中
     */
    protected $layout = 'layouts.master';

    /**
     * 顯示使用者個人檔案
     */
    public function showProfile()
    {
        $this-&gt;layout-&gt;content = View::make('user.profile');
    }

}
</code></pre>

<p><a name="blade-templating"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.templates.blade_templating') }}</h2>

<p>
    Blade 是 Laravel 提供的一個簡單且強大的樣板引擎，不同於控制的 Layout，Blade是透過 <em>樣板繼承 (template inheritance)</em> 及 <em>區段 (sections)</em> 去驅動的，所有的 Blade 樣板需使用 <code>.blade.php</code> 作為附檔名。
</p>

<p><strong>定義 Blade Layout</strong></p>

<pre><code>&lt;!-- Stored in app/views/layouts/master.blade.php --&gt;

&lt;html&gt;
    &lt;body&gt;
        (@)section('sidebar')
            這是主要的 sidebar.
        (@)show

        &lt;div class="container"&gt;
            (@)yield('content')
        &lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;
</code></pre>

<p><strong>使用 Blade Layout</strong></p>

<pre><code>(@)extends('layouts.master')

(@)section('sidebar')
    (@)parent

    &lt;p&gt;這段會被加到 layouts.master 的 sidebar中&lt;/p&gt;
(@)stop

(@)section('content')
    &lt;p&gt;這裡是我的內文。&lt;/p&gt;
(@)stop
</code></pre>

<p>
    注意到視圖僅僅覆寫 <code>繼承 (extend)</code> Blade 樣板的 layout 的區段資料 (section)，Layout 的內容可以使用 <code>(@)parent</code> 方法被引用到子視圖區段中，允許你附加 layout 區段資料的內文，像是 sidebar 或是 footer。
</p>

<p><a name="other-blade-control-structures"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.templates.other_blade_control_structures') }}</h2>

<p><strong>列印資料</strong></p>

<pre><code>Hello, ({)({) $name (})(}).

現在的 UNIX 時間戳記是 ({)({) time() (})(}).
</code></pre>

<p>
    你可以使用三個大括弧去跳脫輸出的資料:
</p>

<pre><code>Hello, ({)({)({) $name (})(})(}).
</code></pre>

<p><strong>If 陳述式</strong></p>

<pre><code>(@)if (count($records) === 1)
    有一筆資料
(@)elseif (count($records) &gt; 1)
    有多筆資料
(@)else
    沒有任何資料
(@)endif

(@)unless (Auth::check())
    你尚未登入
(@)endunless
</code></pre>

<p><strong>Loops</strong></p>

<pre><code>(@)for ($i = 0; $i &lt; 10; $i++)
    現在的值是 ({)({) $i (})(})
(@)endfor

(@)foreach ($users as $user)
    &lt;p&gt;這是使用者 ({)({) $user-&gt;id (})(})&lt;/p&gt;
(@)endforeach

(@)while (true)
    &lt;p&gt;我是無限迴圈&lt;/p&gt;
(@)endwhile
</code></pre>

<p><strong>包含子視圖</strong></p>

<pre><code>(@)include('view.name')
</code></pre>

<p><strong>顯示語言資訊</strong></p>

<pre><code>(@)lang('language.line')

(@)choice('language.line', 1);
</code></pre>

<p><strong>註解</strong></p>

<pre><code>({)({)-- 這個註解將不會產生 HTML 去顯示 --(})(})
</code></pre>
@stop;
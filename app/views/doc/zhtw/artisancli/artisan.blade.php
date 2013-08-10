@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.artisan') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.artisancli.artisan.introduction') }}</a>
    </li>
    <li>
        <a href="#usage">{{ Lang::get('l4doc.docs_title.artisancli.artisan.usage') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.artisan.introduction') }}</h2>

<p>
    Artisan 是 Laravel 命令列的介面名稱，提供數個有用的指令，讓你方便開發應用程式，他是由強大的 Symfony Console 元素所驅動。
</p>

<p><a name="usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.artisan.usage') }}</h2>

<p>
    你可以使用 <code>list</code> 命令去檢視所有可用的 Artisan 指令:
</p>

<p><strong>列出所有可用的指令</strong></p>

<pre><code>php artisan list
</code></pre>

<p>
    每個指令都包含了 "help" 指令，可以顯示且描述指令可用的參數及選項，為了檢視 "幫助" 畫面，只要在指令名稱前加上 <code>help</code> 即可:
</p>

<p><strong>檢視指令的 "幫助" 畫面</strong></p>

<pre><code>php artisan help migrate
</code></pre>

<p>
    你可以在執行指令時使用 <code>--env</code> 參數，指定設定的環境:
</p>

<p><strong>指定設定的環境</strong></p>

<pre><code>php artisan migrate --env=local
</code></pre>

<p>
    你也可以使用 <code>--version</code> 選項，檢視目前 Laravel 安裝的版本:
</p>

<p><strong>檢視目前你使用的 Laravel 版本</strong></p>

<pre><code>php artisan --version
</code></pre>
@stop;
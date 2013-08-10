@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.localization') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.learning_more.localization.introduction') }}</a>
    </li>
    <li>
        <a href="#language-files">{{ Lang::get('l4doc.docs_title.learning_more.localization.language_files') }}</a>
    </li>
    <li>
        <a href="#basic-usage">{{ Lang::get('l4doc.docs_title.learning_more.localization.basic_usage') }}</a>
    </li>
    <li>
        <a href="#pluralization">{{ Lang::get('l4doc.docs_title.learning_more.localization.pluralization') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.localization.introduction') }}</h2>

<p>
    Laravel 的 <code>Lang</code> 類別提供一個很方便的方式可以用來存取不同類型的語言，讓你的應用程式可以很容易的支援多國語言。
</p>

<p><a name="language-files"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.localization.language_files') }}</h2>

<p>
    語言資訊存放在 <code>app/lang</code> 資料夾中，在這個資料夾中會放置你應用程式所支援各種不同語言的子資料夾。
</p>

<pre><code>/app
    /lang
        /en
            messages.php
        /es
            messages.php
</code></pre>

<p>
    語言檔指回傳陣列的字串值，例如:
</p>

<p><strong>語言檔範例</strong></p>

<pre><code>&lt;?php

return array(
    'welcome' =&gt; '歡迎到我的應用程式'
);
</code></pre>

<p>
    應用程序默認語言配置在app/config/app.php配置文件中locale配置項.你可以在任何時候使用App::setLocale方法來改變當前激活語言。

    預設的語言設定存放在 <code>app/config/app.php</code> 檔案中，你可以隨時使用 <code>App::setLocale</code> 方法去變更目前要使用的語言:
</p>

<p><strong>執行時變更預設語言</strong></p>

<pre><code>App::setLocale('es');
</code></pre>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.localization.basic_usage') }}</h2>

<p><strong>從語言檔中取得資料</strong></p>

<pre><code>echo Lang::get('messages.welcome');
</code></pre>

<p>
    第一個傳送給 <code>get</code> 方法的參數是語言檔的檔案名稱，而第二個名稱是要取得字串的鍵值名稱。
</p>

<blockquote>
  <p><strong>注意</strong>: 假如要取得的語言資料不存在，則 <code>get</code> 方法會回傳原鍵值名稱。</p>
</blockquote>

<p><strong>取代語言檔字串</strong></p>

<p>
    你也可以在語言檔中定義 位置標誌符 (place-holders):
</p>

<pre><code>'welcome' =&gt; 'Welcome, :name',
</code></pre>

<p>
    然後傳遞第二個參數給 <code>Lang::get</code> 方法，去取代設定的 位置標誌符 (place-holders):
</p>

<pre><code>echo Lang::get('messages.welcome', array('name' =&gt; 'Dayle'));
</code></pre>

<p><strong>判斷語言資訊是否存在</strong></p>

<pre><code>if (Lang::has('messages.welcome'))
{
    //
}
</code></pre>

<p><a name="pluralization"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.localization.pluralization') }}</h2>

<p>
    複數形式是一個複雜的問題，因為不同的語言有著不同的複數形式規則。你可以通過簡單的在語言文件中使用”管道“符來分開單數和復數文本形式：

    複數是一個很複雜的問題，不同的語言有不同且複雜的複數型態規則，你可以藉由使用"管線 (pipe)"字元，簡單的去區別單數與複數的字串格式:
</p>

<pre><code>'apples' =&gt; 'There is one apple|There are many apples',
</code></pre>

<p>然後你可以使用 <code>Lang::choice</code> 方法去取得有複數型態的語言資訊:</p>

<pre><code>echo Lang::choice('messages.apples', 10);
</code></pre>

<p>
    由於 Laravel 翻譯器是用強大的 Symfony 翻譯原件，你也可以容易的建立更多複雜的複數規則:
</p>

<pre><code>'apples' =&gt; '{0} There are none|[1,19] There are some|[20,Inf] There are many',
</code></pre>
@stop;
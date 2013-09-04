@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.commands') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.artisancli.commands.introduction') }}</a>
    </li>
    <li>
        <a href="#building-a-command">{{ Lang::get('l4doc.docs_title.artisancli.commands.building_a_command') }}</a>
    </li>
    <li>
        <a href="#registering-commands">{{ Lang::get('l4doc.docs_title.artisancli.commands.registering_commands') }}</a>
    </li>
    <li>
        <a href="#calling-other-commands">{{ Lang::get('l4doc.docs_title.artisancli.commands.calling_other_commands') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.commands.introduction') }}</h2>

<p>
    除了 Artisan 提供的指令外，你也可以在你的應用程式中建立自訂的 Artisan 指令，你可以將你的自訂指令存放在 <code>app/commands</code> 目錄中，然而，只要 <code>composer.json</code> 檔案中的 "自動載入 (autoload)" 的部分有設定好，你也可以依照你的喜好放置自訂指令到不同的目錄下。
</p>

<p><a name="building-a-command"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.commands.building_a_command') }}</h2>

<h3>產生類別</h3>

<p>
    你可以在 Artisan 指令中使用 <code>command:make</code> 指令，讓你可以產生製作新指令的初始程式框架:
</p>

<p><strong>產生新的 Artisan 指令類別</strong></p>

<pre><code>php artisan command:make FooCommand
</code></pre>

<p>
    預設產生的 Artisan 指令類別檔案會存放在 <code>app/commands</code> 目錄下，你也可以指定自訂的 "路徑 (path)" 或 "命名空間 (namespace)":
</p>

<pre><code>php artisan command:make FooCommand --path="app/classes" --namespace="Classes"
</code></pre>

<h3>撰寫 Artisan 指令</h3>

<p>
    在 Artisan 命令類別寫好後，你應該要替類別加上 <code>name</code> 及 <code>description</code> 屬性，這些屬性資訊會在 <code>命令清單 (list)</code> 畫面中顯示。
</p>

<p>
    <code>fire</code> 方法會在執行命令後被呼叫執行，你可以在 <code>fire</code> 方法中撰寫任何的指令處理邏輯。
</p>

<h3>參數 &amp; 選項</h3>

<p>
    可以透過 <code>getArguments</code> 及 <code>getOptions</code> 方法去取得任何你自訂的參數及選項，這兩個方法皆會回傳在 <code>命令清單 (list)</code> 畫面中顯示指令的陣列資料。
</p>

<p>
    在定義 <code>參數 (arguments)</code> 時，定義參數值的陣列資料會呈現如下所示:
</p>

<pre><code>array($name, $mode, $description, $defaultValue)
</code></pre>

<p>
    參數 <code>mode</code> 可以是 <code>InputArgument::REQUIRED</code> 或 <code>InputArgument::OPTIONAL</code> 中的其中任何一個。
</p>

<p>
    在定義 <code>選項 (options)</code> 時，定義選項值的陣列資料會呈現如下所示:
</p>

<pre><code>array($name, $shortcut, $mode, $description, $defaultValue)
</code></pre>

<p>
    對於 "選項 (options)" 來說，參數 <code>mode</code> 可以是 <code>InputOption::VALUE_REQUIRED</code> 、 <code>InputOption::VALUE_OPTIONAL</code> 、 <code>InputOption::VALUE_IS_ARRAY</code> 或 <code>InputOption::VALUE_NONE</code> 中的其中任何一個。
</p>

<p>
    <code>VALUE_IS_ARRAY</code> 模式指的是，在呼叫指令時，該選項數值可以傳入多次:
</p>

<pre><code>php artisan foo --option=bar --option=baz
</code></pre>

<p>
    <code>VALUE_NONE</code> 模式指的是該選項僅用來做 "切換 (switch)" 使用，不帶任何資料:
</p>

<pre><code>php artisan foo --option
</code></pre>

<h3>取得輸入的資料</h3>

<p>
    當指令執行時，你的應用程式想必一定需要去接收參數及選項，你可以使用 <code>argument</code> 及 <code>option</code> 方法去接收參數及選項的資料:
</p>

<p><strong>取得命令中指定的參數值</strong></p>

<pre><code>$value = $this-&gt;argument('name');
</code></pre>

<p><strong>取得所有參數值</strong></p>

<pre><code>$arguments = $this-&gt;argument();
</code></pre>

<p><strong>取得命令中指定的選項值</strong></p>

<pre><code>$value = $this-&gt;option('name');
</code></pre>

<p><strong>取得所有選項值</strong></p>

<pre><code>$options = $this-&gt;option();
</code></pre>

<h3>撰寫輸出</h3>

<p>
    你可以使用 <code>info</code> 、 <code>comment</code> 、 <code>question</code> 及 <code>error</code> 方法去輸出資料到命令列 (console)，這些方法會使用符合其用途的 ANSI 顏色的字做輸出。
</p>

<p><strong>傳送 "資訊 (info)" 到命令列</strong></p>

<pre><code>$this-&gt;info('Display this on the screen');
</code></pre>

<p><strong>傳送 "錯誤 (error)" 訊息到命令列</strong></p>

<pre><code>$this-&gt;error('Something went wrong!');
</code></pre>

<h3>詢問問題</h3>

<p>
    你可以使用 <code>ask</code> 及 <code>confirm</code> 方法去提示使用者輸入資料:
</p>

<p><strong>詢問使用者請求輸入資料</strong></p>

<pre><code>$name = $this-&gt;ask('What is your name?');
</code></pre>

<p><strong>詢問使用者請求輸入隱藏資料</strong></p>

<pre><code>$password = $this-&gt;secret('What is the password?');
</code></pre>

<p><strong>詢問使用者做資訊確認</strong></p>

<pre><code>if ($this-&gt;confirm('Do you wish to continue? [yes|no]'))
{
    //
}
</code></pre>

<p>
    你也可以指定預設值到 <code>confirm</code> 方法中，預設值必須為 <code>true</code> 或 <code>false</code>:
</p>

<pre><code>$this-&gt;confirm($question, true);
</code></pre>

<p><a name="registering-commands"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.commands.registering_commands') }}</h2>

<p>
    在你完成自訂 Artisan 指令後，你需要使用 Artisan 指令進行指令的註冊，這樣才能被使用，這個通常是在 <code>app/start/artisan.php</code> 檔案中完成，在這個檔案中，你可以使用 <code>Artisan::add</code> 方法去註冊指令:
</p>

<p><strong>註冊 Artisan 指令</strong></p>

<pre><code>Artisan::add(new CustomCommand);
</code></pre>

<p>
    如果你的命令是在應用程式中的 <a href="../../docs/ioc">{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</a> 中註冊，你可以使用 <code>Artisan::resolve</code> 方法，讓 Artisan 可以使用該方法:
</p>

<p><strong>註冊在 IoC 容器的指令</strong></p>

<pre><code>Artisan::resolve('binding.name');
</code></pre>

<p><a name="calling-other-commands"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.commands.calling_other_commands') }}</h2>

<p>
    有時你可能會需要呼叫其他的指令，你可以使用 <code>call</code> 方法去呼叫執行其他的指令:
</p>

<p><strong>呼叫其他指令</strong></p>

<pre><code>$this-&gt;call('command.name', array('argument' =&gt; 'foo', '--option' =&gt; 'bar'));
</code></pre>
@stop;
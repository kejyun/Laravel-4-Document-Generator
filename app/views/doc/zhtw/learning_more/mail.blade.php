@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.mail') }}</h1>

<ul>
    <li>
        <a href="#configuration">{{ Lang::get('l4doc.docs_title.learning_more.mail.configuration') }}</a>
    </li>
    <li>
        <a href="#basic-usage">{{ Lang::get('l4doc.docs_title.learning_more.mail.basic_usage') }}</a>
    </li>
    <li>
        <a href="#embedding-inline-attachments">{{ Lang::get('l4doc.docs_title.learning_more.mail.embedding_inline_attachments') }}</a>
    </li>
    <li>
        <a href="#queueing-mail">{{ Lang::get('l4doc.docs_title.learning_more.mail.queueing_mail') }}</a>
    </li>
    <li>
        <a href="#mail-and-local-development">{{ Lang::get('l4doc.docs_title.learning_more.mail.mail_and_local_development') }}</a>
    </li>
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.mail.configuration') }}</h2>

<p>
    Laravel 提供一個乾淨且簡單的郵件 API，建構於熱門的 <a href="http://swiftmailer.org" target="_blank">SwiftMailer</a> 函式庫，郵件設定檔案放在 <code>app/config/mail.php</code>，允許你變更你的 SMTP 主機位置、Port 及驗證方式，也可以設定全部郵件的 <code>寄件人 (from)</code> 地址，你可以使用任何的 SMTP 伺服器，如果你希望使用 PHP 內建的 <code>mail</code> 函式發送郵件，只要在設定檔中將 <code>driver</code> 參數設定為 <code>mail</code> 即可，且 Laravel 也支援透過 sendmail 郵件伺服器寄送郵件。
</p>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.mail.basic_usage') }}</h2>

<p>
    使用 <code>Mail::send</code> 方法發送郵件:
</p>

<pre><code>Mail::send('emails.welcome', $data, function($message)
{
    $message-&gt;to('foo@example.com', 'John Smith')-&gt;subject('Welcome!');
});
</code></pre>

<p>
    傳送給 <code>send</code> 方法的第一個參數是郵件內容的視圖 (View) 名稱，第二個參數是傳送給視圖處理的 <code>資料</code> ，第三個閉合函式可以讓你設定郵件寄送的選項。
</p>

<blockquote>
  <p><strong>注意:</strong> 預設都會傳送 <code>$message</code> 變數資訊給郵件視圖，讓你可以在視圖中嵌入附件，所以最好避免將傳送到視圖的資料變數名稱設為 <code>message</code></p>
</blockquote>

<p>
    你也可以指定一個純文字視圖，並將其附加在 HTML 視圖上:
</p>

<pre><code>Mail::send(array('html.view', 'text.view'), $data, $callback);
</code></pre>

<p>
    或許你也可以透過 <code>html</code> 或 <code>text</code> 關鍵字，指定使用單一類型郵件視圖:
</p>

<pre><code>Mail::send(array('text' =&gt; 'view'), $data, $callback);
</code></pre>

<p>
    你也可以設定郵件的其他選項，像是副本 (CC:carbon copies) 或是附加檔案:
</p>

<pre><code>Mail::send('emails.welcome', $data, function($message)
{
    $message-&gt;from('us@example.com', 'Laravel');

    $message-&gt;to('foo@example.com')-&gt;cc('bar@example.com');

    $message-&gt;attach($pathToFile);
});
</code></pre>

<p>
    當你附加檔案到郵件時，你也可以指定檔案的 "MIME 類型"或是"檔案顯示名稱":
</p>

<pre><code>$message-&gt;attach($pathToFile, array('as' =&gt; $display, 'mime' =&gt; $mime));
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 傳送到 <code>Mail::send</code> 閉合函式的 message 實例繼承了 SwiftMailer 類別，所以你可以呼叫在 SwiftMailer 類別中的任何方法去建立你的郵件。</p>
</blockquote>

<p><a name="embedding-inline-attachments"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.mail.embedding_inline_attachments') }}</h2>

<p>
    在郵件中嵌入圖片通常都很麻煩，然而 Laravel 提供了很簡單的方法去附加圖片到郵件中，並可取得相對應的 CID。
</p>

<p><strong>嵌入圖片到郵件視圖中</strong></p>

<pre><code>&lt;body&gt;
    這裡有一張圖片:

    &lt;img src="&lt;?php echo $message-&gt;embed($pathToFile); ?&gt;"&gt;
&lt;/body&gt;
</code></pre>

<p><strong>嵌入原始資料到郵件視圖中</strong></p>

<pre><code>&lt;body&gt;
    這裡有從原始資料來的圖片:

    &lt;img src="&lt;?php echo $message-&gt;embedData($data, $name); ?&gt;"&gt;
&lt;/body&gt;
</code></pre>

<p>
    這裡需注意到， <code>Mail</code> 類別預設都會傳送 <code>$message</code> 變數資料到郵件視圖中。
</p>

<p><a name="queueing-mail"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.mail.queueing_mail') }}</h2>

<p>
    由於發送郵件會讓你的應用程式花費很長的時間去等待處理的回應，許多開發者選擇將郵件 佇列 (queue) 起來，並在背景執行發送動作， Laravel 建立了統一的 <a href="../../docs/queues">{{ Lang::get('l4doc.layout.docs_menu.queues') }}</a> API，讓佇列郵件可以很容易的實作，只要在 <code>Mail</code> 類別使用 <code>queue</code> 方法就可以佇列郵件:
</p>

<p><strong>佇列郵件</strong></p>

<pre><code>Mail::queue('emails.welcome', $data, function($message)
{
    $message-&gt;to('foo@example.com', 'John Smith')-&gt;subject('Welcome!');
});
</code></pre>

<p>
    你也可以使用 <code>later</code> 方法，去指定要經過幾秒的延遲後再發送郵件:
</p>

<pre><code>Mail::later(5, 'emails.welcome', $data, function($message)
{
    $message-&gt;to('foo@example.com', 'John Smith')-&gt;subject('Welcome!');
});
</code></pre>

<p>
    如果你想要將郵件放到指定的 "佇列 (queue)" 或 "管道 (tube)" ，可以使用 <code>queueOn</code> 及 <code>laterOn</code> 方法:
</p>

<pre><code>Mail::queueOn('queue-name', 'emails.welcome', $data, function($message)
{
    $message-&gt;to('foo@example.com', 'John Smith')-&gt;subject('Welcome!');
});
</code></pre>

<p><a name="mail-and-local-development"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.mail.mail_and_local_development') }}</h2>

<p>
    當你開發郵件寄送的應用時，你通常會想要在 "本地" 或 "開發環境" 中關閉傳送郵件功能，為了達到這樣的目的，你可以呼叫 <code>Mail::pretend</code> 方法，或者在郵件設定檔 <code>app/config/mail.php</code> 設定 <code>pretend</code> 的選項為 <code>true</code>，當你的郵件設定在 <code>pretend</code> 模式時，郵件訊息將會寫到你應用程式的 log 檔案中，而不會發送給使用者。
</p>

<p><strong>開啟郵件 Pretend 模式</strong></p>

<pre><code>Mail::pretend();
</code></pre>
@stop;
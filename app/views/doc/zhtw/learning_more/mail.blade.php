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
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.mail.configuration') }}</h2>

<p>
    Laravel provides a clean, simple API over the popular <a href="http://swiftmailer.org">SwiftMailer</a> library. The mail configuration file is <code>app/config/mail.php</code>, and contains options allowing you to change your SMTP host, port, and credentials, as well as set a global <code>from</code> address for all messages delivered by the library. You may use any SMTP server you wish. If you wish to use the PHP <code>mail</code> function to send mail, you may change the <code>driver</code> to <code>mail</code> in the configuration file. A <code>sendmail</code> driver is also available.
</p>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.mail.basic_usage') }}</h2>

<p>The <code>Mail::send</code> method may be used to send an e-mail message:</p>

<pre><code>Mail::send('emails.welcome', $data, function($message)
{
    $message-&gt;to('foo@example.com', 'John Smith')-&gt;subject('Welcome!');
});
</code></pre>

<p>
    The first argument passed to the <code>send</code> method is the name of the view that should be used as the e-mail body. The second is the <code>$data</code> that should be passed to the view, and the third is a Closure allowing you to specify various options on the e-mail message.
</p>

<blockquote>
  <p><strong>Note:</strong> A <code>$message</code> variable is always passed to e-mail views, and allows the inline embedding of attachments. So, it is best to avoid passing a <code>message</code> variable in your view payload.</p>
</blockquote>

<p>You may also specify a plain text view to use in addition to an HTML view:</p>

<pre><code>Mail::send(array('html.view', 'text.view'), $data, $callback);
</code></pre>

<p>Or, you may specify only one type of view using the <code>html</code> or <code>text</code> keys:</p>

<pre><code>Mail::send(array('text' =&gt; 'view'), $data, $callback);
</code></pre>

<p>You may specify other options on the e-mail message such as any carbon copies or attachments as well:</p>

<pre><code>Mail::send('emails.welcome', $data, function($message)
{
    $message-&gt;from('us@example.com', 'Laravel');

    $message-&gt;to('foo@example.com')-&gt;cc('bar@example.com');

    $message-&gt;attach($pathToFile);
});
</code></pre>

<p>When attaching files to a message, you may also specify a MIME type and / or a display name:</p>

<pre><code>$message-&gt;attach($pathToFile, array('as' =&gt; $display, 'mime' =&gt; $mime));
</code></pre>

<blockquote>
  <p><strong>Note:</strong> The message instance passed to a <code>Mail::send</code> Closure extends the SwiftMailer message class, allowing you to call any method on that class to build your e-mail messages.</p>
</blockquote>

<p><a name="embedding-inline-attachments"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.mail.embedding_inline_attachments') }}</h2>

<p>
    Embedding inline images into your e-mails is typically cumbersome; however, Laravel provides a convenient way to attach images to your e-mails and retrieving the appropriate CID.
</p>

<p><strong>Embedding An Image In An E-Mail View</strong></p>

<pre><code>&lt;body&gt;
    Here is an image:

    &lt;img src="&lt;?php echo $message-&gt;embed($pathToFile); ?&gt;"&gt;
&lt;/body&gt;
</code></pre>

<p><strong>Embedding Raw Data In An E-Mail View</strong></p>

<pre><code>&lt;body&gt;
    Here is an image from raw data:

    &lt;img src="&lt;?php echo $message-&gt;embedData($data, $name); ?&gt;"&gt;
&lt;/body&gt;
</code></pre>

<p>Note that the <code>$message</code> variable is always passed to e-mail views by the <code>Mail</code> class.</p>

<p><a name="queueing-mail"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.mail.queueing_mail') }}</h2>

<p>
    Since sending e-mail messages can drastically lengthen the response time of your application, many developers choose to queue e-mail messages for background sending. Laravel makes this easy using its built-in <a href="/docs/queues">unified queue API</a>. To queue a mail message, simply use the <code>queue</code> method on the <code>Mail</code> class:
</p>

<p><strong>Queueing A Mail Message</strong></p>

<pre><code>Mail::queue('emails.welcome', $data, function($message)
{
    $message-&gt;to('foo@example.com', 'John Smith')-&gt;subject('Welcome!');
});
</code></pre>

<p>
    You may also specify the number of seconds you wish to delay the sending of the mail message using the <code>later</code> method:
</p>

<pre><code>Mail::later(5, 'emails.welcome', $data, function($message)
{
    $message-&gt;to('foo@example.com', 'John Smith')-&gt;subject('Welcome!');
});
</code></pre>

<p>If you wish to specify a specific queue or "tube" on which to push the message, you may do so using the <code>queueOn</code> and <code>laterOn</code> methods:</p>

<pre><code>Mail::queueOn('queue-name', 'emails.welcome', $data, function($message)
{
    $message-&gt;to('foo@example.com', 'John Smith')-&gt;subject('Welcome!');
});
</code></pre>
@stop;
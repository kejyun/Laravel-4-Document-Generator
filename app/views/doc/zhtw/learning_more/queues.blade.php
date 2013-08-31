@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.queues') }}</h1>

<ul>
    <li>
        <a href="#configuration">{{ Lang::get('l4doc.docs_title.learning_more.queues.configuration') }}</a>
    </li>
    <li>
        <a href="#basic-usage">{{ Lang::get('l4doc.docs_title.learning_more.queues.basic_usage') }}</a>
    </li>
    <li>
        <a href="#queueing-closures">{{ Lang::get('l4doc.docs_title.learning_more.queues.queueing_closures') }}</a>
    </li>
    <li>
        <a href="#running-the-queue-listener">{{ Lang::get('l4doc.docs_title.learning_more.queues.running_the_queue_listener') }}</a>
    </li>
    <li>
        <a href="#push-queues">{{ Lang::get('l4doc.docs_title.learning_more.queues.push_queues') }}</a>
    </li>
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.queues.configuration') }}</h2>

<p>
    Laravel 對不同的佇列服務提供了統一的 API，佇列讓你可以延遲處理需要花費時間處理的任務，像是延遲寄送郵件，進而大幅加快應用程式的存取速度。
</p>

<p>
    佇列的設定檔放在 <code>app/config/queue.php</code>，在設定檔中可以找到 Laravel 支援的佇列服務連線設定，像是 <a href="http://kr.github.com/beanstalkd" target="_blank">Beanstalkd</a> 、 <a href="http://iron.io/" target="_blank">IronMQ</a> 、 <a href="http://aws.amazon.com/sqs" target="_blank">Amazon SQS</a> 及同步處理 (在本地端使用) 驅動。
</p>

<p>
    下列是佇列驅動所相依的套件:
</p>

<ul>
<li>Beanstalkd: <code>pda/pheanstalk</code></li>
<li>Amazon SQS: <code>aws/aws-sdk-php</code></li>
<li>IronMQ: <code>iron-io/iron_mq</code></li>
</ul>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.queues.basic_usage') }}</h2>

<p>
    使用 <code>Queue::push</code> 方法推送一個新的任務到佇列中:
</p>

<p><strong>推送任務到佇列</strong></p>

<pre><code>Queue::push('SendEmail', array('message' =&gt; $message));
</code></pre>

<p>
    傳送給 <code>push</code> 方法的第一個參數是用來處理這個佇列任務處理器的類別名稱，第二個參數是傳送給處理器處理的陣列資料，佇列任務處理器會被定義成像這樣:
</p>

<p><strong>定義一個佇列任務處理器</strong></p>

<pre><code>class SendEmail {

    public function fire($job, $data)
    {
        //
    }

}
</code></pre>

<p>
    注意，佇列任務處理器只需要 <code>fire</code> 方法，<code>fire</code> 方法會接收一個 <code>任務</code> 實例，就像推送 <code>處理資料</code> 到佇列一樣。
</p>

<p>
    你如果希望佇列任務處理器使用 <code>fire</code> 以外的方法去處理，你可以在推送資料給處理器時，去指定想要用來執行的方法:
</p>

<p><strong>指定自訂的處理器方法</strong></p>

<pre><code>Queue::push('SendEmail@send', array('message' =&gt; $message));
</code></pre>

<p>
    在你處理完佇列任務後，必須要將任務從佇列中刪除，可以在 <code>任務</code> 實例中使用 <code>delete</code> 方法來達到這個目的:
</p>

<p><strong>刪除被處理過的任務</strong></p>

<pre><code>public function fire($job, $data)
{
    // Process the job...

    $job-&gt;delete();
}
</code></pre>

<p>
    使用 <code>release</code> 方法可以將任務放回佇列:
</p>

<p><strong>將任務放回佇列</strong></p>

<pre><code>public function fire($job, $data)
{
    // Process the job...

    $job-&gt;release();
}
</code></pre>

<p>
    你也可以指定要延遲幾秒再將任務放回佇列:
</p>

<pre><code>$job-&gt;release(5);
</code></pre>

<p>
    如果在處理佇列任務時發生異常狀況，則任務將會自動放回佇列中，你可以用 <code>attempts</code> 方法去取得任務被嘗試處理的次數:
</p>

<p><strong>檢查任務被嘗試處理的次數</strong></p>

<pre><code>if ($job-&gt;attempts() &gt; 3)
{
    //
}
</code></pre>

<p>
    你也可以使用 <code>getJobId</code> 方法去取得任務的編號:
</p>

<p><strong>存取任務編號</strong></p>

<pre><code>$job-&gt;getJobId();
</code></pre>

<p><a name="queueing-closures"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.queues.queueing_closures') }}</h2>

<p>
    你也可以推送閉合凾式到佇列中，這是相當方便且快速、簡單的處理佇列任務:
</p>

<p><strong>推送閉合凾式到佇列</strong></p>

<pre><code>Queue::push(function($job) use ($id)
{
    Account::delete($id);

    $job-&gt;delete();
});
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 當推送閉合函式到佇列中，不應該使用 <code>__DIR__</code> 及 <code>__FILE__</code> 常數</p>
</blockquote>

<p>
    當你使用 Iron.io <a href="#push-queues">{{ Lang::get('l4doc.docs_title.learning_more.queues.push_queues') }}</a> ，你應該做額外的閉合函式佇列預防措施，在接收佇列訊息時應該要檢查請求的標記 (token) 是否真的是來自 Iron.io ，舉例來說，你推送到佇列訊息的結尾應該要長得像這樣: <code>https://yourapp.com/queue/receive?token=SecretToken</code>，你可以在安排處理佇列時檢查標記是否合法。
</p>

<p><a name="running-the-queue-listener"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.queues.running_the_queue_listener') }}</h2>

<p>
    Laravel 包含了 Artisan 佇列任務的指令，可以去執行新的推送到佇列的任務，你可以使用 <code>queue:listen</code> 指令去執行這個功能:
</p>

<p><strong>開啟佇列傾聽器</strong></p>

<pre><code>php artisan queue:listen
</code></pre>

<p>
    你可以指定佇列傾聽器要使用哪一個連結:
</p>

<pre><code>php artisan queue:listen connection
</code></pre>

<p>
    注意，一但佇列傾聽器任務啟動，除非手動停止，否則將會持續的做佇列傾聽的動作，你可以使用 <a href="http://supervisord.org/" target="_blank">Supervisor</a> 監看工具去確認佇列傾聽器的執行狀況。
</p>

<p>
    你也可以設定每個佇列傾聽器任務的執行時間 (秒):
</p>

<p><strong>指定佇列傾聽器任務的執行時間</strong></p>

<pre><code>php artisan queue:listen --timeout=60
</code></pre>

<p>
    使用 <code>queue:work</code> 指令去執行在佇列的第一個任務:
</p>

<p><strong>處理在佇列的第一個任務</strong></p>

<pre><code>php artisan queue:work
</code></pre>

<p><a name="push-queues"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.queues.push_queues') }}</h2>

<p>
    推送佇列讓你可以在沒有執行任何自動執行或背景執行的傾聽器時，使用 Laravel 的強大的佇列工具，現在推送佇列只支援 <a href="http://iron.io/" target="_blank">Iron.io</a> 驅動，在開始使用佇列之前，必須先建立 Iron.io 帳號，並把帳號相關驗證資訊設定寫到 <code>app/config/queue.php</code> 設定檔中。
</p>

<p>
    接下來你可以在 Artisan 指令使用 <code>queue:subscribe</code> 指令去註冊一個接收佇列任務的應用程式網址:
</p>

<p><strong>註冊推送佇列訂閱器</strong></p>

<pre><code>php artisan queue:subscribe queue_name http://foo.com/queue/receive
</code></pre>

<p>
    當你現在去登入 Iron 後台，你會看到一個新的推送佇列及訂閱的網址，你可以訂閱任何想要推送到佇列的網址，接下來，建立一個路由到 <code>queue/receive</code>，並回傳 <code>Queue::marshal</code> 方法的回應:
</p>

<pre><code>Route::post('queue/receive', function()
{
    return Queue::marshal();
});
</code></pre>

<p>
    <code>marshal</code> 方法會自動執行正確的任務處理類別，若想要將任務推送到佇列，只要用原本的相同的 <code>Queue::push</code> 方法即可。
</p>
@stop;
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
    The Laravel Queue component provides a unified API across a variety of different queue services. Queues allow you to defer the processing of a time consuming task, such as sending an e-mail, until a later time, thus drastically speeding up the web requests to your application.
</p>

<p>
    The queue configuration file is stored in <code>app/config/queue.php</code>. In this file you will find connection configurations for each of the queue drivers that are included with the framework, which includes a <a href="http://kr.github.com/beanstalkd">Beanstalkd</a>, <a href="http://iron.io">IronMQ</a>, <a href="http://aws.amazon.com/sqs">Amazon SQS</a>, and synchronous (for local use) driver.
</p>

<p>The following dependencies are needed for the listed queue drivers:</p>

<ul>
<li>Beanstalkd: <code>pda/pheanstalk</code></li>
<li>Amazon SQS: <code>aws/aws-sdk-php</code></li>
<li>IronMQ: <code>iron-io/iron_mq</code></li>
</ul>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.queues.basic_usage') }}</h2>

<p>To push a new job onto the queue, use the <code>Queue::push</code> method:</p>

<p><strong>Pushing A Job Onto The Queue</strong></p>

<pre><code>Queue::push('SendEmail', array('message' =&gt; $message));
</code></pre>

<p>
    The first argument given to the <code>push</code> method is the name of the class that should be used to process the job. The second argument is an array of data that should be passed to the handler. A job handler should be defined like so:
</p>

<p><strong>Defining A Job Handler</strong></p>

<pre><code>class SendEmail {

    public function fire($job, $data)
    {
        //
    }

}
</code></pre>

<p>Notice the only method that is required is <code>fire</code>, which receives a <code>Job</code> instance as well as the array of <code>data</code> that was pushed onto the queue.</p>

<p>If you want the job to use a method other than <code>fire</code>, you may specify the method when you push the job:</p>

<p><strong>Specifying A Custom Handler Method</strong></p>

<pre><code>Queue::push('SendEmail@send', array('message' =&gt; $message));
</code></pre>

<p>Once you have processed a job, it must be deleted from the queue, which can be done via the <code>delete</code> method on the <code>Job</code> instance:</p>

<p><strong>Deleting A Processed Job</strong></p>

<pre><code>public function fire($job, $data)
{
    // Process the job...

    $job-&gt;delete();
}
</code></pre>

<p>
    If you wish to release a job back onto the queue, you may do so via the <code>release</code> method:
</p>

<p><strong>Releasing A Job Back Onto The Queue</strong></p>

<pre><code>public function fire($job, $data)
{
    // Process the job...

    $job-&gt;release();
}
</code></pre>

<p>You may also specify the number of seconds to wait before the job is released:</p>

<pre><code>$job-&gt;release(5);
</code></pre>

<p>
    If an exception occurs while the job is being processed, it will automatically be released back onto the queue. You may check the number of attempts that have been made to run the job using the <code>attempts</code> method:
</p>

<p><strong>Checking The Number Of Run Attempts</strong></p>

<pre><code>if ($job-&gt;attempts() &gt; 3)
{
    //
}
</code></pre>

<p>You may also access the job identifier:</p>

<p><strong>Accessing The Job ID</strong></p>

<pre><code>$job-&gt;getJobId();
</code></pre>

<p><a name="queueing-closures"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.queues.queueing_closures') }}</h2>

<p>You may also push a Closure onto the queue. This is very convenient for quick, simple tasks that need to be queued:</p>

<p><strong>Pushing A Closure Onto The Queue</strong></p>

<pre><code>Queue::push(function($job) use ($id)
{
    Account::delete($id);

    $job-&gt;delete();
});
</code></pre>

<blockquote>
  <p><strong>Note:</strong> When pushing Closures onto the queue, the <code>__DIR__</code> and <code>__FILE__</code> constants should not be used.</p>
</blockquote>

<p>
    When using Iron.io <a href="#push-queues">push queues</a>, you should take extra precaution queueing Closures. The end-point that receives your queue messages should check for a token to verify that the request is actually from Iron.io. For example, your push queue end-point should be something like: <code>https://yourapp.com/queue/receive?token=SecretToken</code>. You may then check the value of the secret token in your application before marshaling the queue request.
</p>

<p><a name="running-the-queue-listener"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.queues.running_the_queue_listener') }}</h2>

<p>
    Laravel includes an Artisan task that will run new jobs as they are pushed onto the queue. You may run this task using the <code>queue:listen</code> command:
</p>

<p><strong>Starting The Queue Listener</strong></p>

<pre><code>php artisan queue:listen
</code></pre>

<p>You may also specify which queue connection the listener should utilize:</p>

<pre><code>php artisan queue:listen connection
</code></pre>

<p>
    Note that once this task has started, it will continue to run until it is manually stopped. You may use a process monitor such as <a href="http://supervisord.org/">Supervisor</a> to ensure that the queue listener does not stop running.
</p>

<p>You may also set the length of time (in seconds) each job should be allowed to run:</p>

<p><strong>Specifying The Job Timeout Parameter</strong></p>

<pre><code>php artisan queue:listen --timeout=60
</code></pre>

<p>To process only the first job on the queue, you may use the <code>queue:work</code> command:</p>

<p><strong>Processing The First Job On The Queue</strong></p>

<pre><code>php artisan queue:work
</code></pre>

<p><a name="push-queues"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.queues.push_queues') }}</h2>

<p>
    Push queues allow you to utilize the powerful Laravel 4 queue facilities without running any daemons or background listeners. Currently, push queues are only supported by the <a href="http://iron.io">Iron.io</a> driver. Before getting started, create an Iron.io account, and add your Iron credentials to the <code>app/config/queue.php</code> configuration file.
</p>

<p>
    Next, you may use the <code>queue:subscribe</code> Artisan command to register a URL end-point that will receive newly pushed queue jobs:
</p>

<p><strong>Registering A Push Queue Subscriber</strong></p>

<pre><code>php artisan queue:subscribe queue_name http://foo.com/queue/receive
</code></pre>

<p>
    Now, when you login to your Iron dashboard, you will see your new push queue, as well as the subscribed URL. You may subscribe as many URLs as you wish to a given queue. Next, create a route for your <code>queue/receive</code> end-point and return the response from the <code>Queue::marshal</code> method:
</p>

<pre><code>Route::post('queue/receive', function()
{
    return Queue::marshal();
});
</code></pre>

<p>
    The <code>marshal</code> method will take care of firing the correct job handler class. To fire jobs onto the push queue, just use the same <code>Queue::push</code> method used for conventional queues.
</p>
@stop;
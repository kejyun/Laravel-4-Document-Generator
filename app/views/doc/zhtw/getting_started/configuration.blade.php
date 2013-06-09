@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.installation') }}</h1>

<ul>
    <li>
        <a href="#introduction">{{ Lang::get('l4doc.docs_title.getting_started.configuration.introduction') }}</a>
    </li>
    <li>
        <a href="#environment-configuration">{{ Lang::get('l4doc.docs_title.getting_started.configuration.environment_configuration') }}</a>
    </li>
    <li>
        <a href="#maintenance-mode">{{ Lang::get('l4doc.docs_title.getting_started.configuration.maintenance_mode') }}</a>
    </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.configuration.introduction') }}</h2>

<p>
    All of the configuration files for the Laravel framework are stored in the <code>app/config</code> directory. Each option in every file is documented, so feel free to look through the files and get familiar with the options available to you.
</p>

<p>
    Sometimes you may need to access configuration values at run-time. You may do so using the <code>Config</code> class:
</p>

<p><strong>Accessing A Configuration Value</strong></p>

<pre><code>Config::get('app.timezone');
</code></pre>

<p>You may also specify a default value to return if the configuration option does not exist:</p>

<pre><code>$timezone = Config::get('app.timezone', 'UTC');
</code></pre>

<p>
    Notice that "dot" style syntax may be used to access values in the various files. You may also set configuration values at run-time:
</p>

<p><strong>Setting A Configuration Value</strong></p>

<pre><code>Config::set('database.default', 'sqlite');
</code></pre>

<p><a name="environment-configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.configuration.environment_configuration') }}</h2>

<p>
    It is often helpful to have different configuration values based on the environment the application is running in. For example, you may wish to use a different cache driver on your local development machine than on the production server. It is easy to accomplish this using environment based configuration.
</p>

<p>
    Simply create a folder within the <code>config</code> directory that matches your environment name, such as <code>local</code>. Next, create the configuration files you wish to override and specify the options for that environment. For example, to override the cache driver for the local environment, you would create a <code>cache.php</code> file in <code>app/config/local</code> with the following content:
</p>

<pre><code>&lt;?php

return array(

    'driver' =&gt; 'file',

);
</code></pre>

<blockquote>
  <p><strong>Note:</strong> Do not use 'testing' as an environment name. This is reserved for unit testing.</p>
</blockquote>

<p>
    Notice that you do not have to specify <em>every</em> option that is in the base configuration file, but only the options you wish to override. The environment configuration files will "cascade" over the base files.
</p>

<p>
    Next, we need to instruct the framework how to determine which environment it is running in. The default environment is always <code>production</code>. However, you may setup other environments within the <code>bootstrap/start.php</code> file at the root of your installation. In this file you will find an <code>$app-&gt;detectEnvironment</code> call. The array passed to this method is used to determine the current environment. You may add other environments and machine names to the array as needed.
</p>

<pre><code>&lt;?php

$env = $app-&gt;detectEnvironment(array(

    'local' =&gt; array('your-machine-name'),

));
</code></pre>

<p>
    You may also pass a <code>Closure</code> to the <code>detectEnvironment</code> method, allowing you to implement your own environment detection:
</p>

<pre><code>$env = $app-&gt;detectEnvironment(function()
{
    return $_SERVER['MY_LARAVEL_ENV'];
});
</code></pre>

<p>You may access the current application environment via the <code>environment</code> method:</p>

<p><strong>Accessing The Current Application Environment</strong></p>

<pre><code>$environment = App::environment();
</code></pre>

<p><a name="maintenance-mode"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.configuration.maintenance_mode') }}</h2>

<p>
    When your application is in maintenance mode, a custom view will be displayed for all routes into your application. This makes it easy to "disable" your application while it is updating. A call to the <code>App::down</code> method is already present in your <code>app/start/global.php</code> file. The response from this method will be sent to users when your application is in maintenance mode.
</p>

<p>To enable maintenance mode, simply execute the <code>down</code> Artisan command:</p>

<pre><code>php artisan down
</code></pre>

<p>To disable maintenance mode, use the <code>up</code> command:</p>

<pre><code>php artisan up
</code></pre>

<p>
    To show a custom view when your application is in maintenance mode, you may add something like the following to your application's <code>app/start/global.php</code> file:
</p>

<pre><code>App::down(function()
{
    return Response::view('maintenance', array(), 503);
});
</code></pre>
@stop;
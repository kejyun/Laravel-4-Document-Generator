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
    Artisan is the name of the command-line interface included with Laravel. It provides a number of helpful commands for your use while developing your application. It is driven by the powerful Symfony Console component.
</p>

<p><a name="usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.artisan.usage') }}</h2>

<p>To view a list of all available Artisan commands, you may use the <code>list</code> command:</p>

<p><strong>Listing All Available Commands</strong></p>

<pre><code>php artisan list
</code></pre>

<p>
    Every command also includes a "help" screen which displays and describes the command's available arguments and options. To view a help screen, simply precede the name of the command with <code>help</code>:
</p>

<p><strong>Viewing The Help Screen For A Command</strong></p>

<pre><code>php artisan help migrate
</code></pre>

<p>
    You may specify the configuration environment that should be used while running a command using the <code>--env</code> switch:
</p>

<p><strong>Specifying The Configuration Environment</strong></p>

<pre><code>php artisan migrate --env=local
</code></pre>

<p>You may also view the current version of your Laravel installation using the <code>--version</code> option:</p>

<p><strong>Displaying Your Current Laravel Version</strong></p>

<pre><code>php artisan --version
</code></pre>
@stop;
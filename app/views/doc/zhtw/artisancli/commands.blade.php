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
    In addition to the commands provided with Artisan, you may also build your own custom commands for working with your application. You may store your custom commands in the <code>app/commands</code> directory; however, you are free to choose your own storage location as long as your commands can be autoloaded based on your <code>composer.json</code> settings.
</p>

<p><a name="building-a-command"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.commands.building_a_command') }}</h2>

<h3>Generating The Class</h3>

<p>
    To create a new command, you may use the <code>command:make</code> Artisan command, which will generate a command stub to help you get started:
</p>

<p><strong>Generate A New Command Class</strong></p>

<pre><code>php artisan command:make FooCommand
</code></pre>

<p>
    By default, generated commands will be stored in the <code>app/commands</code> directory; however, you may specify custom path or namespace:
</p>

<pre><code>php artisan command:make FooCommand --path="app/classes" --namespace="Classes"
</code></pre>

<h3>Writing The Command</h3>

<p>
    Once your command is generated, you should fill out the <code>name</code> and <code>description</code> properties of the class, which will be used when displaying your command on the <code>list</code> screen.
</p>

<p>
    The <code>fire</code> method will be called when your command is executed. You may place any command logic in this method.
</p>

<h3>Arguments &amp; Options</h3>

<p>
    The <code>getArguments</code> and <code>getOptions</code> methods are where you may define any arguments or options your command receives. Both of these methods return an array of commands, which are described by a list of array options.
</p>

<p>When defining <code>arguments</code>, the array definition values represent the following:</p>

<pre><code>array($name, $mode, $description, $defaultValue)
</code></pre>

<p>
    The argument <code>mode</code> may be any of the following: <code>InputArgument::REQUIRED</code> or <code>InputArgument::OPTIONAL</code>.
</p>

<p>When defining <code>options</code>, the array definition values represent the following:</p>

<pre><code>array($name, $shortcut, $mode, $description, $defaultValue)
</code></pre>

<p>
    For options, the argument <code>mode</code> may be: <code>InputOption::VALUE_REQUIRED</code>, <code>InputOption::VALUE_OPTIONAL</code>, <code>InputOption::VALUE_IS_ARRAY</code>, <code>InputOption::VALUE_NONE</code>.
</p>

<p>
    The <code>VALUE_IS_ARRAY</code> mode indicates that the switch may be used multiple times when calling the command:
</p>

<pre><code>php artisan foo --option=bar --option=baz
</code></pre>

<p>The <code>VALUE_NONE</code> option indicates that the option is simply used as a "switch":</p>

<pre><code>php artisan foo --option
</code></pre>

<h3>Retrieving Input</h3>

<p>
    While your command is executing, you will obviously need to access the values for the arguments and options accepted by your application. To do so, you may use the <code>argument</code> and <code>option</code> methods:
</p>

<p><strong>Retrieving The Value Of A Command Argument</strong></p>

<pre><code>$value = $this-&gt;argument('name');
</code></pre>

<p><strong>Retrieving All Arguments</strong></p>

<pre><code>$arguments = $this-&gt;argument();
</code></pre>

<p><strong>Retrieving The Value Of A Command Option</strong></p>

<pre><code>$value = $this-&gt;option('name');
</code></pre>

<p><strong>Retrieving All Options</strong></p>

<pre><code>$options = $this-&gt;option();
</code></pre>

<h3>Writing Output</h3>

<p>
    To send output to the console, you may use the <code>info</code>, <code>comment</code>, <code>question</code> and <code>error</code> methods. Each of these methods will use the appropriate ANSI colors for their purpose.
</p>

<p><strong>Sending Information To The Console</strong></p>

<pre><code>$this-&gt;info('Display this on the screen');
</code></pre>

<p><strong>Sending An Error Message To The Console</strong></p>

<pre><code>$this-&gt;error('Something went wrong!');
</code></pre>

<h3>Asking Questions</h3>

<p>You may also use the <code>ask</code> and <code>confirm</code> methods to prompt the user for input:</p>

<p><strong>Asking The User For Input</strong></p>

<pre><code>$name = $this-&gt;ask('What is your name?');
</code></pre>

<p><strong>Asking The User For Secret Input</strong></p>

<pre><code>$password = $this-&gt;secret('What is the password?');
</code></pre>

<p><strong>Asking The User For Confirmation</strong></p>

<pre><code>if ($this-&gt;confirm('Do you wish to continue? [yes|no]'))
{
    //
}
</code></pre>

<p>
    You may also specify a default value to the <code>confirm</code> method, which should be <code>true</code> or <code>false</code>:
</p>

<pre><code>$this-&gt;confirm($question, true);
</code></pre>

<p><a name="registering-commands"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.commands.registering_commands') }}</h2>

<p>
    Once your command is finished, you need to register it with Artisan so it will be available for use. This is typically done in the <code>app/start/artisan.php</code> file. Within this file, you may use the <code>Artisan::add</code> method to register the command:
</p>

<p><strong>Registering An Artisan Command</strong></p>

<pre><code>Artisan::add(new CustomCommand);
</code></pre>

<p>
    If your command is registered in the application <a href="/docs/ioc">IoC container</a>, you may use the <code>Artisan::resolve</code> method to make it available to Artisan:
</p>

<p><strong>Registering A Command That Is In The IoC Container</strong></p>

<pre><code>Artisan::resolve('binding.name');
</code></pre>

<p><a name="calling-other-commands"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.artisancli.commands.calling_other_commands') }}</h2>

<p>
    Sometimes you may wish to call other commands from your command. You may do so using the <code>call</code> method:
</p>

<p><strong>Calling Another Command</strong></p>

<pre><code>$this-&gt;call('command.name', array('argument' =&gt; 'foo', '--option' =&gt; 'bar'));
</code></pre>
@stop;
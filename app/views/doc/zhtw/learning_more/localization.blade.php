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
	The Laravel <code>Lang</code> class provides a convenient way of retrieving strings in various languages, allowing you to easily support multiple languages within your application.
</p>

<p><a name="language-files"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.localization.language_files') }}</h2>

<p>
	Language strings are stored in files within the <code>app/lang</code> directory. Within this directory there should be a subdirectory for each language supported by the application.
</p>

<pre><code>/app
    /lang
        /en
            messages.php
        /es
            messages.php
</code></pre>

<p>Language files simply return an array of keyed strings. For example:</p>

<p><strong>Example Language File</strong></p>

<pre><code>&lt;?php

return array(
    'welcome' =&gt; 'Welcome to our application'
);
</code></pre>

<p>
	The default language for your application is stored in the <code>app/config/app.php</code> configuration file. You may change the active language at any time using the <code>App::setLocale</code> method:
</p>

<p><strong>Changing The Default Language At Runtime</strong></p>

<pre><code>App::setLocale('es');
</code></pre>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.localization.basic_usage') }}</h2>

<p><strong>Retrieving Lines From A Language File</strong></p>

<pre><code>echo Lang::get('messages.welcome');
</code></pre>

<p>
	The first segment of the string passed to the <code>get</code> method is the name of the language file, and the second is the name of the line that should be retrieved.
</p>

<blockquote>
  <p><strong>Note</strong>: If a language line does not exist, the key will be returned by the <code>get</code> method.</p>
</blockquote>

<p><strong>Making Replacements In Lines</strong></p>

<p>You may also define place-holders in your language lines:</p>

<pre><code>'welcome' =&gt; 'Welcome, :name',
</code></pre>

<p>Then, pass a second argument of replacements to the <code>Lang::get</code> method:</p>

<pre><code>echo Lang::get('messages.welcome', array('name' =&gt; 'Dayle'));
</code></pre>

<p><strong>Determine If A Language File Contains A Line</strong></p>

<pre><code>if (Lang::has('messages.welcome'))
{
    //
}
</code></pre>

<p><a name="pluralization"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.localization.pluralization') }}</h2>

<p>
	Pluralization is a complex problem, as different languages have a variety of complex rules for pluralization. You may easily manage this in your language files. By using a "pipe" character, you may separate the singular and plural forms of a string:
</p>

<pre><code>'apples' =&gt; 'There is one apple|There are many apples',
</code></pre>

<p>You may then use the <code>Lang::choice</code> method to retrieve the line:</p>

<pre><code>echo Lang::choice('messages.apples', 10);
</code></pre>

<p>
	Since the Laravel translator is powered by the Symfony Translation component, you may also create more explicit pluralization rules easily:
</p>

<pre><code>'apples' =&gt; '{0} There are none|[1,19] There are some|[20,Inf] There are many',
</code></pre>
@stop;
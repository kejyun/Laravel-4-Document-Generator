@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.installation') }}</h1>

<ul>
    <li>
        <a href="#install-composer">{{ Lang::get('l4doc.docs_title.getting_started.installation.install_composer') }}</a>
    </li>
    <li>
        <a href="#install-laravel">{{ Lang::get('l4doc.docs_title.getting_started.installation.install_laravel') }}</a>
    </li>
    <li>
        <a href="#server-requirements">{{ Lang::get('l4doc.docs_title.getting_started.installation.server_requirements') }}</a>
    </li>
    <li>
        <a href="#configuration">{{ Lang::get('l4doc.docs_title.getting_started.installation.configuration') }}</a>
    </li>
    <li>
        <a href="#pretty-urls">{{ Lang::get('l4doc.docs_title.getting_started.installation.pretty_urls') }}</a>
    </li>
</ul>

<p><a name="install-composer"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.install_composer') }}</h2>

<p>
    Laravel utilizes <a href="http://getcomposer.org">Composer</a> to manage its dependencies. First, download a copy of the <code>composer.phar</code>. Once you have the PHAR archive, you can either keep it in your local project directory or move to <code>usr/local/bin</code> to use it globally on your system. On Windows, you can use the Composer <a href="https://getcomposer.org/Composer-Setup.exe">Windows installer</a>.
</p>

<p><a name="install-laravel"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.install_laravel') }}</h2>

<h3>Via Composer Create-Project</h3>

<p>You may install Laravel by issuing the Composer <code>create-project</code> command in your terminal:</p>

<pre><code>composer create-project laravel/laravel
</code></pre>

<h3>Via Download</h3>

<p>
    Once Composer is installed, download the <a href="https://github.com/laravel/laravel/archive/master.zip">latest version</a> of the Laravel framework and extract its contents into a directory on your server. Next, in the root of your Laravel application, run the <code>php composer.phar install</code> (or <code>composer install</code>) command to install all of the framework's dependencies. This process requires Git to be installed on the server to successfully complete the installation.
</p>

<p>If you want to update the Laravel framework, you may issue the <code>php composer.phar update</code> command.</p>

<p><a name="server-requirements"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.server_requirements') }}</h2>

<p>The Laravel framework has a few system requirements:</p>

<ul>
<li>PHP >= 5.3.7</li>
<li>MCrypt PHP Extension</li>
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.configuration') }}</h2>

<p>
    Laravel needs almost no configuration out of the box. You are free to get started developing! However, you may wish to review the <code>app/config/app.php</code> file and its documentation. It contains several options such as <code>timezone</code> and <code>locale</code> that you may wish to change according to your application.
</p>

<blockquote>
  <p>
    <strong>Note:</strong> One configuration option you should be sure to set is the <code>key</code> option within <code>app/config/app.php</code>. This value should be set to a 32 character, random string. This key is used when encrypting values, and encrypted values will not be safe until it is properly set. You can set this value quickly by using the following artisan command <code>php artisan key:generate</code>.
  </p>
</blockquote>

<p><a name="permissions"></a></p>

<h3>Permissions</h3>

<p>
    Laravel requires one set of permissions to be configured - folders within app/storage require write access by the web server.
</p>

<p><a name="paths"></a></p>

<h3>Paths</h3>

<p>
    Several of the framework directory paths are configurable. To change the location of these directories, check out the <code>bootstrap/paths.php</code> file.
</p>

<blockquote>
  <p>
    <strong>Note:</strong> Laravel is designed to protect your application code, and local storage by placing only files that are necessarily public in the public folder.  It is recommended that you either set the public folder as your site's documentRoot (also known as a web root) or to place the contents of public into your site's root directory and place all of Laravel's other files outside the web root.
  </p>
</blockquote>

<p><a name="pretty-urls"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.installation.pretty_urls') }}</h2>

<p>
    The framework ships with a <code>public/.htaccess</code> file that is used to allow URLs without <code>index.php</code>. If you use Apache to serve your Laravel application, be sure to enable the <code>mod_rewrite</code> module.
</p>

<p>If the <code>.htaccess</code> file that ships with Laravel does not work with your Apache installation, try this one:</p>

<pre><code>Options +FollowSymLinks
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)/$ http://%{HTTP_HOST}/$1 [R=301,L]

RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
</code></pre>
@stop;
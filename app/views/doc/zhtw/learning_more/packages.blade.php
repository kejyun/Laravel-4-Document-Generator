@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.packages') }}</h1>

<ul>
  <li>
    <a href="#introduction">{{ Lang::get('l4doc.docs_title.learning_more.packages.introduction') }}</a>
  </li>
  <li>
    <a href="#creating-a-package">{{ Lang::get('l4doc.docs_title.learning_more.packages.creating_a_package') }}</a>
  </li>
  <li>
    <a href="#package-structure">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_structure') }}</a>
  </li>
  <li>
    <a href="#service-providers">{{ Lang::get('l4doc.docs_title.learning_more.packages.service_providers') }}</a>
  </li>
  <li>
    <a href="#package-conventions">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_conventions') }}</a>
  </li>
  <li>
    <a href="#development-workflow">{{ Lang::get('l4doc.docs_title.learning_more.packages.development_workflow') }}</a>
  </li>
  <li>
    <a href="#package-routing">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_routing') }}</a>
  </li>
  <li>
    <a href="#package-configuration">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_configuration') }}</a>
  </li>
  <li>
    <a href="#package-migrations">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_migrations') }}</a>
  </li>
  <li>
    <a href="#package-assets">{{ Lang::get('l4doc.docs_title.learning_more.packages.package_assets') }}</a>
  </li>
  <li>
    <a href="#publishing-packages">{{ Lang::get('l4doc.docs_title.learning_more.packages.publishing_packages') }}</a>
  </li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.introduction') }}</h2>

<p>
  Packages are the primary way of adding functionality to Laravel. Packages might be anything from a great way to work with dates like <a href="https://github.com/briannesbitt/Carbon">Carbon</a>, or an entire BDD testing framework like <a href="https://github.com/Behat/Behat">Behat</a>.
</p>

<p>
  Of course, there are different types of packages. Some packages are stand-alone, meaning they work with any framework, not just Laravel. Both Carbon and Behat are examples of stand-alone packages. Any of these packages may be used with Laravel by simply requesting them in your <code>composer.json</code> file.
</p>

<p>
  On the other hand, other packages are specifically intended for use with Laravel. In previous versions of Laravel, these types of packages were called "bundles". These packages may have routes, controllers, views, configuration, and migrations specifically intended to enhance a Laravel application. As no special process is needed to develop stand-alone packages, this guide primarily covers the development of those that are Laravel specific.
</p>

<p>
  All Laravel packages are distributed via <a href="http://packagist.org">Packagist</a> and <a href="http://getcomposer.org">Composer</a>, so learning about these wonderful PHP package distribution tools is essential.
</p>

<p><a name="creating-a-package"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.creating_a_package') }}</h2>

<p>
  The easiest way to create a new package for use with Laravel is the <code>workbench</code> Artisan command. First, you will need to set a few options in the <code>app/config/workbench.php</code> file. In that file, you will find a <code>name</code> and <code>email</code> option. These values will be used to generate a <code>composer.json</code> file for your new package. Once you have supplied those values, you are ready to build a workbench package!
</p>

<p><strong>Issuing The Workbench Artisan Command</strong></p>

<pre><code>php artisan workbench vendor/package --resources
</code></pre>

<p>
  The vendor name is a way to distinguish your package from other packages of the same name from different authors. For example, if I (Taylor Otwell) were to create a new package named "Zapper", the vendor name could be <code>Taylor</code> while the package name would be <code>Zapper</code>. By default, the workbench will create framework agnostic packages; however, the <code>resources</code> command tells the workbench to generate the package with Laravel specific directories such as <code>migrations</code>, <code>views</code>, <code>config</code>, etc.
</p>

<p>
  Once the <code>workbench</code> command has been executed, your package will be available within the <code>workbench</code> directory of your Laravel installation. Next, you should register the <code>ServiceProvider</code> that was created for your package. You may register the provider by adding it to the <code>providers</code> array in the <code>app/config/app.php</code> file. This will instruct Laravel to load your package when your application starts. Service providers use a <code>[Package]ServiceProvider</code> naming convention. So, using the example above, you would add <code>Taylor\Zapper\ZapperServiceProvider</code> to the <code>providers</code> array.
</p>

<p>
  Once the provider has been registered, you are ready to start developing your package! However, before diving in, you may wish to review the sections below to get more familiar with the package structure and development workflow.
</p>

<p><a name="package-structure"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_structure') }}</h2>

<p>
  When using the <code>workbench</code> command, your package will be setup with conventions that allow the package to integrate well with other parts of the Laravel framework:
</p>

<p><strong>Basic Package Directory Structure</strong></p>

<pre><code>/src
    /Vendor
        /Package
            PackageServiceProvider.php
    /config
    /lang
    /migrations
    /views
/tests
/public
</code></pre>

<p>
  Let's explore this structure further. The <code>src/Vendor/Package</code> directory is the home of all of your package's classes, including the <code>ServiceProvider</code>. The <code>config</code>, <code>lang</code>, <code>migrations</code>, and <code>views</code> directories, as you might guess, contain the corresponding resources for your package. Packages may have any of these resources, just like "regular" applications.
</p>

<p><a name="service-providers"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.service_providers') }}</h2>

<p>
  Service providers are simply bootstrap classes for packages. By default, they contain two methods: <code>boot</code> and <code>register</code>. Within these methods you may do anything you like: include a routes file, register bindings in the IoC container, attach to events, or anything else you wish to do.
</p>

<p>
  The <code>register</code> method is called immediately when the service provider is registered, while the <code>boot</code> command is only called right before a request is routed. So, if actions in your service provider rely on another service provider already being registered, or you are overriding services bound by another provider, you should use the <code>boot</code> method.
</p>

<p>When creating a package using the <code>workbench</code>, the <code>boot</code> command will already contain one action:</p>

<pre><code>$this-&gt;package('vendor/package');
</code></pre>

<p>
  This method allows Laravel to know how to properly load the views, configuration, and other resources for your application. In general, there should be no need for you to change this line of code, as it will setup the package using the workbench conventions.
</p>

<p><a name="package-conventions"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_conventions') }}</h2>

<p>When utilizing resources from a package, such as configuration items or views, a double-colon syntax will generally be used:</p>

<p><strong>Loading A View From A Package</strong></p>

<pre><code>return View::make('package::view.name');
</code></pre>

<p><strong>Retrieving A Package Configuration Item</strong></p>

<pre><code>return Config::get('package::group.option');
</code></pre>

<blockquote>
  <p><strong>Note:</strong> If your package contains migrations, consider prefixing the migration name with your package name to avoid potential class name conflicts with other packages.</p>
</blockquote>

<p><a name="development-workflow"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.development_workflow') }}</h2>

<p>
  When developing a package, it is useful to be able to develop within the context of an application, allowing you to easily view and experiment with your templates, etc. So, to get started, install a fresh copy of the Laravel framework, then use the <code>workbench</code> command to create your package structure.
</p>

<p>
  After the <code>workbench</code> command has created your package. You may <code>git init</code> from the <code>workbench/[vendor]/[package]</code> directory and <code>git push</code> your package straight from the workbench! This will allow you to conveniently develop the package in an application context without being bogged down by constant <code>composer update</code> commands.
</p>

<p>
  Since your packages are in the <code>workbench</code> directory, you may be wondering how Composer knows to autoload your package's files. When the <code>workbench</code> directory exists, Laravel will intelligently scan it for packages, loading their Composer autoload files when the application starts!
</p>

<p><a name="package-routing"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_routing') }}</h2>

<p>
  In prior versions of Laravel, a <code>handles</code> clause was used to specify which URIs a package could respond to. However, in Laravel 4, a package may respond to any URI. To load a routes file for your package, simply <code>include</code> it from within your service provider's <code>boot</code> method.
</p>

<p><strong>Including A Routes File From A Service Provider</strong></p>

<pre><code>public function boot()
{
    $this-&gt;package('vendor/package');

    include __DIR__.'/../../routes.php';
}
</code></pre>

<blockquote>
  <p><strong>Note:</strong> If your package is using controllers, you will need to make sure they are properly configured in your <code>composer.json</code> file's auto-load section.</p>
</blockquote>

<p><a name="package-configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_configuration') }}</h2>

<p>
  Some packages may require configuration files. These files should be defined in the same way as typical application configuration files. And, when using the default <code>$this-&gt;package</code> method of registering resources in your service provider, may be accessed using the usual "double-colon" syntax:
</p>

<p><strong>Accessing Package Configuration Files</strong></p>

<pre><code>Config::get('package::file.option');
</code></pre>

<p>
  However, if your package contains a single configuration file, you may simply name the file <code>config.php</code>. When this is done, you may access the options directly, without specifying the file name:
</p>

<p><strong>Accessing Single File Package Configuration</strong></p>

<pre><code>Config::get('package::option');
</code></pre>

<h3>Cascading Configuration Files</h3>

<p>
  When other developers install your package, they may wish to override some of the configuration options. However, if they change the values in your package source code, they will be overwritten the next time Composer updates the package. Instead, the <code>config:publish</code> artisan command should be used:
</p>

<p><strong>Executing The Config Publish Command</strong></p>

<pre><code>php artisan config:publish vendor/package
</code></pre>

<p>
  When this command is executed, the configuration files for your application will be copied to <code>app/config/packages/vendor/package</code> where they can be safely modified by the developer!
</p>

<blockquote>
  <p><strong>Note:</strong> The developer may also create environment specific configuration files for your package by placing them in <code>app/config/packages/vendor/package/environment</code>.</p>
</blockquote>

<p><a name="package-migrations"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_migrations') }}</h2>

<p>
  You may easily create and run migrations for any of your packages. To create a migration for a package in the workbench, use the <code>--bench</code> option:
</p>

<p><strong>Creating Migrations For Workbench Packages</strong></p>

<pre><code>php artisan migrate:make create_users_table --bench="vendor/package"
</code></pre>

<p><strong>Running Migrations For Workbench Packages</strong></p>

<pre><code>php artisan migrate --bench="vendor/package"
</code></pre>

<p>
  To run migrations for a finished package that was installed via Composer into the <code>vendor</code> directory, you may use the <code>--package</code> directive:
</p>

<p><strong>Running Migrations For An Installed Package</strong></p>

<pre><code>php artisan migrate --package="vendor/package"
</code></pre>

<p><a name="package-assets"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.package_assets') }}</h2>

<p>
  Some packages may have assets such as JavaScript, CSS, and images. However, we are unable to link to assets in the <code>vendor</code> or <code>workbench</code> directories, so we need a way to move these assets into the <code>public</code> directory of our application. The <code>asset:publish</code> command will take care of this for you:
</p>

<p><strong>Moving Package Assets To Public</strong></p>

<pre><code>php artisan asset:publish

php artisan asset:publish vendor/package
</code></pre>

<p>If the package is still in the <code>workbench</code>, use the <code>--bench</code> directive:</p>

<pre><code>php artisan asset:publish --bench="vendor/package"
</code></pre>

<p>
  This command will move the assets into the <code>public/packages</code> directory according to the vendor and package name. So, a package named <code>userscape/kudos</code> would have its assets moved to <code>public/packages/userscape/kudos</code>. Using this asset publishing convention allows you to safely code asset paths in your package's views.
</p>

<p><a name="publishing-packages"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.packages.publishing_packages') }}</h2>

<p>
  When your package is ready to publish, you should submit the package to the <a href="http://packagist.org">Packagist</a> repository. If the package is specific to Laravel, consider adding a <code>laravel</code> tag to your package's <code>composer.json</code> file.
</p>

<p>
  Also, it is courteous and helpful to tag your releases so that developers can depend on stable versions when requesting your package in their <code>composer.json</code> files. If a stable version is not ready, consider using the <code>branch-alias</code> Composer directive.
</p>

<p>
  Once your package has been published, feel free to continue developing it within the application context created by <code>workbench</code>. This is a great way to continue to conveniently develop the package even after it has been published.
</p>

<p>
  Some organizations choose to host their own private repository of packages for their own developers. If you are interested in doing this, review the documentation for the <a href="http://github.com/composer/satis">Satis</a> project provided by the Composer team.
</p>
@stop;
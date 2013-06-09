@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.templates') }}</h1>

<ul>
    <li>
        <a href="#controller-layouts">{{ Lang::get('l4doc.docs_title.learning_more.templates.controller_layouts') }}</a>
    </li>
    <li>
        <a href="#blade-templating">{{ Lang::get('l4doc.docs_title.learning_more.templates.blade_templating') }}</a>
    </li>
    <li>
        <a href="#other-blade-control-structures">{{ Lang::get('l4doc.docs_title.learning_more.templates.other_blade_control_structures') }}</a>
    </li>
</ul>

<p><a name="controller-layouts"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.templates.controller_layouts') }}</h2>

<p>
    One method of using templates in Laravel is via controller layouts. By specifying the <code>layout</code> property on the controller, the view specified will be created for you and will be the assumed response that should be returned from actions.
</p>

<p><strong>Defining A Layout On A Controller</strong></p>

<pre><code>class UserController extends BaseController {

    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.master';

    /**
     * Show the user profile.
     */
    public function showProfile()
    {
        $this-&gt;layout-&gt;content = View::make('user.profile');
    }

}
</code></pre>

<p><a name="blade-templating"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.templates.blade_templating') }}</h2>

<p>
    Blade is a simple, yet powerful templating engine provided with Laravel. Unlike controller layouts, Blade is driven by <em>template inheritance</em> and <em>sections</em>. All Blade templates should use the <code>.blade.php</code> extension.
</p>

<p><strong>Defining A Blade Layout</strong></p>

<pre><code>&lt;!-- Stored in app/views/layouts/master.blade.php --&gt;

&lt;html&gt;
    &lt;body&gt;
        (@)section('sidebar')
            This is the master sidebar.
        (@)show

        &lt;div class="container"&gt;
            (@)yield('content')
        &lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;
</code></pre>

<p><strong>Using A Blade Layout</strong></p>

<pre><code>(@)extends('layouts.master')

(@)section('sidebar')
    (@)parent

    &lt;p&gt;This is appended to the master sidebar.&lt;/p&gt;
(@)stop

(@)section('content')
    &lt;p&gt;This is my body content.&lt;/p&gt;
(@)stop
</code></pre>

<p>
    Note that views which <code>extend</code> a Blade layout simply override sections from the layout. Content of the layout can be included in a child view using the <code>(@)parent</code> directive in a section, allowing you to append to the contents of a layout section such as a sidebar or footer.
</p>

<p><a name="other-blade-control-structures"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.templates.other_blade_control_structures') }}</h2>

<p><strong>Echoing Data</strong></p>

<pre><code>Hello, ({)({) $name (})(}).

The current UNIX timestamp is ({)({) time() (})(}).
</code></pre>

<p>To escape the output, you may use the triple curly brace syntax:</p>

<pre><code>Hello, ({)({){ $name (})(})}.
</code></pre>

<p><strong>If Statements</strong></p>

<pre><code>(@)if (count($records) === 1)
    I have one record!
(@)elseif (count($records) &gt; 1)
    I have multiple records!
(@)else
    I don't have any records!
(@)endif

(@)unless (Auth::check())
    You are not signed in.
(@)endunless
</code></pre>

<p><strong>Loops</strong></p>

<pre><code>(@)for ($i = 0; $i &lt; 10; $i++)
    The current value is ({)({) $i (})(})
(@)endfor

(@)foreach ($users as $user)
    &lt;p&gt;This is user ({)({) $user-&gt;id (})(})&lt;/p&gt;
(@)endforeach

(@)while (true)
    &lt;p&gt;I'm looping forever.&lt;/p&gt;
(@)endwhile
</code></pre>

<p><strong>Including Sub-Views</strong></p>

<pre><code>(@)include('view.name')
</code></pre>

<p><strong>Displaying Language Lines</strong></p>

<pre><code>(@)lang('language.line')

(@)choice('language.line', 1);
</code></pre>

<p><strong>Comments</strong></p>

<pre><code>({)({)-- This comment will not be in the rendered HTML --(})(})
</code></pre>
@stop;
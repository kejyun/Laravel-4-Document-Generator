@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.html') }}</h1>

<ul>
  <li>
    <a href="#opening-a-form">{{ Lang::get('l4doc.docs_title.learning_more.html.opening_a_form') }}</a>
  </li>
  <li>
    <a href="#csrf-protection">{{ Lang::get('l4doc.docs_title.learning_more.html.csrf_protection') }}</a>
  </li>
  <li>
    <a href="#form-model-binding">{{ Lang::get('l4doc.docs_title.learning_more.html.form_model_binding') }}</a>
  </li>
  <li>
    <a href="#labels">{{ Lang::get('l4doc.docs_title.learning_more.html.labels') }}</a>
  </li>
  <li>
    <a href="#text">{{ Lang::get('l4doc.docs_title.learning_more.html.text') }}</a>
  </li>
  <li><a href="#checkboxes-and-radio-buttons">{{ Lang::get('l4doc.docs_title.learning_more.html.checkboxes_and_radio_buttons') }}</a>
  </li>
  <li>
    <a href="#file-input">{{ Lang::get('l4doc.docs_title.learning_more.html.file_input') }}</a>
  </li>
  <li>
    <a href="#drop-down-lists">{{ Lang::get('l4doc.docs_title.learning_more.html.drop_down_lists') }}</a>
  </li>
  <li>
    <a href="#buttons">{{ Lang::get('l4doc.docs_title.learning_more.html.buttons') }}</a>
  </li>
  <li>
    <a href="#custom-macros">{{ Lang::get('l4doc.docs_title.learning_more.html.custom_macros') }}</a>
  </li>
</ul>

<p><a name="opening-a-form"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.opening_a_form') }}</h2>

<p><strong>Opening A Form</strong></p>

<pre><code>({)({) Form::open(array('url' =&gt; 'foo/bar')) (})(})
    //
({)({) Form::close() (})(}))
</code></pre>

<p>By default, a <code>POST</code> method will be assumed; however, you are free to specify another method:</p>

<pre><code>echo Form::open(array('url' =&gt; 'foo/bar', 'method' =&gt; 'put'))
</code></pre>

<blockquote>
  <p><strong>Note:</strong> Since HTML forms only support <code>POST</code>, <code>PUT</code> and <code>DELETE</code> methods will be spoofed by automatically adding a <code>_method</code> hidden field to your form.</p>
</blockquote>

<p>You may also open forms that point to named routes or controller actions:</p>

<pre><code>echo Form::open(array('route' =&gt; 'route.name'))

echo Form::open(array('action' =&gt; 'Controller@method'))
</code></pre>

<p>If your form is going to accept file uploads, add a <code>files</code> option to your array:</p>

<pre><code>echo Form::open(array('url' =&gt; 'foo/bar', 'files' =&gt; true))
</code></pre>

<p><a name="csrf-protection"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.csrf_protection') }}</h2>

<p>Laravel provides an easy method of protecting your application from cross-site request forgeries. First, a random token is placed in your user's session. Don't sweat it, this is done automatically. The CSRF token will be added to your forms as a hidden field automatically. However, if you wish to generate the HTML for the hidden field, you may use the <code>token</code> method:</p>

<p><strong>Adding The CSRF Token To A Form</strong></p>

<pre><code>echo Form::token();
</code></pre>

<p><strong>Attaching The CSRF Filter To A Route</strong></p>

<pre><code>Route::post('profile', array('before' =&gt; 'csrf', function()
{
    //
}));
</code></pre>

<p><a name="form-model-binding"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.form_model_binding') }}</h2>

<p>Often, you will want to populate a form based on the contents of a model. To do so, use the <code>Form::model</code> method:</p>

<p><strong>Opening A Model Form</strong></p>

<pre><code>echo Form::model($user, array('route' =&gt; array('user.update', $user-&gt;id)))
</code></pre>

<p>Now, when you generate a form element, like a text input, the model's value matching the field's name will automatically be set as the field value. So, for example, for a text input named <code>email</code>, the user model's <code>email</code> attribute would be set as the value. However, there's more! If there is an item in the Session flash data matching the input name, that will take precedence over the model's value. So, the priority looks like this:</p>

<ol>
<li>Session Flash Data (Old Input)</li>
<li>Explicitly Passed Value</li>
<li>Model Attribute Data</li>
</ol>

<p>This allows you to quickly build forms that not only bind to model values, but easily re-populate if there is a validation error on the server!</p>

<blockquote>
  <p><strong>Note:</strong> When using <code>Form::model</code>, be sure to close your form with <code>Form::close</code>!</p>
</blockquote>

<p><a name="labels"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.labels') }}</h2>

<p><strong>Generating A Label Element</strong></p>

<pre><code>echo Form::label('email', 'E-Mail Address');
</code></pre>

<p><strong>Specifying Extra HTML Attributes</strong></p>

<pre><code>echo Form::label('email', 'E-Mail Address', array('class' =&gt; 'awesome'));
</code></pre>

<blockquote>
  <p><strong>Note:</strong> After creating a label, any form element you create with a name matching the label name will automatically receive an ID matching the label name as well.</p>
</blockquote>

<p><a name="text"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.text') }}</h2>

<p><strong>Generating A Text Input</strong></p>

<pre><code>echo Form::text('username');
</code></pre>

<p><strong>Specifying A Default Value</strong></p>

<pre><code>echo Form::text('email', 'example@gmail.com');
</code></pre>

<blockquote>
  <p><strong>Note:</strong> The <em>hidden</em> and <em>textarea</em> methods have the same signature as the <em>text</em> method.</p>
</blockquote>

<p><strong>Generating A Password Input</strong></p>

<pre><code>echo Form::password('password');
</code></pre>

<p><a name="checkboxes-and-radio-buttons"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.checkboxes_and_radio_buttons') }}</h2>

<p><strong>Generating A Checkbox Or Radio Input</strong></p>

<pre><code>echo Form::checkbox('name', 'value');

echo Form::radio('name', 'value');
</code></pre>

<p><strong>Generating A Checkbox Or Radio Input That Is Checked</strong></p>

<pre><code>echo Form::checkbox('name', 'value', true);

echo Form::radio('name', 'value', true);
</code></pre>

<p><a name="file-input"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.file_input') }}</h2>

<p><strong>Generating A File Input</strong></p>

<pre><code>echo Form::file('image');
</code></pre>

<p><a name="drop-down-lists"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.drop_down_lists') }}</h2>

<p><strong>Generating A Drop-Down List</strong></p>

<pre><code>echo Form::select('size', array('L' =&gt; 'Large', 'S' =&gt; 'Small'));
</code></pre>

<p><strong>Generating A Drop-Down List With Selected Default</strong></p>

<pre><code>echo Form::select('size', array('L' =&gt; 'Large', 'S' =&gt; 'Small'), 'S');
</code></pre>

<p><strong>Generating A Grouped List</strong></p>

<pre><code>echo Form::select('animal', array(
    'Cats' =&gt; array('leopard' =&gt; 'Leopard'),
    'Dogs' =&gt; array('spaniel' =&gt; 'Spaniel'),
));
</code></pre>

<p><a name="buttons"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.buttons') }}</h2>

<p><strong>Generating A Submit Button</strong></p>

<pre><code>echo Form::submit('Click Me!');
</code></pre>

<blockquote>
  <p><strong>Note:</strong> Need to create a button element? Try the <em>button</em> method. It has the same signature as <em>submit</em>.</p>
</blockquote>

<p><a name="custom-macros"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.html.custom_macros') }}</h2>

<p>It's easy to define your own custom Form class helpers called "macros". Here's how it works. First, simply register the macro with a given name and a Closure:</p>

<p><strong>Registering A Form Macro</strong></p>

<pre><code>Form::macro('myField', function()
{
    return '&lt;input type="awesome"&gt;';
});
</code></pre>

<p>Now you can call your macro using its name:</p>

<p><strong>Calling A Custom Form Macro</strong></p>

<pre><code>echo Form::myField();
</code></pre>
@stop;
@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.requests') }}</h1>

<ul>
	<li>
		<a href="#basic-input">{{ Lang::get('l4doc.docs_title.getting_started.requests.basic_input') }}</a>
	</li>
	<li>
		<a href="#cookies">{{ Lang::get('l4doc.docs_title.getting_started.requests.cookies') }}</a>
	</li>
	<li>
		<a href="#old-input">{{ Lang::get('l4doc.docs_title.getting_started.requests.old_input') }}</a>
	</li>
	<li>
		<a href="#files">{{ Lang::get('l4doc.docs_title.getting_started.requests.files') }}</a>
	</li>
	<li>
		<a href="#request-information">{{ Lang::get('l4doc.docs_title.getting_started.requests.request_information') }}</a>
	</li>
</ul>

<p><a name="basic-input"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.basic_input') }}</h2>

<p>
	You may access all user input with a few simple methods. You do not need to worry about the HTTP verb used for the request, as input is accessed in the same way for all verbs.
</p>

<p><strong>Retrieving An Input Value</strong></p>

<pre><code>$name = Input::get('name');
</code></pre>

<p><strong>Retrieving A Default Value If The Input Value Is Absent</strong></p>

<pre><code>$name = Input::get('name', 'Sally');
</code></pre>

<p><strong>Determining If An Input Value Is Present</strong></p>

<pre><code>if (Input::has('name'))
{
    //
}
</code></pre>

<p><strong>Getting All Input For The Request</strong></p>

<pre><code>$input = Input::all();
</code></pre>

<p><strong>Getting Only Some Of The Request Input</strong></p>

<pre><code>$input = Input::only('username', 'password');

$input = Input::except('credit_card');
</code></pre>

<p>
	Some JavaScript libraries such as Backbone may send input to the application as JSON. You may access this data via <code>Input::get</code> like normal.
</p>

<p><a name="cookies"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.cookies') }}</h2>

<p>
	All cookies created by the Laravel framework are encrypted and signed with an authentication code, meaning they will be considered invalid if they have been changed by the client.
</p>

<p><strong>Retrieving A Cookie Value</strong></p>

<pre><code>$value = Cookie::get('name');
</code></pre>

<p><strong>Attaching A New Cookie To A Response</strong></p>

<pre><code>$response = Response::make('Hello World');

$response-&gt;withCookie(Cookie::make('name', 'value', $minutes));
</code></pre>

<p><strong>Creating A Cookie That Lasts Forever</strong></p>

<pre><code>$cookie = Cookie::forever('name', 'value');
</code></pre>

<p><a name="old-input"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.old_input') }}</h2>

<p>
	You may need to keep input from one request until the next request. For example, you may need to re-populate a form after checking it for validation errors.
</p>

<p><strong>Flashing Input To The Session</strong></p>

<pre><code>Input::flash();
</code></pre>

<p><strong>Flashing Only Some Input To The Session</strong></p>

<pre><code>Input::flashOnly('username', 'email');

Input::flashExcept('password');
</code></pre>

<p>
	Since you often will want to flash input in association with a redirect to the previous page, you may easily chain input flashing onto a redirect.
</p>

<pre><code>return Redirect::to('form')-&gt;withInput();

return Redirect::to('form')-&gt;withInput(Input::except('password'));
</code></pre>

<blockquote>
  <p><strong>Note:</strong> You may flash other data across requests using the <a href="/docs/session">Session</a> class.</p>
</blockquote>

<p><strong>Retrieving Old Data</strong></p>

<pre><code>Input::old('username');
</code></pre>

<p><a name="files"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.files') }}</h2>

<p><strong>Retrieving An Uploaded File</strong></p>

<pre><code>$file = Input::file('photo');
</code></pre>

<p><strong>Determining If A File Was Uploaded</strong></p>

<pre><code>if (Input::hasFile('photo'))
{
    //
}
</code></pre>

<p>
	The object returned by the <code>file</code> method is an instance of the <code>Symfony\Component\HttpFoundation\File\UploadedFile</code> class, which extends the PHP <code>SplFileInfo</code> class and provides a variety of methods for interacting with the file.
</p>

<p><strong>Moving An Uploaded File</strong></p>

<pre><code>Input::file('photo')-&gt;move($destinationPath);

Input::file('photo')-&gt;move($destinationPath, $fileName);
</code></pre>

<p><strong>Retrieving The Path To An Uploaded File</strong></p>

<pre><code>$path = Input::file('photo')-&gt;getRealPath();
</code></pre>

<p><strong>Retrieving The Size Of An Uploaded File</strong></p>

<pre><code>$size = Input::file('photo')-&gt;getSize();
</code></pre>

<p><strong>Retrieving The MIME Type Of An Uploaded File</strong></p>

<pre><code>$mime = Input::file('photo')-&gt;getMimeType();
</code></pre>

<p><a name="request-information"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.getting_started.requests.request_information') }}</h2>

<p>
	The <code>Request</code> class provides many methods for examining the HTTP request for your application and extends the <code>Symfony\Component\HttpFoundation\Request</code> class. Here are some of the highlights.
</p>

<p><strong>Retrieving The Request URI</strong></p>

<pre><code>$uri = Request::path();
</code></pre>

<p><strong>Determining If The Request Path Matches A Pattern</strong></p>

<pre><code>if (Request::is('admin/*'))
{
    //
}
</code></pre>

<p><strong>Get The Request URL</strong></p>

<pre><code>$url = Request::url();
</code></pre>

<p><strong>Retrieve A Request URI Segment</strong></p>

<pre><code>$segment = Request::segment(1);
</code></pre>

<p><strong>Retrieving A Request Header</strong></p>

<pre><code>$value = Request::header('Content-Type');
</code></pre>

<p><strong>Retrieving Values From $_SERVER</strong></p>

<pre><code>$value = Request::server('PATH_INFO');
</code></pre>

<p><strong>Determine If The Request Is Using AJAX</strong></p>

<pre><code>if (Request::ajax())
{
    //
}
</code></pre>

<p><strong>Determining If The Request Is Over HTTPS</strong></p>

<pre><code>if (Request::secure())
{
    //
}
</code></pre>
@stop;
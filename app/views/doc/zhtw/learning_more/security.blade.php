@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.security') }}</h1>

<ul>
    <li>
        <a href="#configuration">{{ Lang::get('l4doc.docs_title.learning_more.security.configuration') }}</a>
    </li>
    <li>
        <a href="#storing-passwords">{{ Lang::get('l4doc.docs_title.learning_more.security.storing_passwords') }}</a>
    </li>
    <li>
        <a href="#authenticating-users">{{ Lang::get('l4doc.docs_title.learning_more.security.authenticating_users') }}</a>
    </li>
    <li>
        <a href="#manually">{{ Lang::get('l4doc.docs_title.learning_more.security.manually') }}</a>
    </li>
    <li>
        <a href="#protecting-routes">{{ Lang::get('l4doc.docs_title.learning_more.security.protecting_routes') }}</a>
    </li>
    <li>
        <a href="#http-basic-authentication">{{ Lang::get('l4doc.docs_title.learning_more.security.http_basic_authentication') }}</a>
    </li>
    <li>
        <a href="#password-reminders-and-reset">{{ Lang::get('l4doc.docs_title.learning_more.security.password_reminders_and_reset') }}</a>
    </li>
    <li>
        <a href="#encryption">{{ Lang::get('l4doc.docs_title.learning_more.security.encryption') }}</a>
    </li>
</ul>

<p><a name="configuration"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.configuration') }}</h2>

<p>
    Laravel aims to make implementing authentication very simple. In fact, almost everything is configured for you out of the box. The authentication configuration file is located at <code>app/config/auth.php</code>, which contains several well documented options for tweaking the behavior of the authentication facilities.
</p>

<p>
    By default, Laravel includes a <code>User</code> model in your <code>app/models</code> directory which may be used with the default Eloquent authentication driver. Please remember when building the Schema for this Model to ensure that the password field is a minimum of 60 characters.
</p>

<p>
    If your application is not using Eloquent, you may use the <code>database</code> authentication driver which uses the Laravel query builder.
</p>

<p><a name="storing-passwords"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.storing_passwords') }}</h2>

<p>The Laravel <code>Hash</code> class provides secure Bcrypt hashing:</p>

<p><strong>Hashing A Password Using Bcrypt</strong></p>

<pre><code>$password = Hash::make('secret');
</code></pre>

<p><strong>Verifying A Password Against A Hash</strong></p>

<pre><code>if (Hash::check('secret', $hashedPassword))
{
    // The passwords match...
}
</code></pre>

<p><strong>Checking If A Password Needs To Be Rehashed</strong></p>

<pre><code>if (Hash::needsRehash($hashed))
{
    $hashed = Hash::make('secret');
}
</code></pre>

<p><a name="authenticating-users"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.authenticating_users') }}</h2>

<p>To log a user into your application, you may use the <code>Auth::attempt</code> method.</p>

<pre><code>if (Auth::attempt(array('email' =&gt; $email, 'password' =&gt; $password)))
{
    return Redirect::intended('dashboard');
}
</code></pre>

<p>
    Take note that <code>email</code> is not a required option, it is merely used for example. You should use whatever column name corresponds to a "username" in your database. The <code>Redirect::intended</code> function will redirect the user to the URL they were trying to access before being caught by the authentication filter. A fallback URI may be given to this method in case the intended destination is not available.
</p>

<p>
    When the <code>attempt</code> method is called, the <code>auth.attempt</code> <a href="/docs/events">event</a> will be fired. If the authentication attempt is successful and the user is logged in, the <code>auth.login</code> event will be fired as well.
</p>

<p>To determine if the user is already logged into your application, you may use the <code>check</code> method:</p>

<p><strong>Determining If A User Is Authenticated</strong></p>

<pre><code>if (Auth::check())
{
    // The user is logged in...
}
</code></pre>

<p>
    If you would like to provide "remember me" functionality in your application, you may pass <code>true</code> as the second argument to the <code>attempt</code> method, which will keep the user authenticated indefinitely (or until they manually logout):
</p>

<p><strong>Authenticating A User And "Remembering" Them</strong></p>

<pre><code>if (Auth::attempt(array('email' =&gt; $email, 'password' =&gt; $password), true))
{
    // The user is being remembered...
}
</code></pre>

<p>
    <strong>Note:</strong> If the <code>attempt</code> method returns <code>true</code>, the user is considered logged into the application.
</p>

<p>You also may add extra conditions to the authenticating query:</p>

<p><strong>Authenticating A User With Conditions</strong></p>

<pre><code>if (Auth::attempt(array('email' =&gt; $email, 'password' =&gt; $password, 'active' =&gt; 1)))
{
    // The user is active, not suspended, and exists.
}
</code></pre>

<p>Once a user is authenticated, you may access the User model / record:</p>

<p><strong>Accessing The Logged In User</strong></p>

<pre><code>$email = Auth::user()-&gt;email;
</code></pre>

<p>To simply log a user into the application by their ID, use the <code>loginUsingId</code> method:</p>

<pre><code>Auth::loginUsingId(1);
</code></pre>

<p>
    The <code>validate</code> method allows you to validate a user's credentials without actually logging them into the application:
</p>

<p><strong>Validating User Credentials Without Login</strong></p>

<pre><code>if (Auth::validate($credentials))
{
    //
}
</code></pre>

<p>
    You may also use the <code>once</code> method to log a user into the application for a single request. No sessions or cookies will be utilized.
</p>

<p><strong>Logging A User In For A Single Request</strong></p>

<pre><code>if (Auth::once($credentials))
{
    //
}
</code></pre>

<p><strong>Logging A User Out Of The Application</strong></p>

<pre><code>Auth::logout();
</code></pre>

<p><a name="manually"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.manually') }}</h2>

<p>
    If you need to log an existing user instance into your application, you may simply call the <code>login</code> method with the instance:
</p>

<pre><code>$user = User::find(1);

Auth::login($user);
</code></pre>

<p>This is equivalent to logging in a user via credentials using the <code>attempt</code> method.</p>

<p><a name="protecting-routes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.protecting_routes') }}</h2>

<p>
    Route filters may be used to allow only authenticated users to access a given route. Laravel provides the <code>auth</code> filter by default, and it is defined in <code>app/filters.php</code>.
</p>

<p><strong>Protecting A Route</strong></p>

<pre><code>Route::get('profile', array('before' =&gt; 'auth', function()
{
    // Only authenticated users may enter...
}));
</code></pre>

<h3>CSRF Protection</h3>

<p>Laravel provides an easy method of protecting your application from cross-site request forgeries.</p>

<p><strong>Inserting CSRF Token Into Form</strong></p>

<pre><code>&lt;input type="hidden" name="_token" value="&lt;?php echo csrf_token(); ?&gt;"&gt;
</code></pre>

<p><strong>Validate The Submitted CSRF Token</strong></p>

<pre><code>Route::post('register', array('before' =&gt; 'csrf', function()
{
    return 'You gave a valid CSRF token!';
}));
</code></pre>

<p><a name="http-basic-authentication"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.http_basic_authentication') }}</h2>

<p>
    HTTP Basic Authentication provides a quick way to authenticate users of your application without setting up a dedicated "login" page. To get started, attach the <code>auth.basic</code> filter to your route:
</p>

<p><strong>Protecting A Route With HTTP Basic</strong></p>

<pre><code>Route::get('profile', array('before' =&gt; 'auth.basic', function()
{
    // Only authenticated users may enter...
}));
</code></pre>

<p>
    By default, the <code>basic</code> filter will use the <code>email</code> column on the user record when authenticating. If you wish to use another column you may pass the column name as the first parameter to the <code>basic</code> method:
</p>

<pre><code>return Auth::basic('username');
</code></pre>

<p>
    You may also use HTTP Basic Authentication without setting a user identifier cookie in the session, which is particularly useful for API authentication. To do so, define a filter that returns the <code>onceBasic</code> method:
</p>

<p><strong>Setting Up A Stateless HTTP Basic Filter</strong></p>

<pre><code>Route::filter('basic.once', function()
{
    return Auth::onceBasic();
});
</code></pre>

<p><a name="password-reminders-and-reset"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.password_reminders_and_reset') }}</h2>

<h3>Sending Password Reminders</h3>

<p>
    Most web applications provide a way for users to reset their forgotten passwords. Rather than forcing you to re-implement this on each application, Laravel provides convenient methods for sending password reminders and performing password resets. To get started, verify that your <code>User</code> model implements the <code>Illuminate\Auth\Reminders\RemindableInterface</code> contract. Of course, the <code>User</code> model included with the framework already implements this interface.
</p>

<p><strong>Implementing The RemindableInterface</strong></p>

<pre><code>class User extends Eloquent implements RemindableInterface {

    public function getReminderEmail()
    {
        return $this-&gt;email;
    }

}
</code></pre>

<p>Next, a table must be created to store the password reset tokens. To generate a migration for this table, simply execute the <code>auth:reminders</code> Artisan command:</p>

<p><strong>Generating The Reminder Table Migration</strong></p>

<pre><code>php artisan auth:reminders

php artisan migrate
</code></pre>

<p>To send a password reminder, we can use the <code>Password::remind</code> method:</p>

<p><strong>Sending A Password Reminder</strong></p>

<pre><code>Route::post('password/remind', function()
{
    $credentials = array('email' =&gt; Input::get('email'));

    return Password::remind($credentials);
});
</code></pre>

<p>
    Note that the arguments passed to the <code>remind</code> method are similar to the <code>Auth::attempt</code> method. This method will retrieve the <code>User</code> and send them a password reset link via e-mail. The e-mail view will be passed a <code>token</code> variable which may be used to construct the link to the password reset form. The <code>user</code> object will also be passed to the view.
</p>

<blockquote>
  <p><strong>Note:</strong> You may specify which view is used as the e-mail message by changing the <code>auth.reminder.email</code> configuration option. Of course, a default view is provided out of the box.</p>
</blockquote>

<p>You may modify the message instance that is sent to the user by passing a Closure as the second argument to the <code>remind</code> method:</p>

<pre><code>return Password::remind($credentials, function($message, $user)
{
    $message-&gt;subject('Your Password Reminder');
});
</code></pre>

<p>
    You may also have noticed that we are returning the results of the <code>remind</code> method directly from a route. By default, the <code>remind</code> method will return a <code>Redirect</code> to the current URI. If an error occurred while attempting to reset the password, an <code>error</code> variable will be flashed to the session, as well as a <code>reason</code>, which can be used to extract a language line from the <code>reminders</code> language file. If the password reset was successful, a <code>success</code> variable will be flashed to the session. So, your password reset form view could look something like this:
</p>

<pre><code>(@)if (Session::has('error'))
    ({)({) trans(Session::get('reason')) (})(})
(@)elseif (Session::has('success'))
    An e-mail with the password reset has been sent.
(@)endif

&lt;input type="text" name="email"&gt;
&lt;input type="submit" value="Send Reminder"&gt;
</code></pre>

<h3>Resetting Passwords</h3>

<p>
    Once a user has clicked on the reset link from the reminder e-mail, they should be directed to a form that includes a hidden <code>token</code> field, as well as a <code>password</code> and <code>password_confirmation</code> field. Below is an example route for the password reset form:
</p>

<pre><code>Route::get('password/reset/{token}', function($token)
{
    return View::make('auth.reset')-&gt;with('token', $token);
});
</code></pre>

<p>And, a password reset form might look like this:</p>

<pre><code>(@)if (Session::has('error'))
    ({)({) trans(Session::get('reason')) (})(})
(@)endif

&lt;input type="hidden" name="token" value="({)({) $token (})(})"&gt;
&lt;input type="text" name="email"&gt;
&lt;input type="password" name="password"&gt;
&lt;input type="password" name="password_confirmation"&gt;
</code></pre>

<p>
    Again, notice we are using the <code>Session</code> to display any errors that may be detected by the framework while resetting passwords. Next, we can define a <code>POST</code> route to handle the reset:
</p>

<pre><code>Route::post('password/reset/{token}', function()
{
    $credentials = array('email' =&gt; Input::get('email'));

    return Password::reset($credentials, function($user, $password)
    {
        $user-&gt;password = Hash::make($password);

        $user-&gt;save();

        return Redirect::to('home');
    });
});
</code></pre>

<p>
    If the password reset is successful, the <code>User</code> instance and the password will be passed to your Closure, allowing you to actually perform the save operation. Then, you may return a <code>Redirect</code> or any other type of response from the Closure which will be returned by the <code>reset</code> method. Note that the <code>reset</code> method automatically checks for a valid <code>token</code> in the request, valid credentials, and matching passwords.
</p>

<p>
    Also, similarly to the <code>remind</code> method, if an error occurs while resetting the password, the <code>reset</code> method will return a <code>Redirect</code> to the current URI with an <code>error</code> and <code>reason</code>.
</p>

<p><a name="encryption"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.encryption') }}</h2>

<p>Laravel provides facilities for strong AES-256 encryption via the mcrypt PHP extension:</p>

<p><strong>Encrypting A Value</strong></p>

<pre><code>$encrypted = Crypt::encrypt('secret');
</code></pre>

<blockquote>
  <p><strong>Note:</strong> Be sure to set a 32 character, random string in the <code>key</code> option of the <code>app/config/app.php</code> file. Otherwise, encrypted values will not be secure.</p>
</blockquote>

<p><strong>Decrypting A Value</strong></p>

<pre><code>$decrypted = Crypt::decrypt($encryptedValue);
</code></pre>

<p>You may also set the cipher and mode used by the encrypter:</p>

<p><strong>Setting The Cipher &amp; Mode</strong></p>

<pre><code>Crypt::setMode('crt');

Crypt::setCipher($cipher);
</code></pre>
@stop;
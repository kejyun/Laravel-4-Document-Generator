@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.validation') }}</h1>

<ul>
    <li>
        <a href="#basic-usage">{{ Lang::get('l4doc.docs_title.learning_more.validation.basic_usage') }}</a>
    </li>
    <li>
        <a href="#working-with-error-messages">{{ Lang::get('l4doc.docs_title.learning_more.validation.working_with_error_messages') }}</a>
    </li>
    <li>
        <a href="#error-messages-and-views">{{ Lang::get('l4doc.docs_title.learning_more.validation.error_messages_and_views') }}</a>
    </li>
    <li>
        <a href="#available-validation-rules">{{ Lang::get('l4doc.docs_title.learning_more.validation.available_validation_rules') }}</a>
    </li>
    <li>
        <a href="#custom-error-messages">{{ Lang::get('l4doc.docs_title.learning_more.validation.custom_error_messages') }}</a>
    </li>
    <li>
        <a href="#custom-validation-rules">{{ Lang::get('l4doc.docs_title.learning_more.validation.custom_validation_rules') }}</a>
    </li>
</ul>

<p><a name="basic-usage"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.basic_usage') }}</h2>

<p>
    Laravel ships with a simple, convenient facility for validating data and retrieving validation error messages via the <code>Validation</code> class.
</p>

<p><strong>Basic Validation Example</strong></p>

<pre><code>$validator = Validator::make(
    array('name' =&gt; 'Dayle'),
    array('name' =&gt; 'required|min:5')
);
</code></pre>

<p>
    The first argument passed to the <code>make</code> method is the data under validation. The second argument is the validation rules that should be applied to the data.
</p>

<p>Multiple rules may be delimited using either a "pipe" character, or as separate elements of an array.</p>

<p><strong>Using Arrays To Specify Rules</strong></p>

<pre><code>$validator = Validator::make(
    array('name' =&gt; 'Dayle'),
    array('name' =&gt; array('required', 'min:5'))
);
</code></pre>

<p>
    Once a <code>Validator</code> instance has been created, the <code>fails</code> (or <code>passes</code>) method may be used to perform the validation.
</p>

<pre><code>if ($validator-&gt;fails())
{
    // The given data did not pass validation
}
</code></pre>

<p>If validation has failed, you may retrieve the error messages from the validator.</p>

<pre><code>$messages = $validator-&gt;messages();
</code></pre>

<p>
    You may also access an array of the failed validation rules, without messages. To do so, use the <code>failed</code> method:
</p>

<pre><code>$failed = $validator-&gt;failed();
</code></pre>

<p><strong>Validating Files</strong></p>

<p>
    The <code>Validator</code> class provides several rules for validating files, such as <code>size</code>, <code>mimes</code>, and others. When validating files, you may simply pass them into the validator with your other data.
</p>

<p><a name="working-with-error-messages"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.working_with_error_messages') }}</h2>

<p>
    After calling the <code>messages</code> method on a <code>Validator</code> instance, you will receive a <code>MessageBag</code> instance, which has a variety of convenient methods for working with error messages.
</p>

<p><strong>Retrieving The First Error Message For A Field</strong></p>

<pre><code>echo $messages-&gt;first('email');
</code></pre>

<p><strong>Retrieving All Error Messages For A Field</strong></p>

<pre><code>foreach ($messages-&gt;get('email') as $message)
{
    //
}
</code></pre>

<p><strong>Retrieving All Error Messages For All Fields</strong></p>

<pre><code>foreach ($messages-&gt;all() as $message)
{
    //
}
</code></pre>

<p><strong>Determining If Messages Exist For A Field</strong></p>

<pre><code>if ($messages-&gt;has('email'))
{
    //
}
</code></pre>

<p><strong>Retrieving An Error Message With A Format</strong></p>

<pre><code>echo $messages-&gt;first('email', '&lt;p&gt;:message&lt;/p&gt;');
</code></pre>

<blockquote>
  <p><strong>Note:</strong> By default, messages are formatted using Bootstrap compatible syntax.</p>
</blockquote>

<p><strong>Retrieving All Error Messages With A Format</strong></p>

<pre><code>foreach ($messages-&gt;all('&lt;li&gt;:message&lt;/li&gt;') as $message)
{
    //
}
</code></pre>

<p><a name="error-messages-and-views"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.error_messages_and_views') }}</h2>

<p>
    Once you have performed validation, you will need an easy way to get the error messages back to your views. This is conveniently handled by Laravel. Consider the following routes as an example:
</p>

<pre><code>Route::get('register', function()
{
    return View::make('user.register');
});

Route::post('register', function()
{
    $rules = array(...);

    $validator = Validator::make(Input::all(), $rules);

    if ($validator-&gt;fails())
    {
        return Redirect::to('register')-&gt;withErrors($validator);
    }
});
</code></pre>

<p>
    Note that when validation fails, we pass the <code>Validator</code> instance to the Redirect using the <code>withErrors</code> method. This method will flash the error messages to the session so that they are available on the next request.
</p>

<p>
    However, notice that we do not have to explicitly bind the error messages to the view in our GET route. This is because Laravel will always check for errors in the session data, and automatically bind them to the view if they are available. <strong>So, it is important to note that an <code>$errors</code> variable will always be available in all of your views, on every request</strong>, allowing you to conveniently assume the <code>$errors</code> variable is always defined and can be safely used. The <code>$errors</code> variable will be an instance of <code>MessageBag</code>.</p>

<p>So, after redirection, you may utilize the automatically bound <code>$errors</code> variable in your view:
</p>

<pre><code>&lt;?php echo $errors-&gt;first('email'); ?&gt;
</code></pre>

<p><a name="available-validation-rules"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.available_validation_rules') }}</h2>

<p>Below is a list of all available validation rules and their function:</p>

<ul>
    <li><a href="#rule-accepted">Accepted</a></li>
    <li><a href="#rule-active-url">Active URL</a></li>
    <li><a href="#rule-after">After (Date)</a></li>
    <li><a href="#rule-alpha">Alpha</a></li>
    <li><a href="#rule-alpha-dash">Alpha Dash</a></li>
    <li><a href="#rule-alpha-num">Alpha Numeric</a></li>
    <li><a href="#rule-before">Before (Date)</a></li>
    <li><a href="#rule-between">Between</a></li>
    <li><a href="#rule-confirmed">Confirmed</a></li>
    <li><a href="#rule-date">Date</a></li>
    <li><a href="#rule-date-format">Date Format</a></li>
    <li><a href="#rule-different">Different</a></li>
    <li><a href="#rule-email">E-Mail</a></li>
    <li><a href="#rule-exists">Exists (Database)</a></li>
    <li><a href="#rule-image">Image (File)</a></li>
    <li><a href="#rule-in">In</a></li>
    <li><a href="#rule-integer">Integer</a></li>
    <li><a href="#rule-ip">IP Address</a></li>
    <li><a href="#rule-max">Max</a></li>
    <li><a href="#rule-mimes">MIME Types</a></li>
    <li><a href="#rule-min">Min</a></li>
    <li><a href="#rule-not-in">Not In</a></li>
    <li><a href="#rule-numeric">Numeric</a></li>
    <li><a href="#rule-regex">Regular Expression</a></li>
    <li><a href="#rule-required">Required</a></li>
    <li><a href="#rule-required-if">Required If</a></li>
    <li><a href="#rule-required-with">Required With</a></li>
    <li><a href="#rule-same">Same</a></li>
    <li><a href="#rule-size">Size</a></li>
    <li><a href="#rule-unique">Unique (Database)</a></li>
    <li><a href="#rule-url">URL</a></li>
</ul>

<p><a name="rule-accepted"></a></p>

<h4>accepted</h4>

<p>
    The field under validation must be <em>yes</em>, <em>on</em>, or <em>1</em>. This is useful for validating "Terms of Service" acceptance.
</p>

<p><a name="rule-active-url"></a></p>

<h4>active_url</h4>

<p>The field under validation must be a valid URL according to the <code>checkdnsrr</code> PHP function.</p>

<p><a name="rule-after"></a></p>

<h4>after:<em>date</em></h4>

<p>
    The field under validation must be a value after a given date. The dates will be passed into the PHP <code>strtotime</code> function.
</p>

<p><a name="rule-alpha"></a></p>

<h4>alpha</h4>

<p>The field under validation must be entirely alphabetic characters.</p>

<p><a name="rule-alpha-dash"></a></p>

<h4>alpha_dash</h4>

<p>The field under validation may have alpha-numeric characters, as well as dashes and underscores.</p>

<p><a name="rule-alpha-num"></a></p>

<h4>alpha_num</h4>

<p>The field under validation must be entirely alpha-numeric characters.</p>

<p><a name="rule-before"></a></p>

<h4>before:<em>date</em></h4>

<p>
    The field under validation must be a value preceding the given date. The dates will be passed into the PHP <code>strtotime</code> function.
</p>

<p><a name="rule-between"></a></p>

<h4>between:<em>min</em>,<em>max</em></h4>

<p>
    The field under validation must have a size between the given <em>min</em> and <em>max</em>. Strings, numerics, and files are evaluated in the same fashion as the <code>size</code> rule.
</p>

<p><a name="rule-confirmed"></a></p>

<h4>confirmed</h4>

<p>
    The field under validation must have a matching field of <code>foo_confirmation</code>. For example, if the field under validation is <code>password</code>, a matching <code>password_confirmation</code> field must be present in the input.
</p>

<p><a name="rule-date"></a></p>

<h4>date</h4>

<p>The field under validation must be a valid date according to the <code>strtotime</code> PHP function.</p>

<p><a name="rule-date-format"></a></p>

<h4>date_format:<em>format</em></h4>

<p>The field under validation must match the <em>format</em> defined according to the <code>date_parse_from_format</code> PHP function.</p>

<p><a name="rule-different"></a></p>

<h4>different:<em>field</em></h4>

<p>The given <em>field</em> must be different than the field under validation.</p>

<p><a name="rule-email"></a></p>

<h4>email</h4>

<p>The field under validation must be formatted as an e-mail address.</p>

<p><a name="rule-exists"></a></p>

<h4>exists:<em>table</em>,<em>column</em></h4>

<p>The field under validation must exists on a given database table.</p>

<p><strong>Basic Usage Of Exists Rule</strong></p>

<pre><code>'state' =&gt; 'exists:states'
</code></pre>

<p><strong>Specifying A Custom Column Name</strong></p>

<pre><code>'state' =&gt; 'exists:states,abbreviation'
</code></pre>

<p>You may also specify more conditions that will be added as "where" clauses to the query:</p>

<pre><code>'email' =&gt; 'exists:staff,email,account_id,1'
</code></pre>

<p><a name="rule-image"></a></p>

<h4>image</h4>

<p>The file under validation must be an image (jpeg, png, bmp, or gif)</p>

<p><a name="rule-in"></a></p>

<h4>in:<em>foo</em>,<em>bar</em>,...</h4>

<p>The field under validation must be included in the given list of values.</p>

<p><a name="rule-integer"></a></p>

<h4>integer</h4>

<p>The field under validation must have an integer value.</p>

<p><a name="rule-ip"></a></p>

<h4>ip</h4>

<p>The field under validation must be formatted as an IP address.</p>

<p><a name="rule-max"></a></p>

<h4>max:<em>value</em></h4>

<p>
    The field under validation must be less than a maximum <em>value</em>. Strings, numerics, and files are evaluated in the same fashion as the <code>size</code> rule.
</p>

<p><a name="rule-mimes"></a></p>

<h4>mimes:<em>foo</em>,<em>bar</em>,...</h4>

<p>The file under validation must have a MIME type corresponding to one of the listed extensions.</p>

<p><strong>Basic Usage Of MIME Rule</strong></p>

<pre><code>'photo' =&gt; 'mimes:jpeg,bmp,png'
</code></pre>

<p><a name="rule-min"></a></p>

<h4>min:<em>value</em></h4>

<p>
    The field under validation must have a minimum <em>value</em>. Strings, numerics, and files are evaluated in the same fashion as the <code>size</code> rule.
</p>

<p><a name="rule-not-in"></a></p>

<h4>not_in:<em>foo</em>,<em>bar</em>,...</h4>

<p>The field under validation must not be included in the given list of values.</p>

<p><a name="rule-numeric"></a></p>

<h4>numeric</h4>

<p>The field under validation must have a numeric value.</p>

<p><a name="rule-regex"></a></p>

<h4>regex:<em>pattern</em></h4>

<p>The field under validation must match the given regular expression.</p>

<p>
    <strong>Note:</strong> When using the <code>regex</code> pattern, it may be necessary to specify rules in an array instead of using pipe delimiters, especially if the regular expression contains a pipe character.
</p>

<p><a name="rule-required"></a></p>

<h4>required</h4>

<p>The field under validation must be present in the input data.</p>

<p><a name="rule-required-if"></a></p>

<h4>required_if:<em>field</em>,<em>value</em></h4>

<p>The field under validation must be present if the <em>field</em> field is equal to <em>value</em>.</p>

<p><a name="rule-required-with"></a></p>

<h4>required_with:<em>foo</em>,<em>bar</em>,...</h4>

<p>The field under validation must be present <em>only if</em> the other specified fields are present.</p>

<p><a name="rule-same"></a></p>

<h4>same:<em>field</em></h4>

<p>The given <em>field</em> must match the field under validation.</p>

<p><a name="rule-size"></a></p>

<h4>size:<em>value</em></h4>

<p>
    The field under validation must have a size matching the given <em>value</em>. For string data, <em>value</em> corresponds to the number of characters. For numeric data, <em>value</em> corresponds to a given integer value. For files, <em>size</em> corresponds to the file size in kilobytes.
</p>

<p><a name="rule-unique"></a></p>

<h4>unique:<em>table</em>,<em>column</em>,<em>except</em>,<em>idColumn</em></h4>

<p>
    The field under validation must be unique on a given database table. If the <code>column</code> option is not specified, the field name will be used.
</p>

<p><strong>Basic Usage Of Unique Rule</strong></p>

<pre><code>'email' =&gt; 'unique:users'
</code></pre>

<p><strong>Specifying A Custom Column Name</strong></p>

<pre><code>'email' =&gt; 'unique:users,email_address'
</code></pre>

<p><strong>Forcing A Unique Rule To Ignore A Given ID</strong></p>

<pre><code>'email' =&gt; 'unique:users,email_address,10'
</code></pre>

<p><a name="rule-url"></a></p>

<h4>url</h4>

<p>The field under validation must be formatted as an URL.</p>

<p><a name="custom-error-messages"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.custom_error_messages') }}</h2>

<p>If needed, you may use custom error messages for validation instead of the defaults. There are several ways to specify custom messages.</p>

<p><strong>Passing Custom Messages Into Validator</strong></p>

<pre><code>$messages = array(
    'required' =&gt; 'The :attribute field is required.',
);

$validator = Validator::make($input, $rules, $messages);
</code></pre>

<p>
    <em>Note:</em> The <code>:attribute</code> place-holder will be replaced by the actual name of the field under validation. You may also utilize other place-holders in validation messages.
</p>

<p><strong>Other Validation Place-Holders</strong></p>

<pre><code>$messages = array(
    'same'    =&gt; 'The :attribute and :other must match.',
    'size'    =&gt; 'The :attribute must be exactly :size.',
    'between' =&gt; 'The :attribute must be between :min - :max.',
    'in'      =&gt; 'The :attribute must be one of the following types: :values',
);
</code></pre>

<p>Sometimes you may wish to specify a custom error messages only for a specific field:</p>

<p><strong>Specifying A Custom Message For A Given Attribute</strong></p>

<pre><code>$messages = array(
    'email.required' =&gt; 'We need to know your e-mail address!',
);
</code></pre>

<p>
    In some cases, you may wish to specify your custom messages in a language file instead of passing them directly to the <code>Validator</code>. To do so, add your messages to <code>custom</code> array in the <code>app/lang/xx/validation.php</code> language file.
</p>

<p><strong>Specifying Custom Messages In Language Files</strong></p>

<pre><code>'custom' =&gt; array(
    'email' =&gt; array(
        'required' =&gt; 'We need to know your e-mail address!',
    ),
),
</code></pre>

<p><a name="custom-validation-rules"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.custom_validation_rules') }}</h2>

<p>
    Laravel provides a variety of helpful validation rules; however, you may wish to specify some of your own. One method of registering custom validation rules is using the <code>Validator::extend</code> method:
</p>

<p><strong>Registering A Custom Validation Rule</strong></p>

<pre><code>Validator::extend('foo', function($attribute, $value, $parameters)
{
    return $value == 'foo';
});
</code></pre>

<blockquote>
  <p><strong>Note:</strong> The name of the rule passed to the <code>extend</code> method must be "snake cased".</p>
</blockquote>

<p>The custom validator Closure receives three arguments: the name of the <code>$attribute</code> being validated, the <code>$value</code> of the attribute, and an array of <code>$parameters</code> passed to the rule.</p>

<p>You may also pass a class and method to the <code>extend</code> method instead of a Closure:</p>

<pre><code>Validator::extend('foo', 'FooValidator@validate');
</code></pre>

<p>
    Note that you will also need to define an error message for your custom rules. You can do so either using an inline custom message array or by adding an entry in the validation language file.
</p>

<p>
    Instead of using Closure callbacks to extend the Validator, you may also extend the Validator class itself. To do so, write a Validator class that extends <code>Illuminate\Validation\Validator</code>. You may add validation methods to the class by prefixing them with <code>validate</code>:
</p>

<p><strong>Extending The Validator Class</strong></p>

<pre><code>&lt;?php

class CustomValidator extends Illuminate\Validation\Validator {

    public function validateFoo($attribute, $value, $parameters)
    {
        return $value == 'foo';
    }

}
</code></pre>

<p>Next, you need to register your custom Validator extension:</p>

<p><strong>Registering A Custom Validator Resolver</strong></p>

<pre><code>Validator::resolver(function($translator, $data, $rules, $messages)
{
    return new CustomValidator($translator, $data, $rules, $messages);
});
</code></pre>

<p>
    When creating a custom validation rule, you may sometimes need to define custom place-holder replacements for error messages. You may do so by creating a custom Validator as described above, and adding a <code>replaceXXX</code> function to the validator.
</p>

<pre><code>protected function replaceFoo($message, $attribute, $rule, $parameters)
{
    return str_replace(':foo', $parameters[0], $message);
}
</code></pre>
@stop;
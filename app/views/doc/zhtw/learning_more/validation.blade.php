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
    Laravel 透過 <code>Validation</code> 類別來實現一個簡單便利的資料驗證作業以及錯誤訊息的取得。
</p>

<p><strong>基本驗證範例</strong></p>

<pre><code>$validator = Validator::make(
    array('name' =&gt; 'Dayle'),
    array('name' =&gt; 'required|min:5')
);
</code></pre>

<p>
    傳送到 <code>make</code> 方法的第一個參數是尚未驗證的資料。 第二個參數是資料的驗證規則。
</p>

<p>
    若有多個驗證規則時，可以使用 "|" 來進行分隔，或是將多個規則組成一個陣列。
</p>

<p><strong>Using Arrays To Specify Rules</strong></p>

<pre><code>$validator = Validator::make(
    array('name' =&gt; 'Dayle'),
    array('name' =&gt; array('required', 'min:5'))
);
</code></pre>

<p>
    一旦 <code>Validator</code> 驗證器被建立後，就可以開始使用 <code>fails</code> (或 <code>passes</code> ) 方法進行驗證作業。
</p>

<pre><code>if ($validator-&gt;fails())
{
    // 未通過驗證的資料
}
</code></pre>

<p>
    當資料驗證失敗，你可以從驗證器取得相關的錯誤訊息。
</p>

<pre><code>$messages = $validator-&gt;messages();
</code></pre>

<p>
    你也許想取得那些已驗證失敗的規則陣列。 可以使用 <code>failed</code> 這個方法:
</p>

<pre><code>$failed = $validator-&gt;failed();
</code></pre>

<p><strong>驗證檔案</strong></p>

<p>
    <code>Validator</code> 類別提供幾個針對檔案的驗證規則，像是 <code>size</code> 、 <code>mimes</code> 以及其它規則等。 當驗證檔案時，你可以把這些規則同時和你的其它資料一併送至驗證器中。
</p>

<p><a name="working-with-error-messages"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.working_with_error_messages') }}</h2>

<p>
    透過 <code>Validator</code> 驗證器呼叫 <code>messages</code> 方法後，你將會得到一個 <code>MessageBag</code> 訊息包裹，它提供一些方便的方法來處理錯誤訊息。
</p>

<p><strong>取得某個欄位的第一個錯誤訊息</strong></p>

<pre><code>echo $messages-&gt;first('email');
</code></pre>

<p><strong>取得某個欄位的所有錯誤訊息</strong></p>

<pre><code>foreach ($messages-&gt;get('email') as $message)
{
    //
}
</code></pre>

<p><strong>取得所有欄位的所有錯誤訊息</strong></p>

<pre><code>foreach ($messages-&gt;all() as $message)
{
    //
}
</code></pre>

<p><strong>確認指定欄位是否有錯誤訊息存在</strong></p>

<pre><code>if ($messages-&gt;has('email'))
{
    //
}
</code></pre>

<p><strong>將錯誤訊息套用輸出格式</strong></p>

<pre><code>echo $messages-&gt;first('email', '&lt;p&gt;:message&lt;/p&gt;');
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 錯誤訊息預設採用相容 Bootstrap 樣式的語法。</p>
</blockquote>

<p><strong>將所有錯誤訊息套用輸出格式</strong></p>

<pre><code>foreach ($messages-&gt;all('&lt;li&gt;:message&lt;/li&gt;') as $message)
{
    //
}
</code></pre>

<p><a name="error-messages-and-views"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.error_messages_and_views') }}</h2>

<p>
    一旦你實作了驗證機制，你將需要一個簡單的方法將錯誤訊息輸出到你的視圖當中。 Laravel 可以很方便就處理好這件事。讓我們來看一下面這個路由範例:
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
    當驗證失敗時，我們使用 <code>withErrors</code> 方法傳送 <code>Validator</code> 驗證器。 這個方法會將錯誤訊息快取存入到 session 中，以便我們下一次能夠繼續使用。
</p>

<p>
    注意我們的路由並沒有明確綁定錯誤訊息到視圖中。 這是因為 Laravel 總是會自動檢查 session 資料的正確性，並嘗試把它們綁定到視圖中。 因此非常重要的一點：<strong>在你的所有視圖中，總是會有一個名為 <code>$errors</code> 變數</strong>。這樣可以確保假設 <code>$errors</code> 已經被定義且可以安全使用。 <code>$errors</code> 變數當於一個 <code>MessageBag</code> 訊息包裹。
</p>

<p>
    所以在頁面重新導向後，你可以在你的視圖中使用 <code>$errors</code> 變數:
</p>

<pre><code>&lt;?php echo $errors-&gt;first('email'); ?&gt;
</code></pre>

<p><a name="available-validation-rules"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.available_validation_rules') }}</h2>

<p>下列清單為現行可用的所有驗證規則以及它們的函式:</p>

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
    欄位資料必需為 <em>yes</em> 、 <em>on</em> 、 <em>1</em> 。 這個驗證規則通常被使用在「同意服務條款」之類。
</p>

<p><a name="rule-active-url"></a></p>

<h4>active_url</h4>

<p>
    欄位資料必需符合 PHP <code>checkdnsrr</code> 函式檢查過的有效 URL。
</p>

<p><a name="rule-after"></a></p>

<h4>after:<em>date</em></h4>

<p>
    欄位資料必需在指定的日期時間之後。資料將會透過 PHP <code>strtotime</code> 轉換後比對檢查。
</p>

<p><a name="rule-alpha"></a></p>

<h4>alpha</h4>

<p>
    欄位資料必需是英文字母(a-zA-Z)所組合。
</p>

<p><a name="rule-alpha-dash"></a></p>

<h4>alpha_dash</h4>

<p>
    欄位資料必需是英文字母(a-zA-Z)或數字(0-9)或破折號(-)或底線(_)所組合。
</p>

<p><a name="rule-alpha-num"></a></p>

<h4>alpha_num</h4>

<p>
    欄位資料必需是英文字母(a-zA-Z)或數字(0-9)所組合。
</p>

<p><a name="rule-before"></a></p>

<h4>before:<em>date</em></h4>

<p>
    欄位資料必需在指定的日期時間之前。 資料將會透過 PHP 函式 <code>strtotime</code> 轉換後比對檢查。
</p>

<p><a name="rule-between"></a></p>

<h4>between:<em>min</em>,<em>max</em></h4>

<p>
    欄位資料必需在界於 <em>min</em> 與 <em>max</em> 之間。 適用於字串、數字和檔案的 <code>size</code> 驗證規則。
</p>

<p><a name="rule-confirmed"></a></p>

<h4>confirmed</h4>

<p>
    欄位資料必需和欄位名稱加 <code>_confirmation</code> 的欄位資料一致。 例如一個名稱為 <code>password</code> 的名稱，那麼他就必需和欄位名稱為 <code>password_confirmation</code> 一樣才行。
</p>

<p><a name="rule-date"></a></p>

<h4>date</h4>

<p>
    欄位資料必需一個有效的日期格式。 資料將會透過 PHP 函式 <code>strtotime</code> 轉換後比對檢查。
</p>

<p><a name="rule-date-format"></a></p>

<h4>date_format:<em>format</em></h4>

<p>
    欄位資料必需一個符合指定的<em>日期格式</em>。 資料將會透過 PHP 函式<code>date_parse_from_format</code> 比對檢查。
</p>

<p><a name="rule-different"></a></p>

<h4>different:<em>field</em></h4>

<p>
    欄位資料必需不同於指定的 <em>field</em> 欄位資料。
</p>

<p><a name="rule-email"></a></p>

<h4>email</h4>

<p>
    The field under validation must be formatted as an e-mail address.
</p>

<p><a name="rule-exists"></a></p>

<h4>exists:<em>table</em>,<em>column</em></h4>

<p>
    欄位資料必需存在指定的資料庫表中。
</p>

<p><strong>存在規則基本用法</strong></p>

<pre><code>'state' =&gt; 'exists:states'
</code></pre>

<p><strong>特別指定欄位名稱</strong></p>

<pre><code>'state' =&gt; 'exists:states,abbreviation'
</code></pre>

<p>
    你也許想要再加一些像 "where" 的限制條件:
</p>

<pre><code>'email' =&gt; 'exists:staff,email,account_id,1'
</code></pre>

<p><a name="rule-image"></a></p>

<h4>image</h4>

<p>
    欄位資料必需是個影像檔(jpeg, png, bmp, 或 gif)。
</p>

<p><a name="rule-in"></a></p>

<h4>in:<em>foo</em>,<em>bar</em>,...</h4>

<p>
    欄位資料必需符合所列的清單值之一。
</p>

<p><a name="rule-integer"></a></p>

<h4>integer</h4>

<p>
    欄位資料必需是個整數。
</p>

<p><a name="rule-ip"></a></p>

<h4>ip</h4>

<p>
    欄位資料必需符合 IP 格式。
</p>

<p><a name="rule-max"></a></p>

<h4>max:<em>value</em></h4>

<p>
    欄位資料最大值不能高於 <em>value</em> 。 適用於字串、數字和檔案的 <code>size</code> 驗證規則。
</p>

<p><a name="rule-mimes"></a></p>

<h4>mimes:<em>foo</em>,<em>bar</em>,...</h4>

<p>
    欄案欄位資料必需符合屬於指定所列的 MIME 類型清單中的一項。
</p>

<p><strong>MIME 驗證規則的基本用法</strong></p>

<pre><code>'photo' =&gt; 'mimes:jpeg,bmp,png'
</code></pre>

<p><a name="rule-min"></a></p>

<h4>min:<em>value</em></h4>

<p>
    欄位資料最小值不能低於 <em>value</em> 。適用於字串、數字和檔案的 <code>size</code> 驗證規則。
</p>

<p><a name="rule-not-in"></a></p>

<h4>not_in:<em>foo</em>,<em>bar</em>,...</h4>

<p>
    欄位資料不能是清單裡面的值。
</p>

<p><a name="rule-numeric"></a></p>

<h4>numeric</h4>

<p>
    欄位資料必需為數字。
</p>

<p><a name="rule-regex"></a></p>

<h4>regex:<em>pattern</em></h4>

<p>
    欄位資料必需符合正規表示式的內容。
</p>

<p>
    <strong>注意:</strong> 
    當使用 <code>regex</code> 正規表示式,那就必要使用陣列方法來取代使用"|"符號方法去提供驗證規則，特別當你的正規表示式裡面含有"|"符號時。
</p>

<p><a name="rule-required"></a></p>

<h4>required</h4>

<p>
    欄位資料必需輸入資料
</p>

<p><a name="rule-required-if"></a></p>

<h4>required_if:<em>field</em>,<em>value</em></h4>

<p>
    如果某個指定的 <em>field</em> 欄位資料等於指定的 <em>value</em> 資料。那欄位資料就必需輸入。
</p>

<p><a name="rule-required-with"></a></p>

<h4>required_with:<em>foo</em>,<em>bar</em>,...</h4>

<p>
    只有在某個<em>指定的 field (only if)</em>欄位出現時，那欄位資料就必需輸入。
</p>

<p><a name="rule-same"></a></p>

<h4>same:<em>field</em></h4>

<p>
    欄位資料必需和指定的任外一個 <em>field</em> 欄位資料相符合。
</p>

<p><a name="rule-size"></a></p>

<h4>size:<em>value</em></h4>

<p>
    欄位資料必需符合 size 所指定的 <em>value</em> 值。 <em>value</em> 比對的是字串的長度(字元數)。 <em>value</em> 比對的是整數值。 對檔案資料而言， <em>size</em> 是檔案大小，也就是位元組(kB)。
</p>

<p><a name="rule-unique"></a></p>

<h4>unique:<em>table</em>,<em>column</em>,<em>except</em>,<em>idColumn</em></h4>

<p>
    欄位資料在資料庫表中，必需是唯一的。如果沒有特定指定欄位 <code>column</code> 的選項，預設的欄位名稱將被使用。
</p>

<p><strong>唯一規則的基本用法</strong></p>

<pre><code>'email' =&gt; 'unique:users'
</code></pre>

<p><strong>特別指定一個欄位</strong></p>

<pre><code>'email' =&gt; 'unique:users,email_address'
</code></pre>

<p><strong>檢查唯一規則但忽略指定的ID</strong></p>

<pre><code>'email' =&gt; 'unique:users,email_address,10'
</code></pre>

<p><a name="rule-url"></a></p>

<h4>url</h4>

<p>被驗證的欄位資料格式必須符合網址 (URL) 格式</p>

<p><a name="custom-error-messages"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.validation.custom_error_messages') }}</h2>

<p>
    如果需要，你也可以自訂驗證錯誤訊息來取代原先預設的錯誤訊息。 這裡有幾個方法來指定自訂的訊息。
</p>

<p><strong>傳送自訂訊息到驗證器中</strong></p>

<pre><code>$messages = array(
    'required' =&gt; 'The :attribute field is required.',
);

$validator = Validator::make($input, $rules, $messages);
</code></pre>

<p>
    <em>注意:</em> <code>:attribute</code> 這個補位標誌將會被取代成未驗證欄位實際的名稱。 你也能自行追加其它補位標誌到你的驗證訊息中。
</p>

<p><strong>其它補位標誌</strong></p>

<pre><code>$messages = array(
    'same'    =&gt; 'The :attribute and :other must match.',
    'size'    =&gt; 'The :attribute must be exactly :size.',
    'between' =&gt; 'The :attribute must be between :min - :max.',
    'in'      =&gt; 'The :attribute must be one of the following types: :values',
);
</code></pre>

<p>
    有時候你只想要為特定的欄位指定自訂錯誤訊息:
</p>

<p><strong>為指定欄位自訂訊息</strong></p>

<pre><code>$messages = array(
    'email.required' =&gt; 'We need to know your e-mail address!',
);
</code></pre>

<p>
    在某一些案例中，你可能想要在語系檔中自訂訊息，來代替直接傳送給 <code>Validator</code> 驗證器的作法。 可以將你的自訂訊息追加到 <code>app/lang/xx/validation.php</code>  語系檔 <code>custom</code> 的陣列中。
</p>

<p><strong>以語系檔方式自訂訊息</strong></p>

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

<p><strong>註冊自訂驗證規則</strong></p>

<pre><code>Validator::extend('foo', function($attribute, $value, $parameters)
{
    return $value == 'foo';
});
</code></pre>

<blockquote>
  <p><strong>注意：</strong> 傳入 <code>extend</code> 方法的規則名稱必需是"駝峰式"。</p>
</blockquote>

<p>
    自訂驗證閉包函式有三個參數：欲被驗證欄位名稱 <code>$attribute</code> 、欄位資料 <code>$value</code>，以及參數陣列 <code>$parameters</code> 。
</p>

<p>
    你也能透過 <code>extend</code> "類別@方法" 名稱方式來指定驗證函式:
</p>

<pre><code>Validator::extend('foo', 'FooValidator@validate');
</code></pre>

<p>
    你應該也要為你自訂的規則定義一些錯誤訊息。 你也使用行內訊息陣列
</p>

<p>
    除了使用閉包呼叫函式，另外一種作法是繼承驗證器。 若要這樣做，試著寫一個驗證類別並繼承 <code>Illuminate\Validation\Validator</code> 。 你就能透過前綴詞 <code>validate</code> 來追加一個驗證方法:
</p>

<p><strong>繼承驗證類別</strong></p>

<pre><code>&lt;?php

class CustomValidator extends Illuminate\Validation\Validator {

    public function validateFoo($attribute, $value, $parameters)
    {
        return $value == 'foo';
    }

}
</code></pre>

<p>接下來，你需要為你的驗證規則進行註冊:</p>

<p><strong>註冊自訂規則到驗證剖析器</strong></p>

<pre><code>Validator::resolver(function($translator, $data, $rules, $messages)
{
    return new CustomValidator($translator, $data, $rules, $messages);
});
</code></pre>

<p>
    當建立自訂的驗證規則，你有時候需要定義錯誤訊息的補位標誌。 你可以建立自訂的驗證描述字串如下，追加一個前置詞為 replace 的函式像是 <code>replaceXXX</code> 到你的驗證器中。
</p>

<pre><code>protected function replaceFoo($message, $attribute, $rule, $parameters)
{
    return str_replace(':foo', $parameters[0], $message);
}
</code></pre>
@stop;
@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.helpers') }}</h1>

<ul>
    <li>
        <a href="#arrays">{{ Lang::get('l4doc.docs_title.learning_more.helpers.arrays') }}</a>
    </li>
    <li>
        <a href="#paths">{{ Lang::get('l4doc.docs_title.learning_more.helpers.paths') }}</a>
    </li>
    <li>
        <a href="#strings">{{ Lang::get('l4doc.docs_title.learning_more.helpers.strings') }}</a>
    </li>
    <li>
        <a href="#urls">{{ Lang::get('l4doc.docs_title.learning_more.helpers.urls') }}</a>
    </li>
    <li>
        <a href="#miscellaneous">{{ Lang::get('l4doc.docs_title.learning_more.helpers.miscellaneous') }}</a>
    </li>
</ul>

<p><a name="arrays"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.helpers.arrays') }}</h2>

<h3>array_add</h3>

<p>
    <code>array_add</code> 函式可以將指定的 鍵 (key) / 值 (value) 加入到陣列中，如果陣列已有此 "鍵 (key)" 則不做加入的動作。
</p>

<pre><code>$array = array('foo' =&gt; 'bar');

$array = array_add($array, 'key', 'value');
</code></pre>

<h3>array_divide</h3>

<p>
    <code>array_divide</code> 函式回傳兩組陣列，一個陣列是原 "鍵 (key)" 的陣列，而另一個是原 "值 (value)" 的陣列。
</p>

<pre><code>$array = array('foo' =&gt; 'bar');

list($keys, $values) = array_divide($array);
</code></pre>

<h3>array_dot</h3>

<p>
    <code>array_dot</code> 函式將多維陣列轉換成一維陣列，並使用 "逗號 (.)" 去顯示原陣列資料的深度
</p>

<pre><code>$array = array('foo' =&gt; array('bar' =&gt; 'baz'));

$array = array_dot($array);

// array('foo.bar' =&gt; 'baz');
</code></pre>

<h3>array_except</h3>

<p>
    <code>array_except</code> 方法可以移除陣列中指定的 "鍵 (key)" 值。
</p>

<pre><code>$array = array_except($array, array('keys', 'to', 'remove'));
</code></pre>

<h3>array_fetch</h3>

<p>
    <code>array_fetch</code> 方法可以撈取巢狀陣列的指定 "鍵 (key)" 值。
</p>

<pre><code>$array = array(array('name' =&gt; 'Taylor'), array('name' =&gt; 'Dayle'));

var_dump(array_fetch($array, 'name'));

// array('Taylor', 'Dayle');
</code></pre>

<h3>array_first</h3>

<p>
    <code>array_first</code> 方法回傳第一個符合條件的陣列資料。

<pre><code>$array = array(100, 200, 300);

$value = array_first($array, function($key, $value)
{
    return $value &gt;= 150;
});
</code></pre>

<p>
    也可以在第三個參數設定預設值:
</p>

<pre><code>$value = array_first($array, $callback, $default);
</code></pre>

<h3>array_flatten</h3>

<p>
    <code>array_flatten</code> 方法可以取得多維陣列所有最後的 "值 (value)"。
</p>

<pre><code>$array = array('name' =&gt; 'Joe', 'languages' =&gt; array('PHP', 'Ruby'));

$array = array_flatten($array);

// array('Joe', 'PHP', 'Ruby');
</code></pre>

<h3>array_forget</h3>

<p>
    <code>array_forget</code> 方法會移除使用 "逗號 (.)" 所指定的陣列深度值
</p>

<pre><code>$array = array('names' =&gt; array('joe' =&gt; array('programmer')));

$array = array_forget($array, 'names.joe');
</code></pre>

<h3>array_get</h3>

<p>
    <code>array_get</code> 方法使用 "逗號 (.)" 去取得原陣列深度的資料。
</p>

<pre><code>$array = array('names' =&gt; array('joe' =&gt; array('programmer')));

$value = array_get($array, 'names.joe');
</code></pre>

<h3>array_only</h3>

<p>
    <code>array_only</code> 方法可以取得陣列第一層中，指定的 "鍵 (key)" 資料。
</p>

<pre><code>$array = array('name' =&gt; 'Joe', 'age' =&gt; 27, 'votes' =&gt; 1);

$array = array_only($array, array('name', 'votes'));
// array('name' =&gt; 'Joe', 'votes' =&gt; 1);
</code></pre>

<h3>array_pluck</h3>

<p>
    <code>array_pluck</code> 方法可以取得 row 資料集陣列中，指定的 "鍵 (key)" 資料
</p>

<pre><code>$array = array(array('name' =&gt; 'Taylor'), array('name' =&gt; 'Dayle'));

$array = array_pluck($array, 'name');

// array('Taylor', 'Dayle');
</code></pre>

<h3>array_pull</h3>

<p>
    <code>array_pull</code> 方法可以取得指定的 "鍵 (key)" 資料，並移除原陣列 指定的 "鍵 (key)" 資料
</p>

<pre><code>$array = array('name' =&gt; 'Taylor', 'age' =&gt; 27);

$name = array_pull($array, 'name');
/*
    $name  : array('name' =&gt; 'Taylor');
    $array : array('age' =&gt; 27);
*/
</code></pre>

<h3>array_set</h3>

<p>
    <code>array_set</code> 方法使用 "逗號 (.)" 設定所指定的陣列深度的資料
</p>

<pre><code>$array = array('names' =&gt; array('programmer' =&gt; 'Joe'));

array_set($array, 'names.editor', 'Taylor');
</code></pre>

<h3>array_sort</h3>

<p>
    <code>array_sort</code> 方法會在閉合函式中回傳排序後的資料。
</p>

<pre><code>$array = array(
    array('name' =&gt; 'Jill'),
    array('name' =&gt; 'Barry'),
);

$array = array_values(array_sort($array, function($value)
{
    return $value['name'];
}));
</code></pre>

<h3>head</h3>

<p>
    回傳陣列中第一個元素的資料，經常在方法鏈中使用。
</p>

<pre><code>$first = head(Array('foo' , 'bar'));
// 'foo';

$first = head(Array('foo'=&gt; array(1,2) , 'bar'));
// array(1,2)
</code></pre>

<h3>last</h3>

<p>
    回傳陣列中最後一個元素的資料，經常在方法鏈中使用。
</p>

<pre><code>$last = last(Array('foo' , 'bar'));
// 'bar';

$last = last(Array('foo' , 'bar'=&gt; array(3,4)));
// array(3,4)
</code></pre>

<p><a name="paths"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.helpers.paths') }}</h2>

<h3>app_path</h3>

<p>
    <code>app_path()</code> 方法可以取得 <code>app</code> 目錄的完整路徑。
</p>

<h3>base_path</h3>

<p>
    <code>base_path()</code> 方法可以取得安裝目錄的完整路徑。
</p>

<h3>public_path</h3>

<p>
    <code>public_path()</code> 方法可以取得 <code>public</code> 目錄的完整路徑。
</p>

<h3>storage_path</h3>

<p>
    <code>storage_path()</code> 方法可以取得 <code>app/storage</code> 目錄的完整路徑。
</p>

<p><a name="strings"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.helpers.strings') }}</h2>

<h3>camel_case</h3>

<p>
    轉換給予的字串為 <code>駝峰式大小寫 (camelCase)</code>  形式。
</p>

<pre><code>$camel = camel_case('foo_bar');

// fooBar
</code></pre>

<h3>class_basename</h3>

<p>
    取得不包含 "命名空間(namespace)" 的類別名稱。
</p>

<pre><code>$class = class_basename('Foo\Bar\Baz');

// Baz
</code></pre>

<h3>e</h3>

<p>
    在指定字串執行 <code>htmlentites</code> 方法，且支援 UTF-8 字串編碼。
</p>

<pre><code>$entities = e('&lt;html&gt;foo&lt;/html&gt;');
</code></pre>

<h3>ends_with</h3>

<p>
    判斷字串結尾是否有指定的字串。
</p>

<pre><code>$value = ends_with('This is my name', 'name');
// true
</code></pre>

<h3>snake_case</h3>

<p>
    轉換給予的字串為 <code>蛇底式小寫 (snake_case)</code> 形式。
</p>

<pre><code>$snake = snake_case('fooBar');

// foo_bar
</code></pre>

<h3>starts_with</h3>

<p>
    判斷字串開頭是否有指定的字串。
</p>

<pre><code>$value = starts_with('This is my name', 'This');
// true
</code></pre>

<h3>str_contains</h3>

<p>
    判斷字串中是否有指定的字串。
</p>

<pre><code>$value = str_contains('This is my name', 'my');
</code></pre>

<h3>str_finish</h3>

<p>
    指定字串結尾的最後字元，並確保只有一個指定的結數字元。
</p>

<pre><code>$string = str_finish('this/string', '/');
// this/string/

$string = str_finish('this/string/', '/');
// this/string/

$string = str_finish('this/string////////', '/');
// this/string/
</code></pre>

<h3>str_is</h3>

<p>
    判斷字串是否有符合指定的 模式 (pattern)，星號代表萬用字元。
</p>

<pre><code>$value = str_is('foo*', 'foobar');
</code></pre>

<h3>str_plural</h3>

<p>
    轉換字串為複數形式 (僅限英文)。
</p>

<pre><code>$plural = str_plural('car');
// cars
</code></pre>

<h3>str_random</h3>

<p>
    產生指定長度的亂數字串。
</p>

<pre><code>$string = str_random(40);
// string(40) "1l8P1t9R0bwaDl7RhnYqGovx5ZDp32R0rcPrFLPv"
</code></pre>

<h3>str_singular</h3>

<p>
    轉換字串為單數形式 (僅限英文)。
</p>

<pre><code>$singular = str_singular('cars');
// car
</code></pre>

<h3>studly_case</h3>

<p>
    轉換給予的字串為 <code>首字大寫 (StudlyCase)</code> 形式。
</p>

<pre><code>$value = studly_case('foo_bar');

// FooBar
</code></pre>

<h3>trans</h3>

<p>
    取得語言資料，與 <code>Lang::get</code> 方法相同。
</p>

<pre><code>$value = trans('validation.required'):
</code></pre>

<h3>trans_choice</h3>

<p>
    取得指定單複數型態語言資料，與 <code>Lang::choice</code> 方法相同。
</p>

<pre><code>$value = trans_choice('foo.bar', $count);
</code></pre>

<p><a name="urls"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.helpers.urls') }}</h2>

<h3>action</h3>

<p>
    產生指定控制器動作的網址。
</p>

<pre><code>$url = action('HomeController@getIndex', $params);
// http://example.com/homes/param
</code></pre>

<h3>asset</h3>

<p>產生存取資源的網址</p>

<pre><code>$url = asset('img/photo.jpg');
</code></pre>

<h3>link_to</h3>

<p>產生連結到指定網址的 HTML 連結</p>

<pre><code>echo link_to('foo/bar', '標題', $attributes = array(), $secure = null);
// &lt;a href=&quot;http://example.com/foo/bar&quot;&gt;標題&lt;/a&gt;
</code></pre>

<h3>link_to_asset</h3>

<p>產生連結到指定資源的 HTML 連結</p>

<pre><code>echo link_to_asset('foo/bar.zip', '標題', $attributes = array(), $secure = null);
// &lt;a href=&quot;http://example.com/foo/bar.zip&quot;&gt;標題&lt;/a&gt;

echo link_to_asset('foo/bar.zip', '標題', $attributes = array('title'=>'檔案'), $secure = true);
// &lt;a href=&quot;https://example.com/foo/bar.zip&quot; title=&quot;檔案&quot;&gt;標題&lt;/a&gt;
</code></pre>

<h3>link_to_route</h3>

<p>產生連結到指定路由 (Route) 的 HTML 連結</p>

<pre><code>echo link_to_route('route.name', '標題', $parameters = array(), $attributes = array('title'=>'連結說明'));
// &lt;a href=&quot;http://example.com/route_name&quot; title=&quot;連結說明&quot;&gt;標題&lt;/a&gt;
</code></pre>

<h3>link_to_action</h3>

<p>產生連結到指定控制器 (Controller) 的 HTML 連結</p>

<pre><code>echo link_to_action('HomeController@getIndex', $title, $parameters = array(), $attributes = array('title'=>'連結說明'));
// &lt;a href=&quot;http://example.com/homes&quot; title=&quot;連結說明&quot;&gt;標題&lt;/a&gt;
</code></pre>

<h3>secure_asset</h3>

<p>
    產生使用 HTTPS 存取資源的網址。
</p>

<pre><code>echo secure_asset('foo/bar.zip', $title, $attributes = array());
// https://example.com/foo/bar.zip
</code></pre>

<h3>secure_url</h3>

<p>
    產生使用 HTTPS 存取路徑的網址。
</p>

<pre><code>echo secure_url('foo/bar', $parameters = array());
// https://example.com/foo/bar
</code></pre>

<h3>url</h3>

<p>產生完整的存取路徑網址。</p>

<pre><code>echo url('foo/bar', $parameters = array(), $secure = null);
// http://example.com/foo/bar

echo url('foo/bar', $parameters = array('param1','param2'), $secure = true);
// https://example.com/foo/bar/param1/param2
</code></pre>

<p><a name="miscellaneous"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.helpers.miscellaneous') }}</h2>

<h3>csrf_token</h3>

<p>取得目前的 CSRF 標記 (token)</p>

<pre><code>$token = csrf_token();
</code></pre>

<h3>dd</h3>

<p>列印指定的變數，並中斷執行的程式。</p>

<pre><code>dd($value);
</code></pre>

<h3>value</h3>

<p>
    如果給予 <code>value()</code> 方法的值是 <code>閉合函式</code>，則取得 <code>閉合函式</code> 的回傳直，否則直接回傳傳入的變數值。
</p>

<pre><code>$value = value(function() { return 'bar'; });
// bar

$value = value(function() { });
// NULL

$value = value(array(123));
// array(123)

$value = value('input_string');
// input_string
</code></pre>

<h3>with</h3>

<p>
    回傳指定的物件，經常在方法鏈中使用。
</p>

<pre><code>$value = with(new Foo)-&gt;doWork();
</code></pre>
@stop;
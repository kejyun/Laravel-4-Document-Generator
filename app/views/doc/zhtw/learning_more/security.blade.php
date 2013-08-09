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
    Laravel 目標是讓實作身分驗證變得非常容易，事實上，大部分的驗證設定都已經設定好了，驗證設定檔放在 <code>app/config/auth.php</code>，設定檔中有可以調整驗證行為的選項。
</p>

<p>
     Laravel 預設包含 <code>User</code> 模型，該模型檔案放在 <code>app/models</code> 目錄中，而模型預設使用 Eloquent 來做驗證驅動，請記得在建立 <code>User</code> 模型的資料表時，password 的欄位至少要 60 個字元。
</p>

<p>
    如果你的應用程式沒有使用 Eloquent，你也可以使用 <code>database</code> 驗證驅動，該驅動會使用 Laravel 查詢建立器來做驗證查詢。
</p>

<p><a name="storing-passwords"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.storing_passwords') }}</h2>

<p>Laravel <code>Hash</code> 類別提供一個安全的 Bcrypt 雜湊(hashing):</p>

<p><strong>使用 Bcrypt 做密碼雜湊</strong></p>

<pre><code>$password = Hash::make('secret');
</code></pre>

<p><strong>驗證雜湊密碼</strong></p>

<pre><code>if (Hash::check('secret', $hashedPassword))
{
    // 密碼符合...
}
</code></pre>

<p><strong>檢查密碼是否需要重新雜湊</strong></p>

<pre><code>if (Hash::needsRehash($hashed))
{
    $hashed = Hash::make('secret');
}
</code></pre>

<p><a name="authenticating-users"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.authenticating_users') }}</h2>

<p>
    你可以使用 <code>Auth::attempt</code> 方法讓使用者登入你的應用程式。
</p>

<pre><code>if (Auth::attempt(array('email' =&gt; $email, 'password' =&gt; $password)))
{
    return Redirect::intended('dashboard');
}
</code></pre>

<p>
    注意 <code>email</code> 不是驗證必須要的選項，這裡僅僅是做範例使用，你可以使用任何資料表的欄位名稱當作 "帳號名稱(username)" ， <code>Redirect::intended</code> 方法會將使用者重新導向至被驗證過濾器捕捉前，使用者原先試著存取的網址，也可以給這個方法一個 URI，當無法重新導回使用者原先試著存取的網址時，則會導向至你指定的 URI。
</p>

<p>
    當 <code>attempt</code> 方法被呼叫，<code>auth.attempt</code> <a href="../../docs/events">{{ Lang::get('l4doc.layout.docs_menu.events') }}</a> 將會被觸發，加入驗證成功時 <code>auth.login</code> 事件也會被觸發。
</p>

<p>
    你可以使用 <code>check</code> 方法去判斷使用者是否已經登入到你的應用程式:
</p>

<p><strong>判斷使用者是否被驗證</strong></p>

<pre><code>if (Auth::check())
{
    // 使用者已登入...
}
</code></pre>

<p>
    假如你想要提供 "記住我" 的功能，你可以在 <code>attempt</code> 方法第二個參數傳送 <code>true</code>，這樣將會永遠保持使用者為驗證登入狀態 (直到使用者手動登入):
</p>

<p><strong>驗證使用者並"記住"他們</strong></p>

<pre><code>if (Auth::attempt(array('email' =&gt; $email, 'password' =&gt; $password), true))
{
    // 使用者驗證資訊被記住...
}
</code></pre>

<p>
    <strong>注意:</strong> 假如 <code>attempt</code> 方法回傳 <code>true</code> 時，表示使用者已經成功登入應用程式了
</p>

<p>
    你可能想加入額外的條件到驗證查詢中:
</p>

<p><strong>加入驗證使用者條件</strong></p>

<pre><code>if (Auth::attempt(array('email' =&gt; $email, 'password' =&gt; $password, 'active' =&gt; 1)))
{
    // 使用者帳號啟動中，沒被停權，並且帳號存在
}
</code></pre>

<p>
    只要使用者被驗證後，你就可以存取 User 模型/紀錄:
</p>

<p><strong>存取登入使用者資料</strong></p>

<pre><code>$email = Auth::user()-&gt;email;
</code></pre>

<p>
    可以使用<code>loginUsingId</code>方法，簡單的使用使用者的編號 (ID) 登入應用程式:
</p>

<pre><code>Auth::loginUsingId(1);
</code></pre>

<p>
    <code>validate</code> 方法允許你僅僅驗證使用者身分，而不登入應用程式:
</p>

<p><strong>驗證使用者身分而不登入</strong></p>

<pre><code>if (Auth::validate($credentials))
{
    //
}
</code></pre>

<p>
    你也可以使用 <code>once</code> 方法，在這個請求中登入應用程式一次，而登入資訊不會放到 session 或 cookies 中。
</p>

<p><strong>在單一請求中登入驗證使用者</strong></p>

<pre><code>if (Auth::once($credentials))
{
    //
}
</code></pre>

<p><strong>登出應用程式</strong></p>

<pre><code>Auth::logout();
</code></pre>

<p><a name="manually"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.manually') }}</h2>

<p>
    如果你想要登入一個已經存在於應用程式的使用者帳戶，你只要呼叫 <code>login</code> 方法，並傳送使用者的資料進去即可:
</p>

<pre><code>$user = User::find(1);

Auth::login($user);
</code></pre>

<p>
    這個方法相當於使用 <code>attempt</code> 方法登入使用者帳戶。
</p>

<p><a name="protecting-routes"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.protecting_routes') }}</h2>

<p>
    路由過濾器可以允許只有驗證個使用者可以存取這個路由，Laravel 預設提供 <code>auth</code> 過濾器，而這個過濾器被定義在 <code>app/filters.php</code> 檔案中。
</p>

<p><strong>保護路由</strong></p>

<pre><code>Route::get('profile', array('before' =&gt; 'auth', function()
{
    // 只有驗證過的使用者可以進入...
}));
</code></pre>

<h3>CSRF 保護</h3>

<p>
    Laravel 提供一個簡單的方法保護你的應用程式不會受到跨網站偽造請求的攻擊(CSRF:cross-site request forgeries)
</p>

<p><strong>插入 CSRF 標記到表單中</strong></p>

<pre><code>&lt;input type="hidden" name="_token" value="&lt;?php echo csrf_token(); ?&gt;"&gt;
</code></pre>

<p><strong>驗證傳送的 CSRF 標記</strong></p>

<pre><code>Route::post('register', array('before' =&gt; 'csrf', function()
{
    return '你給了一個合法的 CSRF 標記!';
}));
</code></pre>

<p><a name="http-basic-authentication"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.http_basic_authentication') }}</h2>

<p>
    HTTP 基本驗證提供一個快速的方法去驗證使用者身分，而不用設定一個專用的 "登入" 頁面，在開始時，附加一個 <code>auth.basic</code> 過濾器到你的路由中:
</p>

<p><strong>使用HTTP基本驗證保護路由</strong></p>

<pre><code>Route::get('profile', array('before' =&gt; 'auth.basic', function()
{
    // 只有驗證過的使用者可以進入...
}));
</code></pre>

<p>
    <code>basic</code> 過濾器在預設情況下會使用 <code>email</code> 欄位資料去記錄使用者的驗證狀態，假如你希望使用其他的欄位，你可以傳遞欄位名稱到 <code>basic</code> 方法中:
</p>

<pre><code>return Auth::basic('username');
</code></pre>

<p>
    你也可以使用HTTP基本驗證時，不將使用者登入資訊記錄到 session 中，在做 API 驗證時特別有用，為了達到這樣的目的，訂一個過濾器回傳 <code>onceBasic</code> 方法的資料。
</p>

<p><strong>設定無狀態的HTTP基本過濾器</strong></p>

<pre><code>Route::filter('basic.once', function()
{
    return Auth::onceBasic();
});
</code></pre>

<p><a name="password-reminders-and-reset"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.password_reminders_and_reset') }}</h2>

<h3>傳送密碼提醒</h3>

<p>
    大部分的應用程式提供方法讓使用者重設他們忘記的密碼，與其強迫你在每個應用程式重新實作這個功能，Laravel 提供一個非常方便方法去傳送密碼提示及做密碼重設，在開始前，確認你的 <code>User</code> 模型有時實作 <code>Illuminate\Auth\Reminders\RemindableInterface</code> 介面的功能，，當然包含在 Laravel 中的 <code>User</code> 模型已經實作了這個介面。
</p>

<p><strong>實作 RemindableInterface 介面</strong></p>

<pre><code>class User extends Eloquent implements RemindableInterface {

    public function getReminderEmail()
    {
        return $this-&gt;email;
    }

}
</code></pre>

<p>
    接下來，必須建立資料表去儲存密碼重設標記 (token)，只要在 Artisan 執行 <code>auth:reminders</code> 就可以 migration 這個資料表:
</p>

<p><strong>產生忘記密碼資料表 Migration</strong></p>

<pre><code>php artisan auth:reminders

php artisan migrate
</code></pre>

<p>
    我們可以使用 <code>Password::remind</code> 方法去傳送密碼重設提示:
</p>

<p><strong>傳送密碼重設提示</strong></p>

<pre><code>Route::post('password/remind', function()
{
    $credentials = array('email' =&gt; Input::get('email'));

    return Password::remind($credentials);
});
</code></pre>

<p>
    注意，傳送到 <code>remind</code> 方法的參數與傳送到 <code>Auth::attempt</code> 的方法類似，這個方法將會取得 <code>User</code> 模型的資料，並透過 E-mail 傳送一個密碼重設連結給使用者，Email 視圖將會傳送一個到重設密碼頁的連結，並帶著 <code>token</code> 變數在這個連結上， <code>user</code> 物件資訊也會傳送到視圖上。
</p>

<blockquote>
  <p><strong>注意:</strong> 你也可以透過 <code>auth.reminder.email</code> 選項，去自訂重設密碼郵件的視圖，當然已經有提供預設的視圖了</p>
</blockquote>

<p>
    你也可以透過傳送給 <code>remind</code> 第二個參數，去變更發送給使用者郵件的內容:
</p>


<pre><code>return Password::remind($credentials, function($message, $user)
{
    $message-&gt;subject('Your Password Reminder');
});
</code></pre>

<p>
    你可能會注意到我們直接回傳 <code>remind</code> 的結果給路由，在預設情況下， <code>remind</code> 方法將會傳送一個<code>重導 (Redirect)</code> 到目前網址的 URI，假如嘗試重設密碼時發生錯誤， <code>error</code> 變數將會寫到 session 中，還有一個原因的 <code>reason</code> 變數會被從 <code>reminders</code> 語言檔中取得，假如密碼重設成功，則 <code>success</code> 變數將會寫到 session 中，所以你的密碼重設表單看起來會像這樣:
</p>


<pre><code>(@)if (Session::has('error'))
    ({)({) trans(Session::get('reason')) (})(})
(@)elseif (Session::has('success'))
    An e-mail with the password reset has been sent.
(@)endif

&lt;input type="text" name="email"&gt;
&lt;input type="submit" value="Send Reminder"&gt;
</code></pre>

<h3>重設密碼</h3>

<p>
    只要使用者點擊了重設密碼提示郵件中的重設密碼連結，則會被導向到一個有 <code>token</code> 欄位的表單，以及 <code>password</code> 及 <code>password_confirmation</code> 欄位，以下是一個路由至密碼重設表單的範例:
</p>

<pre><code>Route::get('password/reset/{token}', function($token)
{
    return View::make('auth.reset')-&gt;with('token', $token);
});
</code></pre>

<p>密碼重設表單看起來會像:</p>

<pre><code>(@)if (Session::has('error'))
    ({)({) trans(Session::get('reason')) (})(})
(@)endif

&lt;input type="hidden" name="token" value="({)({) $token (})(})"&gt;
&lt;input type="text" name="email"&gt;
&lt;input type="password" name="password"&gt;
&lt;input type="password" name="password_confirmation"&gt;
</code></pre>

<p>
    再次強調，我們在重設密碼偵錯到錯誤時，會使用 <code>Session</code> 去顯示所有的錯誤，，接下來，我們可以定義一個 <code>POST</code> 路由來處理重設密碼:
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
    如果密碼重設成功， <code>User</code> 實例及密碼將會傳送到你的閉合函式中，允許你真的去執行儲存新密碼的操作，接下來你可以在 <code>reset</code> 方法中回傳 <code>Redirect</code> 轉址或者任何其他類型的回應，這邊要注意到，<code>reset</code>方法將會自動檢查在這個請求的 <code>標記 (token)</code> 及驗證是否合法，以及密碼與確認密碼是否符合。
</p>

<p>
    與 <code>remind</code> 方法類似的地方是，假如重設密碼時發生錯誤十， <code>reset</code> 方法將會傳送 <code>error</code> 及 <code>reason</code> 兩個變數資料，並 <code>重導 (Redirect)</code> 到目前的 URI。
</p>

<p><a name="encryption"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.learning_more.security.encryption') }}</h2>

<p>
    Laravel 透過 PHP 的 mcrypt 延伸套件，提供了強大的 AES-256 加密方法:
</p>

<p><strong>加密</strong></p>

<pre><code>$encrypted = Crypt::encrypt('secret');
</code></pre>

<blockquote>
  <p><strong>注意:</strong> 必須要確認在 <code>app/config/app.php</code> 檔案中，有設定一個長度為 32 的亂數字串到 <code>key</code> 選項中，否則加密值會很不安全。</p>
</blockquote>

<p><strong>解密</strong></p>

<pre><code>$decrypted = Crypt::decrypt($encryptedValue);
</code></pre>

<p>
    你也可以設定加密器的 密碼(cipher) 及 模式(mode):
</p>

<p><strong>設定密碼(cipher) 及 模式(mode)</strong></p>

<pre><code>Crypt::setMode('crt');

Crypt::setCipher($cipher);
</code></pre>
@stop;
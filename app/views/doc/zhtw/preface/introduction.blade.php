@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.introduction') }}</h1>

<ul>
    <li>
        <a href="#laravel-philosophy">{{ Lang::get('l4doc.docs_title.preface.introduction.laravel_philosophy') }}</a>
    </li>
    <li>
        <a href="#learning-laravel">{{ Lang::get('l4doc.docs_title.preface.introduction.learning_laravel') }}</a>
    </li>
    <li>
        <a href="#development-team">{{ Lang::get('l4doc.docs_title.preface.introduction.development_team') }}</a>
    </li>
    <li>
        <a href="#framework-sponsors">{{ Lang::get('l4doc.docs_title.preface.introduction.framework_sponsors') }}</a>
    </li>
</ul>

<p><a name="laravel-philosophy"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.introduction.laravel_philosophy') }}</h2>

<p>
    Laravel 是網頁應用程式的框架，使用優雅的語意。我們認為開發必須是愉快的，這樣創意的體驗才能真正地被實現。Laravel 嘗試著除去開發專案時，常遇到的的痛苦，像身分驗證(authentication)、路由(routing)、session及快取(cache)。
</p>

<p>
    Laravel的目標在於使開發者在沒有犧牲應用程式功能為前提，讓開發過程是愉悅的。快樂的開發者能夠做出最好的程式，為了這個目標，我們試圖去整合我們看過其他網頁框架中最佳的優點，包括其他語言開的網頁框架，像是 Ruby on Rails 、 ASP.NET MVC 及 Sinatra。
</p>

<p>
    Laravel 是容易入門的，但卻是功能強大，提供健壯網頁應用程式強大的工具，一個極好的反轉控制容器(IoC)，語意表達式的 Migration 系統，支援緊密整合的單元測試，給你需要的工具去，建造你工作上的任何網頁應用程式。
</p>

<p><a name="learning-laravel"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.introduction.learning_laravel') }}</h2>

<p>
    學習 Laravel 其中一個最佳的方法是閱讀整份說明文件，這份文件詳細說明 Laravel 框架各方面的功能，及如何將 Laravel 實作應用在你的網頁應用程式。
</p>

<p>
    除了本份文件，您不妨可以看看一些 <a href="http://wiki.laravel.io/Books">Laravel相關書籍</a> ，這個社群撰寫的書籍，可以做為學習 Laravel 網頁程式框架的一個不錯的補充說明資訊。
</p>

<ul>
    <li><a href="https://leanpub.com/codebright" target="_blank">Code Bright</a> 作者 Dayle Rees</li>
    <li><a href="https://leanpub.com/laravel-testing-decoded" target="_blank">Laravel Testing Decoded</a> 作者 Jeffrey Way</li>
</ul>

<p><a name="development-team"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.introduction.development_team') }}</h2>

<p>
    Laravel是由<a href="https://github.com/taylorotwell" target="_blank">Taylor Otwell</a>建立的，其他對 Laravel 有貢獻的傑出的社群成員包含 <a href="https://github.com/daylerees" target="_blank">Dayle Rees</a>, <a href="https://github.com/ShawnMcCool" target="_blank">Shawn McCool</a>、<a href="https://github.com/JeffreyWay" target="_blank">Jeffrey Way</a>、<a href="https://github.com/jasonlewis" target="_blank">Jason Lewis</a>、<a href="https://github.com/bencorlett" target="_blank">Ben Corlett</a>、<a href="https://github.com/franzliedke" target="_blank">Franz Liedke</a>、<a href="https://github.com/driesvints" target="_blank">Dries Vints</a>、<a href="https://github.com/crynobone" target="_blank">Mior Muhammed Zaki</a> 及 <a href="https://github.com/philsturgeon" target="_blank">Phil Sturgeon</a>
</p>

<p><a name="framework-sponsors"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.introduction.framework_sponsors') }}</h2>

<p>
    以下的組織有對發展 Laravel 網頁框架，做資金上的的支援:
</p>

<ul>
    <li><a href="http://userscape.com" target="_blank">UserScape</a></li>
    <li><a href="http://cartalyst.com" target="_blank">Cartalyst</a></li>
    <li><a href="http://ellidavis.com" target="_blank">Elli Davis - Toronto Realtor</a></li>
    <li><a href="http://jaybanks.ca/vancouver-lofts-condos" target="_blank">Jay Banks - Vancouver Lofts &amp; Condos</a></li>
    <li><a href="http://juliekinnear.com/toronoto-mls-listings" target="_blank">Julie Kinnear - Toronto MLS</a></li>
    <li><a href="http://jamiesarner.com" target="_blank">Jamie Sarner - Toronto Real Estate</a></li>
</ul>
@stop;
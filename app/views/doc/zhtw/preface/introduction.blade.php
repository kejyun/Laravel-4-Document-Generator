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
    Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.
</p>

<p>
    Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.
</p>

<p>
    Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.
</p>

<p><a name="learning-laravel"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.introduction.learning_laravel') }}</h2>

<p>
    One of the best ways to learn Laravel is to read through the entirety of its documentation. This guide details all aspects of the framework and how to apply them to your application.
</p>

<p>
    In addition to this guide, you may wish to check out some <a href="http://wiki.laravel.io/Books">Laravel books</a>. These community written books serve as a good supplemental resource for learning about the framework:
</p>

<ul>
    <li><a href="https://leanpub.com/codebright" target="_blank">Code Bright</a> by Dayle Rees</li>
    <li><a href="https://leanpub.com/laravel-testing-decoded" target="_blank">Laravel Testing Decoded</a> by Jeffrey Way</li>
</ul>

<p><a name="development-team"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.introduction.development_team') }}</h2>

<p>
    Laravel was created by <a href="https://github.com/taylorotwell">Taylor Otwell</a>, who continues to lead development of the framework. Other prominent community members and contributors include <a href="https://github.com/daylerees">Dayle Rees</a>, <a href="https://github.com/ShawnMcCool">Shawn McCool</a>, <a href="https://github.com/JeffreyWay">Jeffrey Way</a>, <a href="https://github.com/jasonlewis">Jason Lewis</a>, <a href="https://github.com/bencorlett">Ben Corlett</a>, <a href="https://github.com/franzliedke">Franz Liedke</a>, <a href="https://github.com/driesvints">Dries Vints</a>, <a href="https://github.com/crynobone">Mior Muhammed Zaki</a>, and <a href="https://github.com/philsturgeon">Phil Sturgeon</a>.
</p>

<p><a name="framework-sponsors"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.introduction.framework_sponsors') }}</h2>

<p>The following organizations have made financial contributions to the development of the Laravel framework:</p>

<ul>
    <li><a href="http://userscape.com">UserScape</a></li>
    <li><a href="http://cartalyst.com">Cartalyst</a></li>
    <li><a href="http://ellidavis.com">Elli Davis - Toronto Realtor</a></li>
    <li><a href="http://jaybanks.ca/vancouver-lofts-condos">Jay Banks - Vancouver Lofts &amp; Condos</a></li>
    <li><a href="http://juliekinnear.com/toronoto-mls-listings">Julie Kinnear - Toronto MLS</a></li>
    <li><a href="http://jamiesarner.com">Jamie Sarner - Toronto Real Estate</a></li>
</ul>
@stop;
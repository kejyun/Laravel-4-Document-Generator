<!DOCTYPE html>
<!-- 
 作者:KeJyun
 建立日期:2013-06-09
 最後修改日期:2013-08-11
 聯絡方式:kejyun@gmail.com
 -->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{{ Lang::get('l4doc.layout.title') }}{{ $doc_title }}</title>
<link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico">
<meta name="description" content="{{ Lang::get('l4doc.layout.meta.description') }}">
<meta name="keyword" content="{{ Lang::get('l4doc.layout.meta.keyword') }}" />

<link media="all" type="text/css" rel="stylesheet" href="../../css/style.css">
<script src="../../js/modernizr-2.6.2.min.js"></script>

<style type="text/css">
.docs-menu ul li{
    margin-top: 10px;
}
.to-top{
    right: 515px;
}
body{
    font-family: "Helvetica Neue", Arial, 微軟正黑體, "Microsoft JhengHei", 新細明體, "Lucida Grande", "Lucida Sans Unicode", sans-serif;
}
</style>
</head>
<body>
<!-- Header -->
<header>
    <div class="container">
        <a href="http://laravel.com/" title="Laravel PHP Framework" class="logo" target="_blank">&nbsp;</a>
        <nav class="menu">
            <ul>
                <li>
                    <a href="http://laravel.com/" title="{{ Lang::get('l4doc.layout.header.welcome') }}" target="_blank">{{ Lang::get('l4doc.layout.header.welcome') }}</a>
                </li>
                <li>
                    <a href="http://laravel.com/docs" title="{{ Lang::get('l4doc.layout.header.documentation') }}" target="_blank">{{ Lang::get('l4doc.layout.header.documentation') }}</a>
                </li>
                <li class="active">
                    <a href="../../docs/introduction" title="{{ Lang::get('l4doc.layout.header.documentation_trans_language') }}">{{ Lang::get('l4doc.layout.header.documentation_trans_language') }}</a>
                </li>
                <li>
                    <a href="http://laravel.com/api" title="{{ Lang::get('l4doc.layout.header.api') }}" target="_blank">{{ Lang::get('l4doc.layout.header.api') }}</a>
                </li>
                <li>
                    <a href="https://github.com/laravel/laravel" title="{{ Lang::get('l4doc.layout.header.github') }}" target="_blank">{{ Lang::get('l4doc.layout.header.github') }}</a>
                </li>
                <li>
                    <a href="http://forums.laravel.io/" title="{{ Lang::get('l4doc.layout.header.forums') }}" target="_blank">{{ Lang::get('l4doc.layout.header.forums') }}</a>
                </li>
                <li>
                    <a href="http://twitter.com/laravelphp" title="{{ Lang::get('l4doc.layout.header.twitter') }}" target="_blank">{{ Lang::get('l4doc.layout.header.twitter') }}</a>
                </li>
            </ul>
        </nav>
        <a class="to-top">回到最上方</a>

    </div>
</header>

<!-- Header sectoin -->
<section class="docs-heading">
    <div class="container">
        <h2>{{ Lang::get('l4doc.layout.logo_header.title') }}</h2>
        <div class="sponsor">
            <span>{{ Lang::get('l4doc.layout.logo_header.sponsored') }} </span>
            <a href="http://www.cartalyst.com/" title="Cartalyst" target="_blank">
                <img src="../../img/cartalyst_small.png">
            </a>
        </div>
    </div>
</section>

<section class="docs-content">
    <div class="container">
    <nav class="docs-menu">
        <ul>
            <li>{{ Lang::get('l4doc.layout.docs_menu.preface') }}
                <ul>
                    <li><a href="../../docs/introduction">{{ Lang::get('l4doc.layout.docs_menu.introduction') }}</a></li>
                    <li><a href="../../docs/quick">{{ Lang::get('l4doc.layout.docs_menu.quick') }}</a></li>
                    <li><a href="../../docs/contributing">{{ Lang::get('l4doc.layout.docs_menu.contributing') }}</a></li>
                </ul>
            </li>
            <li>
                {{ Lang::get('l4doc.layout.docs_menu.getting_started') }}
                <ul>
                    <li><a href="../../docs/installation">{{ Lang::get('l4doc.layout.docs_menu.installation') }}</a></li>
                    <li><a href="../../docs/configuration">{{ Lang::get('l4doc.layout.docs_menu.configuration') }}</a></li>
                    <li><a href="../../docs/lifecycle">{{ Lang::get('l4doc.layout.docs_menu.lifecycle') }}</a></li>
                    <li><a href="../../docs/routing">{{ Lang::get('l4doc.layout.docs_menu.routing') }}</a></li>
                    <li><a href="../../docs/requests">{{ Lang::get('l4doc.layout.docs_menu.requests') }}</a></li>
                    <li><a href="../../docs/responses">{{ Lang::get('l4doc.layout.docs_menu.responses') }}</a></li>
                    <li><a href="../../docs/controllers">{{ Lang::get('l4doc.layout.docs_menu.controllers') }}</a></li>
                    <li><a href="../../docs/errors">{{ Lang::get('l4doc.layout.docs_menu.errors') }}</a></li>
                </ul>
            </li>

            <li>
                {{ Lang::get('l4doc.layout.docs_menu.learning_more') }}
                <ul>
                <li><a href="../../docs/cache">{{ Lang::get('l4doc.layout.docs_menu.cache') }}</a></li>
                <li><a href="../../docs/events">{{ Lang::get('l4doc.layout.docs_menu.events') }}</a></li>
                <li><a href="../../docs/facades">{{ Lang::get('l4doc.layout.docs_menu.facades') }}</a></li>
                <li><a href="../../docs/html">{{ Lang::get('l4doc.layout.docs_menu.html') }}</a></li>
                <li><a href="../../docs/helpers">{{ Lang::get('l4doc.layout.docs_menu.helpers') }}</a></li>
                <li><a href="../../docs/ioc">{{ Lang::get('l4doc.layout.docs_menu.ioc') }}</a></li>
                <li><a href="../../docs/localization">{{ Lang::get('l4doc.layout.docs_menu.localization') }}</a></li>
                <li><a href="../../docs/mail">{{ Lang::get('l4doc.layout.docs_menu.mail') }}</a></li>
                <li><a href="../../docs/packages">{{ Lang::get('l4doc.layout.docs_menu.packages') }}</a></li>
                <li><a href="../../docs/pagination">{{ Lang::get('l4doc.layout.docs_menu.pagination') }}</a></li>
                <li><a href="../../docs/queues">{{ Lang::get('l4doc.layout.docs_menu.queues') }}</a></li>
                <li><a href="../../docs/security">{{ Lang::get('l4doc.layout.docs_menu.security') }}</a></li>
                <li><a href="../../docs/session">{{ Lang::get('l4doc.layout.docs_menu.session') }}</a></li>
                <li><a href="../../docs/templates">{{ Lang::get('l4doc.layout.docs_menu.templates') }}</a></li>
                <li><a href="../../docs/testing">{{ Lang::get('l4doc.layout.docs_menu.testing') }}</a></li>
                <li><a href="../../docs/validation">{{ Lang::get('l4doc.layout.docs_menu.validation') }}</a></li>
                </ul>
            </li>
            <li>
                {{ Lang::get('l4doc.layout.docs_menu.db') }}
                <ul>
                    <li><a href="../../docs/database">{{ Lang::get('l4doc.layout.docs_menu.database') }}</a></li>
                    <li><a href="../../docs/queries">{{ Lang::get('l4doc.layout.docs_menu.queries') }}</a></li>
                    <li><a href="../../docs/eloquent">{{ Lang::get('l4doc.layout.docs_menu.eloquent') }}</a></li>
                    <li><a href="../../docs/schema">{{ Lang::get('l4doc.layout.docs_menu.schema') }}</a></li>
                    <li><a href="../../docs/migrations">{{ Lang::get('l4doc.layout.docs_menu.migrations') }}</a></li>
                    <li><a href="../../docs/redis">{{ Lang::get('l4doc.layout.docs_menu.redis') }}</a></li>
                </ul>
            </li>

            <li>
                {{ Lang::get('l4doc.layout.docs_menu.artisancli') }}
                <ul>
                    <li><a href="../../docs/artisan">{{ Lang::get('l4doc.layout.docs_menu.artisan') }}</a></li>
                    <li><a href="../../docs/commands">{{ Lang::get('l4doc.layout.docs_menu.commands') }}</a></li>
                </ul>
            </li>
        </ul>
    </nav>


    <article class="docs-body">
        @yield('content')
    </article>
    <div class="clearfix"></div>
    </div>
</section>



<footer>
    <div class="container">
        <a href="http://laravel.com/" title="Laravel PHP Framework" class="logo" target="_blank">
            <img src="http://laravel.com/img/footer_logo.png" alt="Laravel PHP Framework">
        </a>
        <nav class="menu">
            <ul>
                <li>
                    <a href="http://laravel.com/" title="{{ Lang::get('l4doc.layout.header.welcome') }}" target="_blank">{{ Lang::get('l4doc.layout.header.welcome') }}</a>
                </li>
                <li>
                    <a href="http://laravel.com/docs" title="{{ Lang::get('l4doc.layout.header.documentation') }}" target="_blank">{{ Lang::get('l4doc.layout.header.documentation') }}</a>
                </li>
                <li class="active">
                    <a href="../../docs/introduction" title="{{ Lang::get('l4doc.layout.header.documentation_trans_language') }}">{{ Lang::get('l4doc.layout.header.documentation_trans_language') }}</a>
                </li>
                <li>
                    <a href="http://laravel.com/api" title="{{ Lang::get('l4doc.layout.header.api') }}" target="_blank">{{ Lang::get('l4doc.layout.header.api') }}</a>
                </li>
                <li>
                    <a href="https://github.com/laravel/laravel" title="{{ Lang::get('l4doc.layout.header.github') }}" target="_blank">{{ Lang::get('l4doc.layout.header.github') }}</a>
                </li>
                <li>
                    <a href="http://forums.laravel.io/" title="{{ Lang::get('l4doc.layout.header.forums') }}" target="_blank">{{ Lang::get('l4doc.layout.header.forums') }}</a>
                </li>
                <li>
                    <a href="http://twitter.com/laravelphp" title="{{ Lang::get('l4doc.layout.header.twitter') }}" target="_blank">{{ Lang::get('l4doc.layout.header.twitter') }}</a>
                </li>
            </ul>
        </nav>
        <p class="copyright">Copyright &copy; 2013 Taylor Otwell. 網站由 <a href="http://casserolelabs.com/" title="Casserole Labs" target="_blank">Casserole Labs</a> 及 <a href="http://daylerees.com" title="Dayle Rees">Dayle Rees</a> 設計，中文翻譯 <a href="http://blog.kejyun.com" target="_blank">KeJyun</a> 及 <a href="http://blog.liaosankai.com" target="_blank">SANKAI</a> </p>
    </div>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="http://laravel.com/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="../../js/plugins.js"></script>
<script src="../../js/main.min.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-31063691-6', 'kejyun.github.io');
  ga('send', 'pageview');
</script>
</body>
</html>
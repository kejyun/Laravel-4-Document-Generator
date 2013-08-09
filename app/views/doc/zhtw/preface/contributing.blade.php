@section('content')
<h1>{{ Lang::get('l4doc.layout.docs_menu.contributing') }}</h1>

<ul>
	<li>
		<a href="#introduction">{{ Lang::get('l4doc.docs_title.preface.contributing.introduction') }}</a>
	</li>
	<li>
		<a href="#pull-requests">{{ Lang::get('l4doc.docs_title.preface.contributing.pull_requests') }}</a>
	</li>
	<li>
		<a href="#coding-guidelines">{{ Lang::get('l4doc.docs_title.preface.contributing.coding_guidelines') }}</a>
	</li>
</ul>

<p><a name="introduction"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.contributing.introduction') }}</h2>

<p>
	Laravel 是免費的開源軟體，意味著任何人都可以對 Laravel 的發展與進步做出貢獻，Laravel 原始碼託管在 <a href="http://github.com" target="_blank">Github</a>， Github提供一個簡單的方法去開發專案分支(fork)及合併你對專案的貢獻
</p>

<p><a name="pull-requests"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.contributing.pull_requests') }}</h2>

<p>
	Laravel 的新功能(New Features)及臭蟲回報(Bugs)的 Pull 請求的過程中並不相同，在發出新功能(New Features)的 Pull 請求，你應該先建立一個有 <code>[Proposal]</code> 為標題的議題，這個提議議題中，必須描述新功能的特徵，以及實作的想法，則該提議的議題將被審查是否通過或拒絕，一旦通過審查， Pull 請求將會被實作在新的功能中，若 Pull請求沒有遵循這樣的準則，則此 Pull請求的議題將會被立即關閉。
</p>

<p>
	在發出臭蟲回報(Bugs)的 Pull 請求或許不會建立任何提議的議題，如果你知道已經提交到github檔案中，任何臭蟲的解決方案，請留言詳細說明您建議修復的細節資訊給我們。
</p>

<h3>功能請求(Feature Requests)</h3>

<p>
	如果你有想要加入新功能到 Laravel 的點子的話，你或許可以在 Github 建立一個有 <code>[Request]</code> 為標題的議題，這個 Laravel 核心的貢獻成員將會審查您提出的功能請求。
</p>

<p><a name="coding-guidelines" target="_blank"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.contributing.coding_guidelines') }}</h2>

<p>
	Laravel 遵循 <a href="https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md" target="_blank">PSR-0</a> 及 <a href="https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md" target="_blank">PSR-1</a> 的程式碼標準規範，除了這些標準，下面的列表是其他應被遵循的程式碼標準:
</p>

<ul>
	<li>命名空間 (Namespace) 的定義應該與 <code>&lt;?php</code> 在同一行</li>
	<li>類別 (Class) 的起始大括號 <code>{</code> 應該和類別名稱(Class Name)在同一行</li>
	<li>函式 (Function) 及控制結構 (control structure) 的起始大括號 <code>{</code> 應該在不同行中呈現</li>
	<li>介面 (Interface) 名稱的後綴字必須要有 <code>Interface</code> (<code>FooInterface</code>)</li>
</ul>
@stop;
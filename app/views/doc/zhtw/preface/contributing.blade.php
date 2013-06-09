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
	Laravel is free, open-source software, meaning anyone can contribute to its development and progress. Laravel source code is currently hosted on <a href="http://github.com" target="_blank">Github</a>, which provides an easy method for forking the project and merging your contributions.
</p>

<p><a name="pull-requests"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.contributing.pull_requests') }}</h2>

<p>
	The pull request process differs for new features and bugs. Before sending a pull request for a new feature, you should first create an issue with <code>[Proposal]</code> in the title. The proposal should describe the new feature, as well as implementation ideas. The proposal will then be reviewed and either approved or denied. Once a proposal is approved, a pull request may be created implementing the new feature. Pull requests which do not follow this guideline will be closed immediately.
</p>

<p>
	Pull requests for bugs may be sent without creating any proposal issue. If you believe that you know of a solution for a bug that has been filed on Github, please leave a comment detailing your proposed fix.
</p>

<h3>Feature Requests</h3>

<p>
	If you have an idea for a new feature you would like to see added to Laravel, you may create an issue on Github with <code>[Request]</code> in the title. The feature request will then be reviewed by a core contributor.
</p>

<p><a name="coding-guidelines" target="_blank"></a></p>

<h2>{{ Lang::get('l4doc.docs_title.preface.contributing.coding_guidelines') }}</h2>

<p>
	Laravel follows the <a href="https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md" target="_blank">PSR-0</a> and <a href="https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md" target="_blank">PSR-1</a> coding standards. In addition to these standards, below is a list of other coding standards that should be followed:
</p>

<ul>
	<li>Namespace declarations should be on the same line as <code>&lt;?php</code>.</li>
	<li>Class opening <code>{</code> should be on the same line as the class name.</li>
	<li>Function and control structure opening <code>{</code> should be on a separate line.</li>
	<li>Interface names are suffixed with <code>Interface</code> (<code>FooInterface</code>)</li>
</ul>
@stop;
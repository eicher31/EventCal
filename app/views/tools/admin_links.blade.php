
@if (Auth::check() && Auth::user()->is_admin && Request::is('admin*'))
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#navbar-admin" aria-expanded="false"
				aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
		</div>
		<div id="navbar-admin" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				{{ HTML::nav_link('admin/users', Lang::get('message.adminUsers')) }}
				{{ HTML::nav_link('admin/category', Lang::get('message.adminCategory')) }}
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>
@endif
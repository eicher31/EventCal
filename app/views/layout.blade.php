<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>EventCal</title>
	</head>
	<body>
		<header>
			<h1>EventCal</h1>
			<div>Menus...</div>
			<div>
				@if (Auth::guest())
					{{ link_to('connexion', 'Connexion') }}
				@endif
				
				@if (Auth::check())
					{{ link_to('deconnexion', 'Déconnexion') }}
				@endif
			</div>
		</header>

		@if (Session::get('notification'))
		<div style="background-color: green;">
			{{{ Session::get('notification') }}}
		</div>
		@endif
		
		<hr />

		<div id="contenu">@yield('contenu')</div>

		<hr />

		<footer>
			<p>&copy; EventCal 2014</p>
			@if (Auth::check() && Auth::user()->is_admin)
				{{ link_to('admin', 'Administration') }}
			@endif
		</footer>
	</body>
</html>
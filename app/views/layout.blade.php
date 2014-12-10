<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>{{Lang::get('message.titleEventCal')}}</title>
		
		<!-- {{ Helpers::css() }} -->
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-theme.min.css') }}
		{{ HTML::style('css/theme.css') }}
		
		@yield('css')
	</head>
	<body>
		    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		      <div class="container">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="{{ url('/') }}">{{Lang::get('message.titleEventCal')}}</a>
		        </div>
		        <div id="navbar" class="collapse navbar-collapse">
		          <ul class="nav navbar-nav">
		          	{{ HTML::nav_link('/', Lang::get('message.homepage')) }}
		          	{{ HTML::nav_link('societies', Lang::get('message.theSociety')) }}
		          	
          			{{ HTML::nav_link('about', Lang::get('message.aPropos')) }}
		          	
		          	@if (Auth::check() && Auth::user()->is_admin)
						{{ HTML::nav_link('admin', Lang::get('message.admin')) }}
					@endif
		          	
					@if (Auth::guest())
						{{ HTML::nav_link('connect', Lang::get('message.connexion')) }}
					@else
						{{ HTML::nav_link('profile', Lang::get('message.profile')) }}
						{{ HTML::nav_link('disconnect', Lang::get('message.disconnexion')) }}
					@endif
		          </ul>
		        </div><!--/.nav-collapse -->
		      </div>
		    </nav>
 
 		
	    <div class="container">
	      	<div class="starter-template">
	      		@include('tools.admin_links')
	      		
				@if (Session::has('notification'))
					{{ Alert::success(Session::get('notification'))->close() }}
				@endif
	      	
				@yield('contenu')
			</div>
    	</div>
		
		<footer>
			<div class="container">
		      	<div class="starter-template">
					<p>{{Lang::get('message.footer')}}</p>
				</div>
	    	</div>
		</footer>
		
		<!-- {{ Helpers::js() }} -->
		{{ HTML::script('js/jquery-2.1.0.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		
		@yield('js')
	</body>
</html>
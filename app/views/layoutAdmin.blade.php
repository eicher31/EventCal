<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>{{Lang::get('message.adminTitle')}}</title>
		
		<!-- {{ Helpers::css() }} -->
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-theme.min.css') }}
		{{ HTML::style('css/theme.css') }}
	</head>
	
	<body>
		    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		      <div class="container">
		      
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="{{ url('/') }}">EventCal</a>
		        </div
		        
		        <div id="navbar" class="collapse navbar-collapse">
		          <ul class="nav navbar-nav">
		            <li class="active"><a href="{{ url('/') }} ">Accueil</a></li>
					<li>{{ link_to('deconnexion', 'Déconnexion') }}</li>
					<li>{{ link_to('admin', 'Utilisateurs') }}</li>
					<li>{{ link_to('admin/category', 'Catégorie') }}</li>
		          </ul>
		        </div><!--/.nav-collapse -->
		        
		      </div>
		    </nav>
 
 		
	    <div class="container">
	      	<div class="starter-template">
				@if (Session::has('notification'))
					{{ Alert::success(Session::get('notification'))->close() }}
				@endif
	      		<div class="row">
				@yield('contenu')
				</div>
			</div>
    	</div>
		
		<footer>
			<div class="container">
		      	<div class="starter-template">
					<p class="lead">{{\Lang::get('message.lead')}}</p>
				</div>
	    	</div>
		</footer>
		
		<!-- {{ Helpers::js() }} -->
		{{ HTML::script('js/jquery-2.1.0.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
	</body>
</html>
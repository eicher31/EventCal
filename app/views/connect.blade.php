@extends('layout')

@section('contenu')
	
	<div class="row">
		<div class="col-md-12">
			<h2>Connexion</h2>
		</div>
	</div>
	
    <div class="row">
		<div class="col-md-6">			
			
		    {{ Form::open(array('url' => 'connexion', 'method' => 'post')) }}
		
			@include('tools.errors')
		
			<div class="form-group">
				{{ Form::label('email', 'E-mail :') }}
			    {{ Form::text('email') }}
			</div>
			
			<div class="form-group">
				{{ Form::label('password', 'Mot de passe :') }}
			    {{ Form::password('password') }}
			</div>
			
			<div class="form-group">
				{{ Form::checkbox('persistent') }}
				{{ Form::label('persistent', Lang::get('message.rememberMe')) }}
			</div>
			
        	<div class="form-group">
        		{{ Form::submit('Se connecter') }}
        		{{ Form::reset('Réinitialiser', array('class' => 'btn btn-default')) }}
        	</div>
					
		    {{ Form::close() }}
		</div>
		
		<div class="col-md-6">
			<p>{{ Link_to('register',Lang::get('message.inscription')) }}</p>
			<p>{{ link_to('password/remind', Lang::get('message.lossPassword')) }}</p>
		</div>
	</div>
	
@stop

@extends('layout')

@section('contenu')

    <div class="row">
		<div class="col-md-12">
			<h2>Changer le mot de passe</h2>
		</div>
	</div>
	
    <div class="row">
		<div class="col-md-6">			
		    {{ Form::open(array('action' => 'EventCal\Controllers\RemindersController@postReset', 'method' => 'post')) }}
		
			@include('tools.errors')
		
			{{ Form::hidden('token', $token) }}
			
			<div class="form-group">
				{{ Form::label('email', 'E-mail :') }}
    			{{ Form::text('email') }}
			</div>
			
			<div class="form-group">
				{{ Form::label('password', 'Mot de passe :') }}
    			{{ Form::password('password') }}
			</div>
			
			<div class="form-group">
				{{ Form::label('password_confirmation', 'Confirmation du mot de passe :') }}
    			{{ Form::password('password_confirmation') }}
			</div>
						
        	{{ Form::submit('Réinitialiser le mot de passe') }}
		    {{ Form::close() }}
		</div>
	</div>

@stop

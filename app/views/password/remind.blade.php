@extends('layout')

@section('contenu')

    <div class="row">
		<div class="col-md-12">
			<h2>Récupère le mot de passe</h2>
		</div>
	</div>
	
    <div class="row">
		<div class="col-md-6">			
		    {{ Form::open(array('action' => 'EventCal\Controllers\RemindersController@postRemind', 'method' => 'post')) }}
		
			@include('tools.errors')
		
			<div class="form-group">
				{{ Form::label('email', 'E-mail :') }}
   				{{ Form::text('email') }}
			</div>
						
        	{{ Form::submit('Envoyer le mot de passe') }}
		    {{ Form::close() }}
		</div>
	</div>

@stop

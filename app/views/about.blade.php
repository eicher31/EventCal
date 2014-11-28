@extends('layout')

@section('contenu')
	
    <div class="row">
		<div class="col-md-6">
			<h2>{{Lang::get('message.titreAboutUs')}}</h2>
		</div>
		
		<div class="col-md-6">
			<h2>{{Lang::get('message.contactTitre')}}</h2>
			
		    {{ Form::open(array('url' => 'about','method' => 'post')) }}    
			
			@include('tools.errors')
			
			<div class="form-group"> 
		        {{ Form::label('email', 'Votre e-mail : ') }}
        		{{ Form::email('email', $email) }}
        	</div>
        	
        	<div class="form-group"> 
		        {{ Form::label('title', 'Votre titre : ') }}
		        {{ Form::text('title') }}
        	</div>
        	
        	<div class="form-group"> 
		        {{ Form::label('text', 'Votre message : ') }}
		        {{ Form::textarea('text', null, array('rows' => 5)) }}
        	</div>
        	
        	<div class="from-group">
        		{{ Form::submit('Envoyer') }}
        		{{ Form::reset('Réinitialiser', array('class' => 'btn btn-default')) }}
        	</div>
        	
        	{{ Form::close() }}
		</div>
	</div>
	
@stop

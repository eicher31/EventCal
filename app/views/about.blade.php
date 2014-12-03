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
		        {{ Form::label('email', Lang::get('message.aboutEmail')) }}
        		{{ Form::email('email', $email) }}
        	</div>
        	
        	<div class="form-group"> 
		        {{ Form::label('title', Lang::get('message.aboooutTitle')) }}
		        {{ Form::text('title') }}
        	</div>
        	
        	<div class="form-group"> 
		        {{ Form::label('text', Lang::get('message.aboutMsg')) }}
		        {{ Form::textarea('text', null, array('rows' => 5)) }}
        	</div>
        	
        	<div class="from-group">
        		{{ Form::submit(Lang::get('message.send')) }}
        		{{ Form::reset('Réinitialiser', array('class' => 'btn btn-default')) }}
        	</div>
        	
        	{{ Form::close() }}
		</div>
	</div>
	
@stop

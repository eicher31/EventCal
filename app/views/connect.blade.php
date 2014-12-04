@extends('layout')

@section('contenu')
	
	<div class="row">
		<div class="col-md-12">
			<h2>{{Lang::get('message.connexion')}}</h2>
		</div>
	</div>
	
    <div class="row">
		<div class="col-md-6">			
			
		    {{ Form::open(array('url' => 'connexion', 'method' => 'post')) }}
		
			@include('tools.errors')
		
			<div class="form-group">
				{{ Form::label('email', Lang::get('message.email')) }}
			    {{ Form::text('email') }}
			</div>
			
			<div class="form-group">
				{{ Form::label('password', Lang::get('message.password')) }}
			    {{ Form::password('password') }}
			</div>
			
			<div class="form-group">
				{{ Form::checkbox('persistent', true, false, array('id' => 'persistent')) }}
				{{ Form::label('persistent', Lang::get('message.rememberMe')) }}
			</div>
			
        	<div class="form-group">
        		{{ Form::submit(Lang::get('message.connexion')) }}
        		{{ Form::reset(Lang::get('message.reset'), array('class' => 'btn btn-default')) }}
        	</div>
					
		    {{ Form::close() }}
		</div>
		
		<div class="col-md-6">
			<p>{{ Lang::get('message.connexionDescription') }}</p>
			<p>{{ Link_to('register',Lang::get('message.inscription')) }}</p>
			<p>{{ link_to('password/remind', Lang::get('message.lossPassword')) }}</p>
		</div>
	</div>
	
@stop

@extends('layout')

@section('contenu')

    <div class="row">
		<div class="col-md-12">
			<h2>{{ Lang::get('message.resetPasswd') }}</h2>
		</div>
	</div>
	
    <div class="row">
		<div class="col-md-6">			
		    {{ Form::open(array('action' => 'EventCal\Controllers\RemindersController@postReset', 'method' => 'post')) }}
		
			@include('tools.errors')
		
			{{ Form::hidden('token', $token) }}
			
			<div class="form-group">
				{{ Form::label('email', Lang::get('message.email')) }}
    			{{ Form::text('email') }}
			</div>
			
			<div class="form-group">
				{{ Form::label('password', Lang::get('message.password')) }}
    			{{ Form::password('password') }}
			</div>
			
			<div class="form-group">
				{{ Form::label('password_confirmation', Lang::get('message.confirmation')) }}
    			{{ Form::password('password_confirmation') }}
			</div>
						
        	{{ Form::submit(Lang::get('message.resetPasswd')) }}
		    {{ Form::close() }}
		</div>
	</div>

@stop

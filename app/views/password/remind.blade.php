@extends('layout')

@section('contenu')

    <div class="row">
		<div class="col-md-12">
			<h2>{{ Lang::get('message.titreRemind') }}</h2>
		</div>
	</div>
	
    <div class="row">
		<div class="col-md-6">			
		    {{ Form::open(array('action' => 'EventCal\Controllers\RemindersController@postRemind', 'method' => 'post')) }}
		
			@include('tools.errors')
		
			<div class="form-group">
				{{ Form::label('email', Lang::get('message.email')) }}
   				{{ Form::text('email') }}
			</div>
						
        	{{ Form::submit(Lang::get('message.sendPasswd')) }}
		    {{ Form::close() }}
		</div>
	</div>

@stop

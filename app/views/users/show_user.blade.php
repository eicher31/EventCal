@extends('layout')

@section('contenu')
	
	<div class="row">
        <div class="col-md-8">
			<h2>{{ Lang::get('message.profile') }} {{{ $user->email }}}</h2>
		</div>
		
        <div class="col-md-4 btn-containers">
       		@if ($isAdmin && !$user->is_actif)
			    {{ Form::open(array('action' => array('EventCal\Controllers\Admin\UsersController@putActivate', $user->id), 'method'	=> 'put')) }}
				{{ Form::submit(Lang::get('message.activate')) }}
				{{ Form::close() }}
			@endif
			
			<a class="btn btn-default" href="{{ action($actionEdit, array($user->id)) }}">
				Editer
			</a>
			
			@if ($isAdmin)
	        	{{ Form::open(array('action' => array('EventCal\Controllers\Admin\UsersController@destroy', $user->id), 'method' => 'delete')) }}
				{{ Form::submit(Lang::get('message.del'),array('class' => 'btn-del'))}}
				{{ Form::close() }}
			@endif
		</div>
    </div>
	
	<div class="row">
        <div class="col-md-6">  
        	<div class="form-group">  
	            <label>{{ Lang::get('message.nameFirstName') }}</label>
	        	<p>{{{ $user->getName() }}}</p>
        	</div>
		</div>
		
		<div class="col-md-6">
		    <div class="form-group">  
	            <label>{{ Lang::get('message.emailProfile') }}</label>
	        	<p>{{{ $user->email }}}</p>
        	</div>
		</div>
	</div>
	
	@include('societies.society_details', array('society' => $user->society))
	
	<div class="row">
        <div class="col-md-8">
        	<h2>{{ Lang::get('message.allEvents') }}</h2>
		</div>
		
        <div class="col-md-4 btn-containers">
        @if (!$isAdmin)
	       	<a href="{{ url('event/create') }}">
				{{ Button::withValue(Lang::get('message.buttonCreatEvent')) }}
			</a>
        @endif
		</div>
	</div>
	
	<div class="row">
        <div class="col-md-8">
			@include('events.listing')
		</div>
	</div>
	
@stop    
	    
@section('js')
	@include('js.delete_confirm')
@stop

@extends($isAdmin ? 'layoutAdmin' : 'layout')

@section('contenu')

	<div class="row">
        <div class="col-md-8">
			<h2>Compte de l'utilisateur {{{ $user->email }}}</h2>
		</div>
		
        <div class="col-md-4 btn-containers">
       		@if ($isAdmin && !$user->is_actif)
			    {{ Form::open(array('action' => array('EventCal\Controllers\Admin\UsersController@putActivate', $user->id), 'method'	=> 'put')) }}
				{{ Form::submit('Activer') }}
				{{ Form::close() }}
			@endif
			
			<a href="{{ action($actionEdit, array($user->id)) }}">
				{{ Button::withValue('Editer') }}
			</a>
			
			@if ($isAdmin)
	        	{{ Form::open(array('action' => array('EventCal\Controllers\Admin\UsersController@destroy', $user->id), 'method' => 'delete')) }}
				{{ Form::submit('Supprimer') }}
				{{ Form::close() }}
			@endif
		</div>
    </div>
	
	<div class="row">
        <div class="col-md-6">  
        	<div class="form-group">  
	            <label>Nom et prénom</label>
	        	<p>{{{ $user->getName() }}}</p>
        	</div>
		</div>
		
		<div class="col-md-6">
		    <div class="form-group">  
	            <label>Adresse e-mail</label>
	        	<p>{{{ $user->email }}}</p>
        	</div>
		</div>
	</div>
	
	@include('societies.society_details', array('society' => $user->society))
	
	<div class="row">
        <div class="col-md-8">
        	<h2>Evénements</h2>
		</div>
		
        <div class="col-md-4 btn-containers">
        @if (!$isAdmin)
	       	<a href="{{ url('event/create') }}">
				{{ Button::withValue('Nouvel événement') }}
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

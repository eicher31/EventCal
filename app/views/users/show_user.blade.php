@extends($isAdmin ? 'layoutAdmin' : 'layout')

@section('contenu')

	<div class="row">
        <div class="col-md-9">
			<h2>Compte de l'utilisateur {{{ $user->email }}}</h2>
		</div>
		
	    @if ($isAdmin && !$user->is_actif)
        <div class="col-md-1">
		    {{ Form::open(array('action' => array('EventCal\Controllers\Admin\UsersController@putActivate', $user->id), 'method' => 'put')) }}
			{{ Form::submit('Activer') }}
			{{ Form::close() }}
		</div>
		@endif
		
		<div class="col-md-1">
        	<a href="{{ action($actionEdit, array($user->id)) }}">
				{{ Button::withValue('Editer') }}
			</a>
		</div>
		
		@if ($isAdmin)
        <div class="col-md-1">
        	{{ Form::open(array('action' => array('EventCal\Controllers\Admin\UsersController@destroy', $user->id), 'method' => 'delete')) }}
			{{ Form::submit('Supprimer') }}
			{{ Form::close() }}
		</div>
		@endif
    </div>
		
	
	<div class="row">
        <div class="col-md-6">
        	<h3>Utilisateur</h3>
        	<p>{{{ $user->email }}}</p>
			<p>{{{ $user->first_name }}}</p>
			<p>{{{ $user->last_name }}}</p>
		</div>
		<div class="col-md-6">
			<h3>Société</h3>
	
			@if ($user->society)
				<p>{{{ $user->society->name }}}</p>
				<p>{{{ $user->society->description }}}</p>
				<p>{{{ $user->society->website }}}</p>
				<p>{{{ $user->society->logo }}}</p>
				<p>{{{ $user->society->telephone }}}</p>
				<p>{{{ $user->society->address }}}</p>
				<p>{{{ $user->society->locality->getName() }}}</p>
			@else
				<p>Aucune société</p>
			@endif
			
		</div>
	</div>
		
	<div class="row">
        <div class="col-md-10">
        	<h3>Evénements</h3>
	
			@include('events.listing')
		</div>
	</div>
	
@stop

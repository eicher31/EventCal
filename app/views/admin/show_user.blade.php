@extends('layout')

@section('contenu')
	<h2>Compte de l'utilisateur {{{ $user->email }}}</h2>
	
	<p>{{ link_to_action('EventCal\Controllers\Admin\UsersController@edit', 'Editer', array($user->id)) }}</p>
	
	<p>
	    {{ Form::open(array('action' => array('EventCal\Controllers\Admin\UsersController@destroy', $user->id), 'method' => 'delete')) }}
		{{ Form::submit('Supprimer') }}
		{{ Form::close() }}
	</p>
	
	@if (!$user->is_actif)
	<p>
	    {{ Form::open(array('action' => array('EventCal\Controllers\Admin\UsersController@putActivate', $user->id), 'method' => 'put')) }}
		{{ Form::submit('Activer') }}
		{{ Form::close() }}
	</p>
	@endif
	
	<p>{{{ $user->email }}}</p>
	<p>{{{ $user->first_name }}}</p>
	<p>{{{ $user->last_name }}}</p>
	
	<h3>Société</h3>
	
	@if ($user->society)
		<p>{{{ $user->society->name }}}</p>
		<p>{{{ $user->society->description }}}</p>
		<p>{{{ $user->society->website }}}</p>
		<p>{{{ $user->society->logo }}}</p>
		<p>{{{ $user->society->telephone }}}</p>
		<p>{{{ $user->society->address }}}</p>
		<p>{{{ $user->society->locality->codeCity() }}}</p>
	@endif
	
	<h3>Evénements</h3>
	
	@foreach ($events as $event)
		<p>{{{ $event->name }}}</p>
	@endforeach
@stop

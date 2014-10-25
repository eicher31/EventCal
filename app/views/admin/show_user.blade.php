@extends('layout')

@section('contenu')
	<h2>Compte de l'utilisateur {{{ $user->email }}}</h2>
	
	<p>{{ link_to_action('EventCal\Controllers\AdminUsersController@edit', 'Editer', array($user->id)) }}</p>
	
	<p>
	    {{ Form::open(array('action' => array('EventCal\Controllers\AdminUsersController@destroy', $user->id), 'method' => 'delete')) }}
		{{ Form::submit('Supprimer') }}
		{{ Form::close() }}
	</p>
	
	<p>{{{ $user->email }}}</p>
	<p>{{{ $user->first_name }}}</p>
	<p>{{{ $user->last_name }}}</p>
	
	<h3>Société</h3>
	<h3>Evénements</h3>
@stop

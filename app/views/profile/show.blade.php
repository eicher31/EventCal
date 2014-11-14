@extends('layout')

@section('contenu')
	<h2>Votre profil</h2>
	
	<p>{{ link_to_action('EventCal\Controllers\ProfileController@getEdit', 'Editer') }}</p>
		
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
		<p>{{{ $user->society->locality->getName() }}}</p>
	@endif
	
	<h3>Evénements</h3>
	
	@foreach ($events as $event)
		<p>{{{ $event->name }}}</p>
	@endforeach
@stop

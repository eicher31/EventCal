@extends('layout')

@section('contenu')
	<h2>Votre profil</h2>
	
	<div class="row">
        <div class="col-md-6">
			<h3>Informations utilisateur</h3>
			
			<p>{{ link_to_action('EventCal\Controllers\ProfileController@getEdit', 'Editer') }}</p>
				
			<p>{{{ $user->email }}}</p>
			<p>{{{ $user->getName() }}}</p>
			
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

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
            <label class="control-label">Nom et prénom</label>
        	<div class="container">{{{ $user->getName() }}}</div>
        	
        	@if ($user->society)
	        	<label class="control-label">Nom de société</label>
	        	<div class="container">{{{ $user->society->name }}}</div>
			
				<label class="control-label">Description de la société</label>
	        	<div class="container">{{{ $user->society->description }}}</div>
        	@else
        		<label class="control-label">Ne possède pas de société</label>
        	@endif
		</div>
		<div class="col-md-6">
			<label class="control-label">Adresse e-mail</label>
        	<div class="container">{{{ $user->email }}}</div>
			
			@if ($user->society)
	        	<label class="control-label">Site Internet</label>
	        	<div class="container">{{{ $user->society->website ? $user->society->website : 'Non spécifié' }}}</div>
	        	
	        	<label class="control-label">Téléphone</label>
	        	<div class="container">{{{ $user->society->telephone ? $user->society->telephone : 'Non spécifié' }}}</div>
	        	
	        	<label class="control-label">Adresse et localité</label>
	        	<div class="container">
	        		@if ($user->society->address)
	        			{{{ $user->society->address }}} <br />
	        		@endif
	        		{{{ $user->society->locality->getName() }}}
	        	</div>
			@endif
		</div>
	</div>
		
	<div class="row">
        <div class="col-md-10">
        	<h2>Evénements</h2>
	
			@include('events.listing')
		</div>
	</div>
	
@stop

@extends('layout')

@section('contenu')

	<div class="row">
        <div class="col-md-12">
			<h2>Informations sur la société {{{ $society->getName() }}}</h2>
		</div>
    </div>

	<div class="row">
        <div class="col-md-6">
        	<label class="control-label">Société</label>
        	<div class="container">{{{ $society->name }}}</div>
        	
        	<label class="control-label">Description</label>
        	<div class="container">{{{ $society->description }}}</div>
		</div>
		
        <div class="col-md-6">
        	<label class="control-label">Site Web</label>
        	<div class="container">{{{ $society->website ? $society->website : 'Non spécifié' }}}</div>
        
            <label class="control-label">Téléphone</label>
        	<div class="container">{{{ $society->telephone ? $society->telephone : 'Non spécifié' }}}</div>
        
            <label class="control-label">Adresse et localité</label>
        	<div class="container">
        		@if ($society->address)
        			{{{ $society->address }}}
        			<br />
        		@endif
        		
        		{{{ $society->locality->getName() }}}
        	</div>
		</div>
	</div>
		
	<div class="row">
        <div class="col-md-10">
        	<h2>Prochains événements de la société</h2>
	
			@include('events.listing')
		</div>
	</div>
	
@stop

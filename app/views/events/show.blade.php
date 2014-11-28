@extends('layout')

@section('contenu')
		
	<div class="row">
        <div class="col-md-8">
			<h2>Evénement {{{ $event->getName() }}}</h2>
		</div>
		
		<div class="col-md-4 btn-containers">
	    @if ($event->isEditable())
	   		{{Button::normal("Editer")->asLinkTo(url('event/'.$event->id.'/edit'))}}
	   		
   			{{ Form::open(array('action' => array('EventCal\Controllers\EventsController@destroy', $event->id), 'method' => 'delete')) }}
				{{ Form::submit('Supprimer') }}
			{{ Form::close()}}
		@endif		
		</div>
    </div>
	
	<div class="row">
		<div class="col-md-6">			
			<div class="form-group">  
	            <label>Date</label>
	        	<p>{{{ $event->getDate() }}} {{{ $event->getTime() }}}</p>
        	</div>
        	
        	<div class="form-group">  
	            <label>Localisation</label>
	        	<p>
        			@if ($event->address)
	        			{{{ $event->address }}} <br />
	        		@endif
        			{{{ $locality->getName() }}}
	        	</p>
			</div>
		        	
        	<div class="form-group">  
	            <label>Description de l'événement</label>
	        	<p>{{{ $event->description }}}</p>
        	</div>
		</div>
		
		<div class="col-md-6">
			<div class="form-group">  
	            <label>Catégorie</label>
	        	<p>
		        	<span class="label event-label" style="background-color: {{{ $category->color }}};">
		        		{{{ $category->name }}}
	        		</span>
        		</p>
        	</div>
		
			<div class="form-group">  
	            <label>Société organisatrice</label>
	        	<p>
	        		<a href="{{ url('societies', array($society->id)) }}">{{{ $society->getName() }}}</a>
        		</p>
        	</div>
        	
			<div class="form-group">  
	            <label>Site Internet de la société</label>
	        	<p>
	        		@if ($society->website)
	        		<a href="{{{ $society->website }}}">{{{ $society->website }}}</a>
	        		@else
	        		Non spécifié
	        		@endif
	        	</p>
        	</div>
		
			<div class="form-group">  
	            <label>Téléphone</label>
	        	<p>{{{ $society->telephone ? $society->telephone : 'Non spécifié' }}}</p>
        	</div>
        	        	
		</div>
	</div>
	    

@stop
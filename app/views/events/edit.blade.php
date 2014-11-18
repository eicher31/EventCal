@extends('layout')

@section('contenu')
	@if($event->id)
	<h2>Edition de l'évènement</h2>
	@else
	<h2>Ajout de l'évènement</h2>
	@endif

	@include('tools.errors')
	
	{{ Form::model($event, array('action' => array($action, $event->id),'method' => $method)) }}
        
    <fieldset>
    <legend>Event :</legend>
    	@if($societies)
    		{{ Form::label('society_id','Société : ')}}
        	{{ Form::select('society_id',$societies)}}
    	@endif
    
        {{ Form::label('name', "Nom de l'evenement : ") }}
        {{ Form::text('name')}}
        
        {{ Form::label('date', 'Date : ') }}
        {{ Form::text('date')}}
        
        {{ Form::label('time', 'Hour : ') }}
        {{ Form::text('time')}}
        
        {{ Form::label('address', 'Adresse : ') }}
        {{ Form::text('address')}}
        
        {{ Form::label('locality_id', 'Localite : ') }}
        {{ Form::select('locality_id',$localities)}}
        
        {{ Form::label('description','Description : ')}}
        {{ Form::textarea('description')}}
        
        {{ Form::label('category_id','Catégorie : ')}}
        {{ Form::select('category_id',$categories)}}
    </fieldset>
    
    	{{ Form::reset('clear') }}
    	{{ Form::submit('enregistrer')}}
	{{ Form::close() }}
	
	
	@if($event->id)
		{{ Form::open(array('action' => array('EventCal\Controllers\EventsController@destroy', $event->id), 'method' => 'delete')) }}
			{{ Form::submit('Supprimer') }}
		{{ Form::close()}}
	@endif
	


@stop

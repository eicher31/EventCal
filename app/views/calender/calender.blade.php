@extends('layout')

@section('contenu')
	
	@foreach($weekEvents as $day => $events)
		<p>{{$day}} :</p>
		
		@foreach($events as $event)	
    		<p>{{$event->getHour()}}</p>
    		<p> Nom de l'event	: {{$event->name}}</p>
    		<p> Catégorie		: {{$event->category->name}}</p>
    		<p> organisé par 	{{$event->society->name}}</p>
    		<p> Description		: {{$event->description}}</p>
    		<p> Organisé 		: {{$event->society->name}}</p>
    		<p> Adresse 		: {{$event->address}}</p>
    		<br>
    		
    	@endforeach 
    	
	@endforeach  
	
@stop
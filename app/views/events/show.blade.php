@extends('layout')

@section('contenu')
		
	<h2> Détail de l'évènements </h2>
	
	<p> Début à {{{$event->datetime}}}
	
    <p> Nom de l'event	: {{{$event->name}}}</p>
    <p> Catégorie		: {{{$category->name}}}</p>
    <p> organisé par 		{{{$society->name}}}</p>
    <p> Description		: {{{$event->description}}}</p>

    <p> Adresse 		: {{{$event->address}}}</p>
    <p> Localitée		: {{{$locality->getName()}}}
    
    @if ($event->isEditable())
    <p>{{Button::normal("Editer l'événements")->asLinkTo(url('event/'.$event->id.'/edit'))}}</p>
	@endif

@stop
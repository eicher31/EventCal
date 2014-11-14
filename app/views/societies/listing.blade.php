@extends('layout')

@section('contenu')
	
@foreach ($societies as $society)

    <p>{{ $society->name }} </p>
    <p>{{ $society->name }} | {{ $society->address }}</p>
    <p>{{ $society->description }} | {{ $society->telephone }}</p>
    <p>{{ $society->locality->getName() }}</p>
    
	<p> ----------------- Events ---------------------</p>
	
    @foreach($society->events as $event)
    	<p>{{$event->name}}</p>
	@endforeach  

	<p> ----------------------------------------------</p>

	@endforeach

@stop

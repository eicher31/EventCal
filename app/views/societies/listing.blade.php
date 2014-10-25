@extends('layout')

@section('contenu')
	
@foreach ($societies as $society)

    <p>{{ $society->name }} </p>
    <p>{{ $society->name }} | {{ $society->address }}</p>
    <p>{{ $society->description }} | {{ $society->telephone }}</p>
    
	<p> ----------------- Events ---------------------</p>
	
    @foreach($events as $event)
    	@if($event->society_id === $society->id)
    	<p>{{$event->name}}</p>
    	@endif
	@endforeach  

	<p> ----------------------------------------------</p>

	@endforeach

@stop

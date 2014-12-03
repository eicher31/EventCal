@extends('layout')

@section('contenu')
	<h2>{{Lang::get('message.titleIndex')}}</h2>
	
@include('events.calender')
	
@stop

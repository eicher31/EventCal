@extends('layout')

@section('contenu')
	<h2>{{Lang::get('message.404')}}</h2>
	
	<p>{{ Lang::get('message.404Desc') }}</p>
	
@stop

@extends('layout')

@section('contenu')
	<h2>Récupère le mot de passe</h2>
	
	@include('tools.errors')
	
    {{ Form::open(array('action' => 'EventCal\Controllers\RemindersController@postRemind', 'method' => 'post')) }}
    {{ Form::label('email', 'E-mail :') }}
    {{ Form::text('email') }}
    {{ Form::submit('Envoyer le mot de passe') }}
    {{ Form::close() }}

@stop

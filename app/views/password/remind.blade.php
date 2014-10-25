@extends('layout')

@section('contenu')
	<h2>Récupère le mot de passe</h2>
	@if (Session::has('status'))
		<p>{{{ Session::get('status') }}}</p>
	@endif
	
	@if (Session::has('error'))
		<p>{{{ Session::get('error') }}}</p>
	@endif
	
    {{ Form::open(array('action' => 'EventCal\Controllers\RemindersController@postRemind', 'method' => 'post')) }}
    {{ Form::label('email', 'E-mail :') }}
    {{ Form::text('email') }}
    {{ Form::submit('Envoyer le mot de passe') }}
    {{ Form::close() }}

@stop

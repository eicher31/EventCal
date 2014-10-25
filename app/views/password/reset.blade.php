@extends('layout')

@section('contenu')
	<h2>Changer le mot de passe</h2>
	
	@if (Session::has('error'))
		<p>{{{ Session::get('error') }}}</p>
	@endif
	
    {{ Form::open(array('action' => 'EventCal\Controllers\RemindersController@postReset', 'method' => 'post')) }}
	{{ Form::hidden('token', $token) }}
    {{ Form::label('email', 'E-mail :') }}
    {{ Form::text('email') }}
    {{ Form::label('password', 'Mot de passe :') }}
    {{ Form::password('password') }}
    {{ Form::label('password_confirmation', 'Confirmation du mot de passe :') }}
    {{ Form::password('password_confirmation') }}
    {{ Form::submit('Réinitialiser le mot de passe') }}
    {{ Form::close() }}

@stop

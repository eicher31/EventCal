@extends('layout')

@section('contenu')

@foreach($errors->all() as $error)
	<p>{{$error}}<p>
	
@endforeach
    {{ Form::open(array('action' => 'RegisterController@postUser','method' => 'post')) }}
        {{ Form::label('last_name', 'Nom : ') }}
        {{ Form::text('last_name') }}
        {{ Form::label('first_name', 'Prénom : ') }}
        {{ Form::text('first_name') }}
        {{ Form::label('email', 'E-mail : ') }}
        {{ Form::email('email') }}
        {{ Form::label('password', 'Mot de passe : ') }}
        {{ Form::password('password') }}
        {{ Form::label('password_confirm', 'Confirmer : ') }}
        {{ Form::password('password_confirm') }}
        {{ Form::submit('Suivant') }}
	{{ Form::close() }}
@stop
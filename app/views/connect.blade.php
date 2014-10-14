@extends('layout')

@section('contenu')
	
	{{{ Session::get('error') }}}
    {{ Form::open(array('url' => 'connexion', 'method' => 'post')) }}
    {{ Form::label('email', 'E-mail :') }}
    {{ Form::text('email') }}
    {{ Form::label('password', 'Mot de passe :') }}
    {{ Form::password('password') }}
    {{ Form::submit('Se connecter') }}
    {{ Form::close() }}
	
@stop

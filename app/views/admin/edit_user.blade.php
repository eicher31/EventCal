@extends('layout')

@section('contenu')
	<h2>Edition de l'utilisateur {{{ $user->email }}}</h2>
	
	@foreach($errors->all() as $error)
		<p>{{$error}}<p>
	@endforeach
	
    {{ Form::model($user, array('action' => array('AdminUsersController@update', $user->id),'method' => 'put')) }}
        {{ Form::label('last_name', 'Nom : ') }}
        {{ Form::text('last_name') }}
        {{ Form::label('first_name', 'Prénom : ') }}
        {{ Form::text('first_name') }}
        {{ Form::label('email', 'E-mail : ') }}
        {{ Form::text('email') }}
        {{ Form::label('password', 'Mot de passe : ') }}
        {{ Form::password('password') }}
        {{ Form::label('password_confirm', 'Confirmer : ') }}
        {{ Form::password('password_confirm') }}
        {{ Form::submit('Enregistrer') }}
	{{ Form::close() }}

@stop

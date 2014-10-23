@extends('layout')

@section('contenu')
	
	{{{ Session::get('error') }}}
    {{ Form::open(array('url' => 'connexion', 'method' => 'post')) }}
    {{ Form::label('email', 'E-mail :') }}
    {{ Form::text('email') }}
    {{ Form::label('password', 'Mot de passe :') }}
    {{ Form::password('password') }}
	{{ Form::label('persistent', 'Se souvenir de moi') }}
	{{ Form::checkbox('persistent') }}
    {{ Form::submit('Se connecter') }}
    {{ Form::close() }}

	<p>
		{{ Link_to('register',"Inscription") }}
		{{ link_to('password/remind', 'Mot de passe perdu') }}
	</p>
@stop

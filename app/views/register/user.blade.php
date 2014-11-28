@extends('layout')

@section('contenu')

	@include('tools.errors')

    {{ Form::open(array('action' => 'EventCal\Controllers\RegisterController@postUser','method' => 'post')) }}
    
    <fieldset>
    <legend>Information personnel:</legend>
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
	</fieldset>
	
	<fieldset>
    <legend>Information société:</legend>
        {{ Form::label('name', 'Nom : ') }}
        {{ Form::text('name') }}

        {{ Form::label('description', 'Description : ') }}
        {{ Form::text('description') }}
        {{ Form::label('website', 'Site internet: ') }}
        {{ Form::text('website') }}
        {{ Form::label('locality_id', 'Localité : ') }}
        {{ Form::select('locality_id', $city) }}
        {{ Form::label('address', 'Adresse de votre société : ') }}
        {{ Form::text('address') }}
        {{ Form::label('telephone', 'Numero de téléphone : ') }}
        {{ Form::number('telephone') }}

    </fieldset>
        {{ Form::submit('Enregistrer') }}
	{{ Form::close() }}
@stop
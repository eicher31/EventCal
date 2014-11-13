@extends('layout')

@section('contenu')
	<h2>Edition de l'utilisateur {{{ $user->email }}}</h2>
	
	@include('tools.errors')
	
    {{ Form::model($user, array('action' => array('EventCal\Controllers\Admin\UsersController@update', $user->id),'method' => 'put')) }}
        
    <fieldset>
    <legend>Information personnel:</legend>
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
        {{ Form::label('is_actif', 'Compte actif') }}
        {{ Form::checkbox('is_actif') }}
    </fieldset>
	
	@if ($user->society)
	<fieldset>
    <legend>Information société:</legend>
        {{ Form::label('name', 'Nom : ') }}
        {{ Form::text('name', $user->society->name) }}
        {{ Form::label('logo', 'Votre logo : ') }}
        {{ Form::file('logo') }}
        {{ Form::label('description', 'Description : ') }}
        {{ Form::text('description', $user->society->description) }}
        {{ Form::label('website', 'Site internet: ') }}
        {{ Form::text('website', $user->society->website) }}
        {{ Form::label('locality_id', 'Localité : ') }}
        {{ Form::select('locality_id', $city, $user->society->locality_id) }}
        {{ Form::label('address', 'Adresse de votre société : ') }}
        {{ Form::text('address', $user->society->address) }}
        {{ Form::label('telephone', 'Numero de téléphone : ') }}
        {{ Form::number('telephone', $user->society->telephone) }}
        {{ Form::label('is_public', 'Voulez que vos données soient publiques ? ') }}
        {{ Form::checkbox('is_public', $user->society->is_public) }}
    </fieldset>
    @endif
    
    	{{ Form::submit('Enregistrer') }}
        
	{{ Form::close() }}

@stop

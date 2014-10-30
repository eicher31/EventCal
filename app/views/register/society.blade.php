@extends('layout')

@foreach($errors->all() as $error)
	<p>{{$error}}<p>
	
@endforeach
    {{ Form::open(array('action' => 'RegisterController@postSociety','method' => 'post')) }}
        {{ Form::label('name', 'Nom : ') }}
        {{ Form::text('name') }}
        {{ Form::label('logo', 'Votre logo : ') }}
        {{ Form::file('logo') }}
        {{ Form::label('description', 'Description : ') }}
        {{ Form::text('description') }}
        {{ Form::label('website', 'Site internet: ') }}
        {{ Form::text('website') }}
        {{ Form::label('locality_id', 'Localité : ') }}
        {{ Form::password('locality_id') }}
        {{ Form::label('address', 'Adresse de votre société : ') }}
        {{ Form::text('address') }}
        {{ Form::label('telephone', 'Numero de téléphone : ') }}
        {{ Form::number('telephone') }}
        {{ Form::label('is_public', 'Voulez que vos données soient publiques ? ') }}
        {{ Form::checkbox('is_public') }}
        {{ Form::submit('Terminer') }}
	{{ Form::close() }}
@stop
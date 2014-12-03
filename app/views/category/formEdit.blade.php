@extends('layoutAdmin') 

@section('contenu')

			
{{ Form::model($cat,array('action'=> array($action, $cat->id), 'method' => $methode)) }}
	@include('tools.errors')
	{{ Form::label('name',"Nom cat") }}
	{{ Form::text('name') }}
	{{ Form::label('color',"Nom color") }}
	{{ Form::text('color') }}
	{{ Form::submit('Enregistrer') }}
{{ Form::close() }}

@stop

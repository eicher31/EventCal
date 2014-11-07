@extends('layout')

@section('contenu')

@foreach($errors->all() as $error)
	<p>{{$error}}</p>
	
@endforeach
	
	<h2>Confirmation</h2>
	<p>Votre inscription a bien été enregistré.</p>
	<p>Votre comptre doit encore être activé pas l'administrateur.</p>
	<p>Vous recevrer dans les jours qui viennent un e-mail de confirmation.</p>
	
	<p>{{$email}} test </p>
		
@stop
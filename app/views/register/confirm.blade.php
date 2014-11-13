@extends('layout')

@section('contenu')
	
	<h2>Confirmation</h2>
	<p>Votre inscription a bien été enregistrée.</p>
	<p>Votre compte doit encore être activé par un administrateur.</p>
	<p>Vous recevrez prochainement un e-mail de confirmation d'activation à l'adresse {{{ $email }}}.</p>
			
@stop
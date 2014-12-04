@extends('layout')

@section('contenu')
	
	<h2>{{Lang::get('message.titreConfirmation')}}</h2>
	{{Lang::get('message.msgConfigmation',array('email' => $email))}}
			
@stop
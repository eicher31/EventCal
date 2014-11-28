@extends('layout')

@section('contenu')
	
	{{Lang::get('message.nomConfirmation')}}
	{{Lang::get('message.msgConfigmation',array('email' => $email))}}
			
@stop
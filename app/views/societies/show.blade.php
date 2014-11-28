@extends('layout')

@section('contenu')

	<div class="row">
        <div class="col-md-12">
			<h2>Informations sur la société {{{ $society->getName() }}}</h2>
		</div>
    </div>

	@include('societies.society_details')
			
	<div class="row">
        <div class="col-md-10">
        	<h2>Prochains événements de la société</h2>
	
			@include('events.listing')
		</div>
	</div>
	
@stop

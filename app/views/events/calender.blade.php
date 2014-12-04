@extends('layout')

@section('contenu')
	
	<div class="row">
		<div class="col-md-12">
			<p>{{ Lang::get('message.welcomeCalender') }}</p>
		</div>
	</div>
	
	<div class="row">
        <div class="col-md-9">
        	@include('events.listing')			
        </div>
        
        <div class="col-md-3">
        	@if (Auth::check())
				<p>{{Button::normal(Lang::get('message.buttonCreatEvent'))->asLinkTo(url('event/create'))}}</p>
			@endif
			
			@foreach ($categories as $cat)
				<p>
					<span class="label event-label" style="background-color: {{{ $cat->color }}};">
				 		{{{ $cat->name }}}
				  	</span>
			  	</p>
			@endforeach
        </div>
	</div>

@stop
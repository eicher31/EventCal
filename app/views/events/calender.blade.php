@extends('layout')

@section('contenu')
			
	<div class="row">
        <div class="col-md-9">
        	@include('events.listing')			
        </div>
        
        <div class="col-md-3">
        	@if (Auth::check())
				{{Button::normal(Lang::get('message.buttonCreatEvent'))->asLinkTo(url('event/create'))}}
			@endif
        
        	<h3>
			@foreach ($categories as $cat)
				<p>
					<span class="label event-label" style="background-color: {{{ $cat->color }}};">
				 		{{{ $cat->name }}}
				  	</span>
			  	</p>
			@endforeach
			</h3>
        </div>
	</div>

@stop
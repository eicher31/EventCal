@extends('layout')

@section('contenu')
	
	<div class="row">
		<div class="col-md-9">
			<p>
				{{ Lang::get('message.welcomeCalender') }}
				
				@if (!Auth::check())
					@lang('message.welcomeRegister')
				@endif
			</p>
			
			<br /><br />
			@include('events.listing')
		</div>
		
		<div class="col-md-3">
        	@if (Auth::check())
				<p>{{Button::normal(Lang::get('message.buttonCreatEvent'))->asLinkTo(url('event/create'))}}</p>
				<hr />
			@endif
			
			<p><a href="{{ url('feed') }}"><img src="{{ url('images/rss-icon.png') }}" alt="@lang('message.rss')" /></a></p>
			<hr />
			
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
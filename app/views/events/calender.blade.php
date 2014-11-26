@extends('layout')

@section('contenu')
			
	<div class="row">
        <div class="col-md-9">
        	<table>
			@foreach($weekEvents as $day => $events)
				<tr>
					<td>{{$day}} :</td>
					
					<td>
					@foreach($events as $event)											
						<a href="{{ url('event', array($event->id)) }}" class="btn event-label" 
							style="background-color: {{{ $event->category->color }}};">
							{{{ $event->name }}}
							
							@if ($event->getTime())
								{{{ ' (' . $event->getTime() . ')' }}}
							@endif
						</a>
			    	@endforeach 
			    	</td>
		    	</tr>
			@endforeach  
			</table>
			
			@if (Auth::check())
				{{Button::normal('Créer nouveau événement')->asLinkTo(url('event/create'))}}
			@endif
			
        </div>
        
        <div class="col-md-3">
        	<h4>
			@foreach ($categories as $cat)
				<p>
					<span class="label event-label" style="background-color: {{{ $cat->color }}};">
				 		{{{ $cat->name }}}
				  	</span>
			  	</p>
			@endforeach
			</h4>
        </div>
	</div>

@stop
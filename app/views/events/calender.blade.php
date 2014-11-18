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
						<?php $color = $event->category->color; # the absolute devil, we need LESS here ?>
						
						<a href="{{ url('event/'.$event->id) }}" class="btn" style="background-color: {{ $color }} !important; background-repeat: repeat-x;
								  background-image: linear-gradient({{ $color }}, {{ $color }});
								  border-color: {{ $color }};
								  color: white !important;">
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
				<?php $color = $cat->color; # the absolute devil, we need LESS here ?>
				<p>
				<span class="label" style="background-color: {{ $color }} !important; background-repeat: repeat-x;
								  background-image: linear-gradient({{ $color }}, {{ $color }});
								  border-color: {{ $color }};
								  color: white !important;">
			 	{{{ $cat->name }}}
			  	</span>
			  	</p>
			@endforeach
			</h4>
        </div>
	</div>

@stop
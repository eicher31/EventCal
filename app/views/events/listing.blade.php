	@if ($eventsByMonths)
        	<table class="table table-condensed">
        		<thead>
        			<tr>
        				<th>Date</th>
        				<th>Heure</th>
        				<th>Evénement</th>
        				<th>Localité</th>
        				
        				@if ($showSocietyEvents)
        				<th>Organisateur</th>
        				@endif
        			</tr>
        		</thead>
        		<tbody>
        			@foreach ($eventsByMonths as $month => $events)
	        			<tr>
	        				<td colspan="5"><h3>{{{ $month }}}</h3></td>
	        			</tr>
        			
        				@foreach ($events as $event)
	        				<tr>
		        				<td>{{{ $event->getDate() }}}</td>
		        				<td>{{{ $event->getTime() }}}</td>
		        				<td>
        							<a href="{{ url('event', array($event->id)) }}" class="btn event-label" 
										style="background-color: {{{ $event->category->color }}};">
										{{{ $event->name }}}
									</a>
	        					</td>
		        				<td>{{{ $event->locality->getName() }}}</td>
		        				
        				        @if ($showSocietyEvents)
		        				<td>
		        					<a href="{{ url('societies', array($event->society->id)) }}">
		        					{{{ $event->society->getName() }}}
		        					</a>
		        				</td>
		        				@endif
        					</tr>
        				@endforeach
        			
					@endforeach
				</tbody>
			</table>
			@else
				<p>Aucun événement</p>
			@endif

@extends('layout')

@section('contenu')
	
@foreach ($societies as $society)
	
	<div class="row">
        <div class="col-md-6">
		    <p>{{ $society->name }} </p>
		    <p>{{ $society->name }} | {{ $society->address }}</p>
		    <p>{{ $society->description }} | {{ $society->telephone }}</p>
		    <p>{{ $society->locality->getName() }}</p>
     	</div>
		<div class="col-md-6">
			<table>
		    @foreach($events[$society->id] as $day => $evts)
		    	<tr>
		    		<td>{{{ $day }}}</td>
		    		<td>
		    		@foreach ($evts as $e)
    					<a href="{{ url('event', array($e->id)) }}" class="label label-default">
		    				{{{ $e->getName() }}}
		    			</a>
		    		@endforeach
		    		</td>
		    	</tr>
			@endforeach  
			</table>
		</div>
	</div>
	<hr />
	
@endforeach

@stop

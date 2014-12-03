@extends('layout') 

@section('contenu') 



<table class="table table-condensed">
			<thead>
				<tr>
					<th>{{Lang::get('message.listingRowName')}}</th>
					<th>{{Lang::get('message.listingRowLocality')}}</th>
					<th>{{Lang::get('message.listingRowWeb')}}</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($societiesByName as $name => $societies)
				<tr>
					<td colspan="3"><h3>{{{ $name }}}</h3></td>
				</tr>

				@foreach ($societies as $society)
				<tr>
					<td><a href="{{ url('societies', array($society->id)) }}">
		        					{{{ $society->getName() }}}
		        	</a></td>
					<td>{{{ $society->locality->getName() }}}</td>
					<td>{{{ $society->website }}}</td> 
				</tr>
				@endforeach @endforeach
			</tbody>
		</table>

@stop

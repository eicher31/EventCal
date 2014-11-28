@extends('layout') 

@section('contenu') 



<table class="table table-condensed">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Localite</th>
					<th>Website</th>
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

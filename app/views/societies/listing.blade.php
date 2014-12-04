@extends('layout') 

@section('contenu') 

<div class="row">
	<div class="col-md-12">
		<h2>{{ Lang::get('message.listingSocieties') }}</h2>
		<p>{{ Lang::get('message.listingSocietiesRegister') }}</p>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
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
					<td>
					@if ($society->website)
						{{ link_to($society->website) }}
					@endif
					</td> 
				</tr>
				@endforeach @endforeach
			</tbody>
		</table>
	</div>
</div>

@stop

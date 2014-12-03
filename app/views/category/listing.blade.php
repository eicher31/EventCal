@extends('layoutAdmin') 

@section('contenu')

{{ Button::normal("Nouveau")->asLinkTo(url("admin/category/create")) }}

<div class="row">
	<div class="col-md-12">
		<table>
			<thead>
				<tr>
					<th>Nom</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
				@foreach ($categories as $cat)
				<tr>
					<th>
						<span class="label event-label" style="background-color: {{{ $cat->color }}};"> 
						{{{ $cat->name }}}
						</span>
					</th>
					<th>
						{{ Button::normal("Editer")->asLinkTo(url("admin/category/$cat->id/edit")) }}
						{{ Form::open(array('action'=> array('EventCal\Controllers\Admin\EventCategoryController@destroy', $cat->id), 'method' => 'delete')) }}
							{{ Form::submit('Supprimer') }}
						{{ Form::close() }}
					</th>
				</tr>
				@endforeach
			</tbody>
			
		</table>
	</div>
</div>

@stop


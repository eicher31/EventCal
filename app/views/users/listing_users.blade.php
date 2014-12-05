@extends('layout')

@section('contenu')
	<h2>{{Lang::get('message.administrationTitle')}}</h2>

	<table class="table table-condensed">
		<thead>
			<tr>
				<th>{{Lang::get('message.listingRowEmail')}}</th>
				<th>{{Lang::get('message.listingRowFLName')}}</th>
				<th>{{Lang::get('message.listingRowSociety')}}</th>
				<th>{{Lang::get('message.listingRowAction')}}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr{{ !$user->is_actif ? ' style="background-color: #f5f5f5;"' : '' }}>
				<td>{{{ $user->email }}}</td>
				<td>{{{ $user->getName() }}}</td>
				
				<td>
				@if ($user->society)
					{{{ $user->society->name }}}
				@endif
				</td>
				
				<td>
					<div class="btn-containers">		
						<a class="btn btn-default" href="{{ action('EventCal\Controllers\Admin\UsersController@show', array($user->id)) }}">
							{{Lang::get('message.show')}}
						</a>
						<a class="btn btn-default" href="{{ action('EventCal\Controllers\Admin\UsersController@edit', array($user->id)) }}">
							{{Lang::get('message.edit')}}
						</a>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@stop

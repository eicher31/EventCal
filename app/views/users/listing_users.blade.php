@extends('layout')

@section('contenu')
	<h2>Administration des utilisateurs</h2>

	<table class="table table-condensed">
		<thead>
			<tr>
				<th>E-mail</th>
				<th>Nom prénom</th>
				<th>Société</th>
				<th>Actions</th>
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
							Voir
						</a>
						<a class="btn btn-default" href="{{ action('EventCal\Controllers\Admin\UsersController@edit', array($user->id)) }}">
							Editer
						</a>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@stop

@extends('layoutAdmin')

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
					{{ link_to_action('EventCal\Controllers\Admin\UsersController@show', 'Voir', array($user->id)) }}
					{{ link_to_action('EventCal\Controllers\Admin\UsersController@edit', 'Editer', array($user->id)) }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@stop
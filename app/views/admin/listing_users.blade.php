@extends('layoutAdmin')

@section('contenu')
	<h2>Administration des utilisateurs</h2>

	<table>
	@foreach ($users as $user)
	<tr{{ !$user->is_actif ? ' style="background-color: yellow;"' : '' }}>
		<td>{{{ $user->email }}}</td>
		<td>{{{ $user->getName() }}}</td>
		
		<td>
		@if ($user->society)
			{{{ $user->society->name }}}
		@endif
		</td>
		
		<td>{{ link_to_action('EventCal\Controllers\Admin\UsersController@show', 'Voir', array($user->id)) }}</td>
		<td>{{ link_to_action('EventCal\Controllers\Admin\UsersController@edit', 'Editer', array($user->id)) }}</td>
	</tr>
	@endforeach
	</table>
@stop

@extends('layout')

@section('contenu')
	<h2>Administration des utilisateurs</h2>
	
	<table>
	@foreach ($users as $user)
	<tr>
		<td>{{{ $user->email }}}</td>
		<td>{{{ $user->fullName() }}}</td>
		
		<td>
		@if ($user->society)
			{{{ $user->society->name }}}
		@endif
		</td>
		
		<td>{{ link_to_action('EventCal\Controllers\AdminUsersController@show', 'Voir', array($user->id)) }}</td>
		<td>{{ link_to_action('EventCal\Controllers\AdminUsersController@edit', 'Editer', array($user->id)) }}</td>
	</tr>
	@endforeach
	
	</table>
@stop

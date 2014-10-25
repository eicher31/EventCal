@extends('layout')

@section('contenu')
	<h2>Administration des utilisateurs</h2>
	
	<table>
	@foreach ($users as $user)
	<tr>
		<td>{{{ $user->email }}}</td>
		<td>{{{ $user->first_name }}}</td>
		<td>{{{ $user->last_name }}}</td>
		<td>{{ link_to_action('EventCal\Controllers\AdminUsersController@show', 'Voir', array($user->id)) }}</td>
		<td>{{ link_to_action('EventCal\Controllers\AdminUsersController@edit', 'Editer', array($user->id)) }}</td>
	</tr>
	@endforeach
	
	</table>
@stop

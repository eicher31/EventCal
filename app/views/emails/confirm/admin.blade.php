<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<h2>Confirmer demande</h2>	

		<div>
			Bonjour,<br/><br/>
			Un nouvel utilisateur a créer un compte utilisateur sur le site <a href="{{ url('admin/users', array($user->id)) }}">EventCal</a>.<br/>
			Pour que le compte soit créer vous devez valider l'utilisateur dans la liste des utilisateurs.<br/><br/>
			
			Cordialement<br/>
			L'équipe EventCal
		</div>
	</body>
</html>
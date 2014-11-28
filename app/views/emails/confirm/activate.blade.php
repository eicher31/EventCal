<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<h2>Activation</h2>	

		<div>
			{{Lang::get('message.activationText',array('nom'=> $user->getName()))}}
			Bonjour {{{$user->getName()}}},<br/><br/>
			Votre compte a été activé sur le site EventCal.<br/>
			
			Nous vous remercions d'utiliser nos service pour afficher vos évennements.
			
			Cordialement<br/>
			L'équipe EventCal
		</div>
	</body>
</html>
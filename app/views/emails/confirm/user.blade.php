<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<h2>Confirmation d'inscription</h2>	

		<div>
			Bonjour {{{$user->fullName()}}},<br/><br/>
			Votre comptre a bien été créer sur le site EventCal.<br/>
			Le compte doit encore être valider par l'administrateur du site.<br/>
			Une validation vous sera envoyé prochainement.<br/><br/>
			
			Cordialement<br/>
			L'équipe EventCal
		</div>
	</body>
</html>
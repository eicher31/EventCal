<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<h2>Confirmation de demande</h2>	

		<div>
			Bonjour {{{$user->fullName()}}},<br/><br/>
			Votre comptre a bien été créer sur le site EventCal.<br/>
			Le compte doit encore être valider par l'administrateur du site.<br/>
			Une validation vous sera envoyé dans les jours qui viennent.<br/><br/>
			
			Cordialement<br/>
			L'équipe EventCal
		</div>
	</body>
</html>
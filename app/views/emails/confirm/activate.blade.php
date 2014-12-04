<!DOCTYPE html>
<html lang="fr-FR">
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<h2>Activation</h2>	

		<div>
			{{Lang::get('message.activationText',array('nom'=> $user->getName()))}}
		</div>
	</body>
</html>
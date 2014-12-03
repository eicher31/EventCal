<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>{{Lang::get('message.contactTitle')}}</h1>
		<h2>{{{ $title }}}</h2>

		<p>
			{{Lang::get('message.mailContact',array('mail' => $email))}}
		</p>
		
		<hr />
		
		<p>
			{{{ $text }}}
		</p>
	</body>
</html>

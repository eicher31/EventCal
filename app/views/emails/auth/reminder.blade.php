<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{Lang::get('message.titreReset')}}</h2>

		<div>
			{{Lang::get('message.textReset1')}}
			<a href="{{ URL::to('password/reset', array($token)) }}">{{ url('password/reset') }}</a>.<br/>
			{{Lang::get('message.textReset2',array('expire' => Config::get('auth.reminder.expire', 60)))}}
		</div>
	</body>
</html>

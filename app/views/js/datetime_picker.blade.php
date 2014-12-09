
	{{ HTML::script('js/moment-with-locales.min.js') }}
	{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}
	
	<script type="text/javascript">
		$('#datepicker').datetimepicker({
			language: 'fr',
			pickTime: false
		});
		
		$('#timepicker').datetimepicker({
			language: 'fr',
			pickDate: false
		});
    </script>

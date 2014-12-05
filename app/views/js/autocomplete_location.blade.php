
	{{ HTML::script('js/bootstrap-typeahead.min.js') }}

	<script type="text/javascript">
		var localitySearch = $('#locality-search');
		var localityId = $('#locality-id');
		
		$.get("{{ url('localitysearch') }}", function(data) {
			
			localitySearch.typeahead({ 
				source: data,

				onSelect: function(item) {
					localityId.val(item.value);
					console.log(item.value);
				}
			});

			localitySearch.change(function(e) {
				if (!localityId.val()) {
					localitySearch.typeahead("select");
				}
			});

			localitySearch.on('input', function(e) {
				localityId.val("");
			});
		}, 'json');
	</script>

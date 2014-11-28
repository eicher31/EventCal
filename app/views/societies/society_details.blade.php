	<div class="row">
		<div class="col-md-6">
        	@if ($society)
        		<div class="form-group">  
		            <label>Nom de société</label>
		        	<p>{{{ $society->name }}}</p>
	        	</div>
	        	<div class="form-group">  
		            <label>Description de la société</label>
		        	<p>{{{ $society->description }}}</p>
	        	</div>
        	@else
        		<div class="form-group">  
		            <label>Ne possède pas de société</label>
	        	</div>
        	@endif
		</div>
		
		<div class="col-md-6">
			@if ($society)
			<div class="form-group">  
	            <label>Site Internet</label>
	        	<p>
	        		@if ($society->website)
	        		<a href="{{{ $society->website }}}">{{{ $society->website }}}</a>
	        		@else
	        		Non spécifié
	        		@endif
	        	</p>
        	</div>
		
			<div class="form-group">  
	            <label>Téléphone</label>
	        	<p>{{{ $society->telephone ? $society->telephone : 'Non spécifié' }}}</p>
        	</div>
		
			<div class="form-group">  
	            <label>Adresse et localité</label>
	        	<p>
        			@if ($society->address)
	        			{{{ $society->address }}} <br />
	        		@endif
        			{{{ $society->locality->getName() }}}
	        	</p>
        	</div>
			@endif
		</div>
	</div>

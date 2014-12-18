	<div class="row">
		<div class="col-md-6">
        	@if ($society)
        		<div class="form-group">  
		            <label>{{ Lang::get('message.socName') }}</label>
		        	<p>{{{ $society->name }}}</p>
	        	</div>
	        	<div class="form-group">  
		            <label>{{ Lang::get('message.socDesc') }}</label>
		        	<p>{{ nl2br(e($society->description)) }}</p>
	        	</div>
        	@else
        		<div class="form-group">  
		            <label>{{ Lang::get('message.socNone') }}</label>
	        	</div>
        	@endif
		</div>
		
		<div class="col-md-6">
			@if ($society)
			<div class="form-group">
	            <label>{{ Lang::get('message.listingRowWeb') }}</label>
	        	<p>
	        		@if ($society->website)
	        		<a href="{{{ $society->website }}}" target="_blank">{{{ $society->website }}}</a>
	        		@else
	        		{{ Lang::get('message.showNotShow') }}
	        		@endif
	        	</p>
        	</div>
		
			<div class="form-group">  
	            <label>{{ Lang::get('message.showTelephone') }}</label>
	        	<p>{{{ $society->telephone ? $society->telephone : Lang::get('message.showNotShow') }}}</p>
        	</div>
		
			<div class="form-group">  
	            <label>{{Lang::get('message.showLocality')}}</label>
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

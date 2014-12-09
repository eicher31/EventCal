@extends('layout')

@section('contenu')
	
	<div class="row">
        <div class="col-md-12">
        @if ($user->id)
			<h2>{{ Lang::get('message.profile') }} {{{ $user->email }}}</h2>
			<p>{{ Lang::get('message.descProfile') }}</p>
		@else
			<h2>{{ Lang::get('message.inscription') }}</h2>
			<p>{{ Lang::get('message.descInscription') }}</p>
		@endif
    	</div>
    </div>
	
	{{ Form::model($user, array('action' => array($actionEdit, $user->id), 'method' => !$user->id ? 'post' : 'put')) }}
    
    @include('tools.errors')

    <div class="row">
		<div class="col-md-6">
		    <fieldset>
   			 	<legend>{{ Lang::get('message.infoPerso') }}</legend>
			
	    		<div class="form-group">  	
		    		{{ Form::label('last_name', Lang::get('message.name')) }}
        			{{ Form::text('last_name') }}
		        </div>
					
	        	<div class="form-group">  
	        	    {{ Form::label('first_name', Lang::get('message.fname')) }}
       				{{ Form::text('first_name') }}      
	        	</div>
	        	
	        	<div class="form-group">
	        	    {{ Form::label('email', Lang::get('message.email')) }}
        			{{ Form::text('email') }}
	        	</div>
	        	
	        	<div class="form-group">
			        {{ Form::label('password', Lang::get('message.password')) }}
        			{{ Form::password('password') }}
	        	</div>
	        	
	        	<div class="form-group">
			        {{ Form::label('password_confirm', Lang::get('message.confirmation')) }}
        			{{ Form::password('password_confirm') }}
	        	</div>
	        	
	        	@if ($isAdmin)
	        	<div class="form-group">
	        	    {{ Form::checkbox('is_actif', null, false, array('id' => 'is_actif')) }}
			        {{ Form::label('is_actif', Lang::get('message.actif')) }}
	        	</div> 
	        	@endif
        	</fieldset>
		</div>
		
		@if (!$user->id || $user->society)
		<div class="col-md-6">
			<fieldset>
		    	<legend>{{ Lang::get('message.infoSoc') }}</legend>
		
	    		<div class="form-group">  	
		    		{{ Form::label('name', Lang::get('message.nameSociety')) }}
        			{{ Form::text('name', $user->society ? $user->society->name : null) }}
		        </div>
					
	        	<div class="form-group">  
	        	    {{ Form::label('description', Lang::get('message.description')) }}
        			{{ Form::textarea('description', $user->society ? $user->society->description : null, array('rows' => 5)) }}     
	        	</div>
	        	
	        	<div class="form-group">
	        	    {{ Form::label('website', Lang::get('message.website')) }}
       				{{ Form::text('website', $user->society ? $user->society->website : null, 
       					array('placeholder' => Lang::get('message.placeholderHttp'))) }}
	        	</div>
	        	
	        	<div class="form-group">
			        {{ Form::label('telephone', Lang::get('message.phone')) }}
        			{{ Form::text('telephone', $user->society ? $user->society->telephone : null) }}
	        	</div>
	        	
	        	<div class="form-group">
			        {{ Form::label('address', Lang::get('message.adress')) }}
        			{{ Form::text('address', $user->society ? $user->society->address : null) }}
	        	</div>
	        	
        		<div class="form-group">
					{{ Form::label('codeCity', Lang::get('message.locality')) }}
					{{ Form::hidden('locality_id', $user->society ? $user->society_id : '', array('id' => 'locality-id')) }}
					{{ Form::text('codeCity', $user->society ? $user->society->locality->getName() : null, array(
						'placeholder' => Lang::get('message.placeholderLocality'), 
					    'id' => 'locality-search', 
					    'autocomplete' => 'off',
					)) }}
				</div>
	        	
			</fieldset>
		</div>
		@endif
		
	</div>
        
    <div class="row">
    	<div class="col-md-6">
    		{{ Form::submit(Lang::get('message.save'))}}        
    		{{ Form::reset(Lang::get('message.reset'), array('class' => 'btn btn-default')) }}
    	</div>
    </div> 
    
	{{ Form::close() }}

@stop

@section('js')
	@include('js.autocomplete_location')
@stop

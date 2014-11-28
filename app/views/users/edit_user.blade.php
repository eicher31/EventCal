@extends($isAdmin ? 'layoutAdmin' : 'layout')

@section('contenu')
	
	<div class="row">
        <div class="col-md-12">
			<h2>
			@if ($user->id)
				Edition de l'utilisateur {{{ $user->email }}}
			@else
				Création d'un compte utilisateur>
			@endif
            </h2>
    	</div>
    </div>
	
	{{ Form::model($user, array('action' => array($actionEdit, $user->id), 'method' => !$user->id ? 'post' : 'put')) }}
    
    @include('tools.errors')

    <div class="row">
		<div class="col-md-6">
		    <fieldset>
   			 	<legend>Informations personnelles</legend>
			
	    		<div class="form-group">  	
		    		{{ Form::label('last_name', 'Nom : ') }}
        			{{ Form::text('last_name') }}
		        </div>
					
	        	<div class="form-group">  
	        	    {{ Form::label('first_name', 'Prénom : ') }}
       				{{ Form::text('first_name') }}      
	        	</div>
	        	
	        	<div class="form-group">
	        	    {{ Form::label('email', 'E-mail : ') }}
        			{{ Form::text('email') }}
	        	</div>
	        	
	        	<div class="form-group">
			        {{ Form::label('password', 'Mot de passe : ') }}
        			{{ Form::password('password') }}
	        	</div>
	        	
	        	<div class="form-group">
			        {{ Form::label('password_confirm', 'Confirmer : ') }}
        			{{ Form::password('password_confirm') }}
	        	</div>
	        	
	        	@if ($isAdmin)
	        	<div class="form-group">
	        	    {{ Form::checkbox('is_actif') }}
			        {{ Form::label('is_actif', 'Compte actif') }}
	        	</div> 
	        	@endif       	
        	</fieldset>
		</div>
		
		@if (!$user->id || $user->society)
		<div class="col-md-6">
			<fieldset>
		    	<legend>Informations de la société</legend>
		
	    		<div class="form-group">  	
		    		{{ Form::label('name', 'Nom : ') }}
        			{{ Form::text('name', $user->society ? $user->society->name : null) }}
		        </div>
					
	        	<div class="form-group">  
	        	    {{ Form::label('description', 'Description : ') }}
        			{{ Form::textarea('description', $user->society ? $user->society->description : null, array('rows' => 5)) }}     
	        	</div>
	        	
	        	<div class="form-group">
	        	    {{ Form::label('website', 'Site internet: ') }}
       				{{ Form::text('website', $user->society ? $user->society->website : null) }}
	        	</div>
	        	
	        	<div class="form-group">
			        {{ Form::label('telephone', 'Numero de téléphone : ') }}
        			{{ Form::number('telephone', $user->society ? $user->society->telephone : null) }}
	        	</div>
	        	
	        	<div class="form-group">
			        {{ Form::label('address', 'Adresse de votre société : ') }}
        			{{ Form::text('address', $user->society ? $user->society->address : null) }}
	        	</div>
	        	
	        	<div class="form-group">
			        {{ Form::label('locality_id', 'Localité : ') }}
        			{{ Form::select('locality_id', $city, $user->society ? $user->society->locality_id : null) }}
	        	</div>
	        	
			</fieldset>
		</div>
		@endif
		
	</div>
        
    <div class="row">
    	<div class="col-md-6">
    		{{ Form::submit('enregistrer')}}        
    		{{ Form::reset('clear', array('class' => 'btn btn-default')) }}
    	</div>
    </div> 
    
	{{ Form::close() }}	

@stop

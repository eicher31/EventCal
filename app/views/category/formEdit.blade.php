@extends('layout') 

@section('contenu')

	<div class="row">
        <div class="col-md-12">
			<h2>{{{ $cat->id ? "Edition d'une categorie" : "Ajout d'une categorie" }}}</h2>
        </div>
    </div>

{{ Form::model($cat,array('action'=> array($action, $cat->id), 'method' => $methode)) }}
	@include('tools.errors')

	<div class="row">
		<div class="col-md-6">
    		<div class="form-group">  	
	    		{{ Form::label('name',"Nom cat") }}
				{{ Form::text('name') }}
	        </div>
				
        	<div class="form-group">  
        	    {{ Form::label('color',"Nom color") }}
				{{ Form::text('color') }}      
        	</div>
        	
        	<div class="form-group">
		        {{ Form::submit('Enregistrer') }}
        	</div>
		</div>
	</div>
		
{{ Form::close() }}

@stop

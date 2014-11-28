@extends('layout')

@section('css')
	{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('contenu')

	<div class="row">
        <div class="col-md-12">
			<h2>{{{ $event->id ? "Edition de l'évènement" : "Ajout de l'évènement" }}}</h2>
        </div>
    </div>
	
	{{ Form::model($event, array('action' => array($action, $event->id),'method' => $method)) }}
    
    @include('tools.errors')
    
    <div class="row">
		<div class="col-md-6">	
    		@if($societies)
    		<div class="form-group">  	
	    		{{ Form::label('society_id','Société : ')}}
	        	{{ Form::select('society_id',$societies)}}
	        </div>
	    	@endif
				
        	<div class="form-group">  
        	    {{ Form::label('name', "Nom de l'evenement : ") }}
        		{{ Form::text('name')}}       
        	</div>
        	
        	<div class="form-group">
        	    {{ Form::label('description','Description : ')}}
       			{{ Form::textarea('description', null, array('rows' => 5))}}
        	</div>
        	
        	<div class="form-group">
		        {{ Form::label('category_id','Catégorie : ')}}
		        {{ Form::select('category_id',$categories)}}
        	</div>
		</div>
		
		<div class="col-md-6">
			<div class="form-group"> 
				{{ Form::label('date', 'Date : ') }}
				<div class='input-group date' id="datepicker">
                    <span class="input-group-addon">
                    	<span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    {{ Form::text('date', $event->id ? $event->getDate() : '', array('data-date-format' => 'DD.MM.YYYY')) }}
                </div> 
        	</div>
		
			<div class="form-group"> 
				{{ Form::label('time', 'Time : ') }}
                <div class='input-group date' id="timepicker">
                	<span class="input-group-addon">
                    	<span class="glyphicon glyphicon-time"></span>
                    </span>
                    {{ Form::text('time', $event->id ? $event->getTime() : '', array('data-date-format' => 'HH:mm')) }}
                </div>
        	</div>
        	
        	<div class="form-group">
		        {{ Form::label('address', 'Adresse : ') }}
		        {{ Form::text('address')}}
        	</div>
        	
        	<div class="form-group">
		        {{ Form::label('locality_id', 'Localite : ') }}
        		{{ Form::select('locality_id',$localities)}}
        	</div>
		</div>
	</div>
        
    <div class="row">
    	<div class="col-md-6">
    		{{ Form::submit('enregistrer')}}        
    		{{ Form::reset('clear', array('class' => 'btn btn-default')) }}
    	</div>
    </div> 
    
	{{ Form::close() }}	
	
@stop

@section('js')
	{{ HTML::script('js/moment-with-locales.min.js') }}
	{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}
	
	<script type="text/javascript">
		$(function () {
			$('#datepicker').datetimepicker({
				language: 'fr',
				pickTime: false
			});
			
			$('#timepicker').datetimepicker({
				language: 'fr',
				pickDate: false
			});
		});
    </script>
@stop
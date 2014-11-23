@extends('layout')

@section('css')
	{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('contenu')

	@if($event->id)
	<h2>Edition de l'évènement</h2>
	@else
	<h2>Ajout de l'évènement</h2>
	@endif

	@include('tools.errors')
	
	{{ Form::model($event, array('action' => array($action, $event->id),'method' => $method)) }}
        
    <fieldset>
    <legend>Event :</legend>
    	@if($societies)
    		{{ Form::label('society_id','Société : ')}}
        	{{ Form::select('society_id',$societies)}}
    	@endif
    
        {{ Form::label('name', "Nom de l'evenement : ") }}
        {{ Form::text('name')}}       
        
        {{ Form::label('date', 'Date : ') }}
        <div class="container">
		    <div class="row">
		        <div class="col-sm-6">
		            <div class="form-group">
		                <div class='input-group date' id="datepicker">
		                    <span class="input-group-addon">
		                    	<span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                    {{ Form::text('date', $event->id ? $event->getDate() : '', array('data-date-format' => 'YYYY-MM-DD')) }}
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		
		{{ Form::label('time', 'Time : ') }}
        <div class="container">
		    <div class="row">
		        <div class="col-sm-6">
		            <div class="form-group">
		                <div class='input-group date' id="timepicker">
		                	<span class="input-group-addon">
		                    	<span class="glyphicon glyphicon-time"></span>
		                    </span>
		                    {{ Form::text('time', $event->id ? $event->getTime() : '', array('data-date-format' => 'HH:mm')) }}
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
        
        {{ Form::label('address', 'Adresse : ') }}
        {{ Form::text('address')}}
        
        {{ Form::label('locality_id', 'Localite : ') }}
        {{ Form::select('locality_id',$localities)}}
        
        {{ Form::label('description','Description : ')}}
        {{ Form::textarea('description')}}
        
        {{ Form::label('category_id','Catégorie : ')}}
        {{ Form::select('category_id',$categories)}}
    </fieldset>
    
    	{{ Form::reset('clear') }}
    	{{ Form::submit('enregistrer')}}
	{{ Form::close() }}
	
	
	@if($event->id)
		{{ Form::open(array('action' => array('EventCal\Controllers\EventsController@destroy', $event->id), 'method' => 'delete')) }}
			{{ Form::submit('Supprimer') }}
		{{ Form::close()}}
	@endif
	
	
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
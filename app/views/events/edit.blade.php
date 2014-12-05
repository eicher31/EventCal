@extends('layout')

@section('css')
	{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('contenu')

	<div class="row">
        <div class="col-md-12">
			<h2>{{{ $event->id ? Lang::get('message.titleEdit') : Lang::get('message.ajoutEdit') }}}</h2>
			<p>{{ Lang::get('message.editEvent') }}</p>
        </div>
    </div>
    	
	{{ Form::model($event, array('action' => array($action, $event->id),'method' => $method)) }}
    
    @include('tools.errors')
    
    <div class="row">
		<div class="col-md-6">	
    		@if($societies)
    		<div class="form-group">  	
	    		{{ Form::label('society_id',Lang::get('message.society'))}}
	        	{{ Form::select('society_id',$societies)}}
	        </div>
	    	@endif
				
        	<div class="form-group">  
        	    {{ Form::label('name', Lang::get('message.nameEvent')) }}
        		{{ Form::text('name')}}       
        	</div>
        	
        	<div class="form-group">
        	    {{ Form::label('description',Lang::get('message.description'))}}
       			{{ Form::textarea('description', null, array('rows' => 5))}}
        	</div>
        	
        	<div class="form-group">
		        {{ Form::label('category_id',Lang::get('message.categorie'))}}
		        {{ Form::select('category_id',$categories)}}
        	</div>
		</div>
		
		<div class="col-md-6">
			<div class="form-group"> 
				{{ Form::label('date', Lang::get('message.date')) }}
				<div class='input-group date' id="datepicker">
                    <span class="input-group-addon">
                    	<span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    {{ Form::text('date', $event->id ? $event->getDate() : '', 
                    	array('data-date-format' => 'DD.MM.YYYY', 'placeholder' => Lang::get('message.placeholderDate'))) }}
                </div> 
        	</div>
		
			<div class="form-group"> 
				{{ Form::label('time', Lang::get('message.time')) }}
                <div class='input-group date' id="timepicker">
                	<span class="input-group-addon">
                    	<span class="glyphicon glyphicon-time"></span>
                    </span>
                    {{ Form::text('time', $event->id ? $event->getTime() : '', 
                    	array('data-date-format' => 'HH:mm', 'placeholder' => Lang::get('message.placeholderHour'))) }}
                </div>
        	</div>
        	
        	<div class="form-group">
		        {{ Form::label('address', Lang::get('message.editAdress')) }}
		        {{ Form::text('address')}}
        	</div>
        	
        	<div class="form-group">
		        {{ Form::label('locality_id', Lang::get('message.editLocality')) }}
        		{{ Form::select('locality_id',$localities)}}
        	</div>
		</div>
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
@stop
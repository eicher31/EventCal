@extends('layout')

@section('contenu')
		
	<div class="row">
        <div class="{{ $event->isEditable() ? 'col-md-8' : 'col-md-12' }}">
			<h2>{{{ $event->getName() }}}</h2>
		</div>
		
		<div class="col-md-4 btn-containers">
	    @if ($event->isEditable())
	   		{{Button::normal(Lang::get('message.edit'))->asLinkTo(url('event/'.$event->id.'/edit'))}}
	   		
   			{{ Form::open(array('action' => array('EventCal\Controllers\EventsController@destroy', $event->id), 'method' => 'delete')) }}
				{{ Form::submit(Lang::get('message.del'),array('class' => 'btn-del')) }}
			{{ Form::close()}}
		@endif		
		</div>
    </div>
    	
	<div class="row">
		<div class="col-md-6">			
			<div class="form-group">  
	            <label>{{Lang::get('message.showDate')}}</label>
	        	<p>{{{ $event->getDate() }}} {{{ $event->getTime() }}}</p>
        	</div>
        	
        	<div class="form-group">  
	            <label>{{Lang::get('message.showLocality')}}</label>
	        	<p>
        			@if ($event->address)
	        			{{{ $event->address }}} <br />
	        		@endif
        			{{{ $locality->getName() }}}
	        	</p>
			</div>
		        	
        	<div class="form-group">  
	            <label>{{Lang::get('message.showDescription')}}</label>
	        	<p>{{ nl2br(e($event->description)) }}</p>
        	</div>
		</div>
		
		<div class="col-md-6">
			<div class="form-group">  
	            <label>{{Lang::get('message.showCategory')}}</label>
	        	<p>
		        	<span class="label event-label" style="background-color: {{{ $category->color }}};">
		        		{{{ $category->name }}}
	        		</span>
        		</p>
        	</div>
		
			<div class="form-group">  
	            <label>{{Lang::get('message.showOrganizer')}}</label>
	        	<p>
	        		<a href="{{ url('societies', array($society->id)) }}">{{{ $society->getName() }}}</a>
        		</p>
        	</div>
        	
			<div class="form-group">  
	            <label>{{Lang::get('message.showSite')}}</label>
	        	<p>
	        		@if ($society->website)
	        			<a href="{{{ $society->website }}}">{{{ $society->website }}}</a>
	        		@else
	        			{{ Lang::get('message.showNotShow') }}
	        		@endif
	        	</p>
        	</div>
		
			<div class="form-group">  
	            <label>{{Lang::get('message.showTelephone')}}</label>
	        	<p>{{{ $society->telephone ? $society->telephone : Lang::get('message.showNotShow') }}}</p>
        	</div>
        	        	
		</div>
	</div>
	
@stop    
	    
@section('js')
	@include('js.delete_confirm')
@stop
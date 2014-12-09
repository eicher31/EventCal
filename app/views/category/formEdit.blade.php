@extends('layout') 

@section('contenu')

	<div class="row">
        <div class="col-md-12">
			<h2>{{{ $cat->id ? Lang::get('message.catEdit') : Lang::get('message.catAdd') }}}</h2>
        </div>
    </div>

	{{ Form::model($cat,array('action'=> array($action, $cat->id), 'method' => $methode)) }}
	@include('tools.errors')

	<div class="row">
		<div class="col-md-6">
    		<div class="form-group">  	
	    		{{ Form::label('name',Lang::get('message.catName')) }}
				{{ Form::text('name') }}
	        </div>
				
        	<div class="form-group">  
        	    {{ Form::label('color',Lang::get('message.catColor')) }}
				{{ Form::text('color') }}      
				 <p class="help-block">@lang('message.helperColorCat')</p>
        	</div>
        	
        	<div class="form-group">
		        {{ Form::submit(Lang::get('message.save')) }}
		        {{ Form::reset(Lang::get('message.reset'), array('class' => 'btn btn-default')) }}
        	</div>
		</div>
	</div>
		
{{ Form::close() }}

@stop

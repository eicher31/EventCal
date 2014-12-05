@extends('layout') 

@section('contenu')

	<div class="row">
        <div class="col-md-8">
			<h2>{{{ Lang::get('message.catAdmin') }}}</h2>
        </div>
        <div class="col-md-4 btn-containers">
			{{ Button::normal(Lang::get('message.catAdd'))->asLinkTo(url("admin/category/create")) }}
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10 btn-containers">
        	<table class="table table-condensed">
				<thead>
					<tr>
						<th>{{ Lang::get('message.catName') }}</th>
						<th>{{ Lang::get('message.listingRowAction') }}</th>
					</tr>
				</thead>
				
				<tbody>
					@foreach ($categories as $cat)
					<tr>
						<th>
							<h2>
								<span class="label event-label" style="background-color: {{{ $cat->color }}};"> 
								{{{ $cat->name }}}
								</span>
							</h2>
						</th>
						<th>
							{{ Button::normal(Lang::get('message.edit'))->asLinkTo(url("admin/category/$cat->id/edit")) }}
							
							{{ Form::open(array('action'=> array('EventCal\Controllers\Admin\EventCategoryController@destroy', $cat->id), 'method' => 'delete')) }}
								{{ Form::submit(Lang::get('message.del'), array('id' => 'btn-del')) }}
							{{ Form::close() }}
						</th>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	
@stop

@section('js')
	<script type="text/javascript">
		$('#btn-del').click(function(e)
			{
				return confirm("{{Lang::get('message.msgConfirmDelete')}}");
			});
    </script>	
@stop

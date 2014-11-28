
<div class="row">
   <div class="col-md-12">
	@if ($errors->any())
		{{ Alert::warning(implode('<br />', $errors->all()))->close() }}
	@endif
	</div>
</div>
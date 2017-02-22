@if(Session::has('deleted_message'))
	<div class="alert alert-danger alert-message fade" style="margin-top:10px;font-size:14px">			
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{session('deleted_message')}}
	</div>
@endif

@if(Session::has('created_message'))
	<div class="alert alert-success alert-message fade" style="margin-top:10px;font-size:14px;">
		 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{session('created_message')}}
	</div>
@endif

@if(Session::has('updated_message'))
	<div class="alert alert-success alert-message fade" style="margin-top:10px;font-size:14px">			
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{session('updated_message')}}
	</div>
@endif

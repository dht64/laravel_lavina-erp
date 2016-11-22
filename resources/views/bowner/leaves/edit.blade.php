@extends('layouts.bowner')

@section('content')
	<h1>Edit Leaves</h1>
	
	<div class="row">
		<div class="col-sm-3">
			<img src="{{ URL::asset($leave->human->photo ? 'images/'.$leave->human->photo : '/images/human.png') }}" alt="Employee Photo" class="img-responsive img-rounded">
		</div>
		
		<div class="col-sm-9">
			{!! Form::model($leave, ['method'=>'PATCH', 'action'=>['LeavesController@update', $leave->id]]) !!}

			<div class="form-group col-sm-6">
				{!! Form::label('annual_leave', 'Paid Leaves:') !!}
				{!! Form::number('annual_leave', null, ['class'=>'form-control', 'min'=>0, 'max'=>365]) !!}
			</div>

			<div class="form-group col-sm-6">
				{!! Form::label('avai_annual_leave', 'Remaining Paid Leaves:') !!}
				{!! Form::number('avai_annual_leave', null, ['class'=>'form-control', 'min'=>0, 'max'=>365]) !!}
			</div>
			
			<div class="form-group col-sm-6">
				{!! Form::submit('Save', ['class'=>'btn btn-primary col-sm-3']) !!}
				<a class="btn btn-warning col-sm-3" href="{{URL('/bowner/leaves')}}">Cancel</a>
			</div>

			{!! Form::close() !!}
			
		</div>
	</div>
	<div class="row">
		@include('includes.form_error')
	</div>	
@stop

@section('scripts')
	<script type="text/javascript">
	var date = new Date();
	$(function() {
		$('input[id="nondeduct_leave"]').multiDatesPicker({
			dateFormat: 'dd-mm-yy',
		}).keypress(function(){
			return false;
		});
		$('input[id="deduct_leave"]').multiDatesPicker({
			dateFormat: 'dd-mm-yy',
		}).keypress(function(){
			return false;
		});
	});
	</script>
@stop
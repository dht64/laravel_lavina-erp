@extends('layouts.bowner')

@section('content')
	<h1>Add Employee</h1>
	
	{!! Form::open(['method'=>'POST', 'action'=>'BownerHumansController@store', 'files'=>true]) !!}
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('name', 'Name (*):') !!}
			{!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group col-sm-6">
			{!! Form::label('job', 'Job Title (*):') !!}
			{!! Form::text('job', null, ['class'=>'form-control', 'required']) !!}
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-6 has-feedback">
			{!! Form::label('start_day', 'Start Day (*):') !!}
			{!! Form::text('start_day', null, ['class'=>'form-control', 'required']) !!}
			<span class="glyphicon glyphicon-calendar form-control-feedback" style="right: 10px; top: 22px;"></span>
		</div>

		<div class="form-group col-sm-6 has-feedback">
			{!! Form::label('birth', 'Date of Birth (*):') !!}
			{!! Form::text('birth', null, ['class'=>'form-control', 'required']) !!}
			<span class="glyphicon glyphicon-calendar form-control-feedback" style="right: 10px; top: 22px;"></span>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('gender', 'Gender (*):') !!}
			{!! Form::select('gender', [''=>'Choose Option', 'male'=>'Male', 'female'=>'Female'], null, ['class'=>'form-control', 'required']) !!}
		</div>
		
		<div class="form-group col-sm-6">
			{!! Form::label('phone', 'Phone (*):') !!}
			{!! Form::text('phone', null, ['class'=>'form-control', 'required']) !!}
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('idnum', 'ID# (*):') !!}
			{!! Form::text('idnum', null, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group col-sm-6">
			{!! Form::label('address1', 'Address 1 (*):') !!}
			{!! Form::text('address1', null, ['class'=>'form-control', 'required']) !!}
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('address2', 'Address 2:') !!}
			{!! Form::text('address2', null, ['class'=>'form-control']) !!}
		</div>
	
		<div class="form-group col-sm-6">
				{!! Form::label('photo', 'Photo:') !!}
				{!! Form::file('photo', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-3">
			{!! Form::submit('Add Employee', ['class'=>'btn btn-primary']) !!}
		</div>
	</div>

	{!! Form::close() !!}	
	
	<hr>
	@include('includes.form_error')
	
@stop

@section('scripts')
	<script type="text/javascript">
	$(function() {
		$('input[id="start_day"], input[id="birth"]').daterangepicker({
			format: 'DD-MM-YYYY',
			singleDatePicker: true,
			showDropdowns: true
		}, 
		function(start, end, label) {
			var years = moment().diff(start, 'years');
			//alert("You joined " + years + " ago");
		});
	});
	</script>
@stop
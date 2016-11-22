@extends('layouts.bowner')

@section('content')
	<h1>Edit Customer</h1>
	
	{!! Form::model($customer, ['method'=>'PATCH', 'action'=>['CustomerController@update', $customer->id]]) !!}
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('name', 'Name (*):') !!}
			{!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
		</div>
		
		<div class="form-group col-sm-6">
			{!! Form::label('phone', 'Phone (*):') !!}
			{!! Form::text('phone', null, ['class'=>'form-control', 'required']) !!}
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('address1', 'Address 1 (*):') !!}
			{!! Form::text('address1', null, ['class'=>'form-control', 'required']) !!}
		</div>
	
		<div class="form-group col-sm-6">
			{!! Form::label('address2', 'Address 2:') !!}
			{!! Form::text('address2', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('tax_num', 'Tax Code:') !!}
			{!! Form::text('tax_num', null, ['class'=>'form-control']) !!}
		</div>
	</div>
		
	<div class="row">
		<div class="form-group" style="padding-left:10px;">
			{!! Form::submit('Save', ['class'=>'btn btn-primary col-sm-2']) !!}
		</div>
	</div>
	{!! Form::close() !!}	

	{!! Form::open(['method'=>'DELETE', 'action'=>['CustomerController@destroy', $customer->id]]) !!}
		<div class="form-group" style="margin-top:-50px;">
			{!! Form::submit('Delete Customer', ['class'=>'btn btn-danger col-sm-2']) !!}
		</div>
	{!! Form::close() !!}
	
	<hr>
	@include('includes.form_error')
	
	
@stop

@section('scripts')
	<script type="text/javascript">
	</script>
@stop
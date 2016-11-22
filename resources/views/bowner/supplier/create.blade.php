@extends('layouts.bowner')

@section('content')
	<h1>Add Supplier</h1>
	
	{!! Form::open(['method'=>'POST', 'action'=>'SupplierController@store']) !!}
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
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description', null, ['size'=>'30x5', 'class'=>'form-control']) !!}
		</div>
	</div>
		
	<div class="row">
		<div class="form-group col-sm-3">
			{!! Form::submit('Add Supplier', ['class'=>'btn btn-primary']) !!}
		</div>
	</div>

	{!! Form::close() !!}	
	
	<hr>
	@include('includes.form_error')
	
@stop

@section('scripts')
	<script type="text/javascript">
	</script>
@stop
@extends('layouts.bowner')

@section('content')

	<h1>Edit Purchasing</h1>

	{!! Form::model($purchase, ['method'=>'PATCH', 'action'=>['MaterialPurchaseController@update', $purchase->id], 'class'=>'form-group']) !!}
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('material_id', 'Material:') !!}
			{!! Form::select('material_id', [''=>'Choose Material'] + $materials, null, ['class'=>'form-control', 'required']) !!}
		</div>	

		<div class="form-group col-sm-6">
			{!! Form::label('supplier_id', 'Supplier:') !!}
			{!! Form::select('supplier_id', [''=>'Choose Supplier'] + $suppliers, null, ['class'=>'form-control', 'required']) !!}
		</div>	

		<div class="form-group col-sm-6">
			{!! Form::label('quantity', 'Purchase Quantity:') !!}
			{!! Form::number('quantity', null, ['class'=>'form-control', 'min'=>0]) !!}
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
			<a class="btn btn-warning" href="{{URL('/bowner/inventories/material/purchase')}}">Cancel</a>
		</div>
	</div>

	{!! Form::close() !!}

@stop
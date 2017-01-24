@extends('layouts.bowner')

@section('content')

	<h1>Edit Product</h1>

	{!! Form::model($product, ['method'=>'PATCH', 'route'=>['bowner.inventories.product.update', $product->id], 'class'=>'form-group']) !!}
	
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('name', 'Product:') !!}
			{!! Form::text('name', null, ['class'=>'form-control', 'disabled']) !!}
		</div>	

		<div class="form-group col-sm-6">
			{!! Form::label('quantity', 'Available Quantity (*):') !!}
			{!! Form::number('quantity', null, ['class'=>'form-control', 'min'=>0, 'required']) !!}
		</div>
	</div>
	
	@if (!($product->unit->name == 'hod'))
		<div class="row">
			<div class="form-group col-sm-6">
				{!! Form::label('extra', 'Extra (precision):') !!}
				{!! Form::number('extra', null, ['class'=>'form-control', 'min'=>0]) !!}
			</div>
		</div>
	@endif
	
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::submit('Save', ['class'=>'btn btn-primary col-sm-3']) !!}
			<a class="btn btn-warning col-sm-3" href="{{URL('/bowner/inventories')}}">Cancel</a>
		</div>
	</div>

	{!! Form::close() !!}

@stop
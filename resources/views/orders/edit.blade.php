@extends('layouts.bowner')

@section('content')

	<h1>Edit Order</h1>

	{!! Form::model($order, ['method'=>'PATCH', 'action'=>['OrderController@update', $order->id]]) !!}

	<div class="form-group col-sm-6">
		{!! Form::label('product', 'Product (*):') !!}
		{!! Form::select('product', $products, $order->product_id, ['class'=>'form-control', 'required']) !!}
	</div>	

	<div class="form-group col-sm-6">
		{!! Form::label('quantity', 'Quantity (*):') !!}
		{!! Form::number('quantity', null, ['class'=>'form-control', 'min'=>0]) !!}
	</div>

	<div class="form-group col-sm-6">
		{!! Form::label('vat', 'VAT Code:') !!}
		{!! Form::select('vat', [0=>'No', 1=>'Yes'], null, ['class'=>'form-control']) !!}
	</div>

	<div class="form-group col-sm-6">
		{!! Form::label('customer', 'Customer (*):') !!}
		<select name="customer" id="customer" class="form-control">
			@foreach($customers as $customer)
				<option value="{{ $customer->id }}" {{ $customer->id == $order->customer_id ? 'selected' : '' }}>{{ $customer->name .' ( '.$customer->address1 .' )' }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group col-sm-6 has-feedback">
		{!! Form::label('delivery_at', 'Delivery By (*):') !!}
		{!! Form::text('delivery_at', $value=$delivery_at, ['class'=>'form-control']) !!}
		<span class="glyphicon glyphicon-calendar form-control-feedback" style="right: 10px; top: 22px;"></span>
	</div>

	<div class="form-group col-sm-6">
		{!! Form::label('note', 'Note:') !!}
		{!! Form::textarea('note', null, ['size'=>'30x5', 'class'=>'form-control']) !!}
	</div>

	<div class="form-group col-sm-6">
		{!! Form::submit('Save', ['class'=>'btn btn-primary col-sm-3']) !!}
		<a class="btn btn-warning col-sm-3" href="{{URL('/orders')}}">Cancel</a>
	</div>

	{!! Form::close() !!}

@stop

@section('scripts')
<script>
	$(function() {
		$('input[id="delivery_at"]').daterangepicker({
			format: 'DD-MM-YYYY',
			singleDatePicker: true,
			showDropdowns: true
		},
		function(start, end, label) {
			var years = moment().diff(start, 'years');
		});
	});
</script>
@stop


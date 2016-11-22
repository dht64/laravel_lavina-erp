@extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>Order</h1>
	<!-- Start .nav nav-tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presenstation" class="active"><a href="#view" aria-controls="view" role="tab" data-toggle="tab"><strong>View Orders</strong></a></li>
		<li role="presenstation"><a href="#create" aria-controls="create" role="tab" data-toggle="tab"><strong>Create Orders</strong></a></li>
	</ul>
	<!-- End .nav nav-tabs -->

	<div class="tab-content">
		<!-- Show Orders -->
		<div role="tabpanel1" class="tab-pane fade in active" id="view">
			<br>
			<div class="table-responsive">
			<table class="table table-responsive table-bordered table-striped">
			    <thead>
			      <tr>
			        <th>Id</th>
			        <th>Actions</th>
			        <th>Customer</th>
			        <th>Product</th>
			        <th>Cost/UOM</th>
			        <th>UOM</th>
			        <th>Qty</th>
			        <th>Stock</th>
			        <th>VAT (5%)</th>
			        <th>Total Cost</th>
			        <th>Status</th>
			        <th>Created By</th>
			        <th>Order Date</th>
			        <th>Updated Date</th>
			        <th>Delivery Date</th>
			        <th>Note</th>
			      </tr>
			    </thead>
			    <tbody>
					@foreach ($orders as $order)
					  <tr>
						<td>{{ $order->id }}</td>
						<td>
							<div style="display: inline-flex;">
						@if ($order->status == 0 && $order->deliver == 0 && (Auth::user()->isBowner() || (Auth::user()->isEmployee() && $order->user_id == 3)))
							<!-- Edit button -->
							<a class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="left" title="edit order" href="{{ route('orders.edit', $order->id) }}"><span class="glyphicon glyphicon-pencil"></span></a>
						@else
							<!-- Disable Edit button -->
							<a href="#" class="btn btn-xs btn-primary disabled"><span class="glyphicon glyphicon-pencil"></span></a>
						@endif
						@if (Auth::user()->isBowner())
							<!-- Delete button -->
							<a class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="{{ $order->status == 1 ? 'delete order' : 'cancel order' }}" href="{{ route('bowner.orders.destroy', $order->id) }}"><span class="glyphicon glyphicon-remove"></span></a>
						@endif
						@if (($order->submit == 1) && ($order->deliver == 1) &&($order->status == 0) && (Auth::user()->isBowner()))
							<!-- Complete button -->
							<a class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="right" title="complete order" href="{{route('bowner.orders.complete', $order->id)}}"><span class="glyphicon glyphicon-ok"></span></a>
						@endif
							</div>
						</td>
						<td>{{ $order->customer->name }}</td>
						<td>{{ $order->product->name }}</td>
						<td>{{ $order->product->cost }}</td>
						<td>{{ $order->product->unit->name }}</td>
						<td>{{ $order->quantity }}</td>
						<td>{{ $order->product->quantity }}</td>
						<td>{{ $order->vat ? 'Yes' : 'No' }}</td>
						<td>{{ $order->total_cost }}</td>
					@if (($order->submit == 0) && (Auth::user()->isBowner()))
						<td><a href="{{ route('bowner.orders.submit', $order->id) }}" class="btn btn-xs btn-primary btn-block">Submit Order</a></td>
					@elseif (($order->submit == 0) && (Auth::user()->isEmployee()))
						<td>Waiting for submission</td>
					@elseif ($order->status == 1)
						<td class="success">Completed <span class="text-success glyphicon glyphicon-ok"></span></td>
					@elseif (($order->deliver == 0) && ($order->product->quantity < $order->quantity))
						<td style="background-color: #ffffe6;"><b>Not enough stock</b></td>
					@elseif (($order->deliver == 0) && (Auth::user()->isBowner())) 
						<td><a href="{{ route('bowner.orders.deliver', $order->id) }}" class="btn btn-xs btn-block btn-pink">Submit for delivery</a></td>
					@elseif (($order->deliver == 0) && (Auth::user()->isEmployee())) 
						<td style="background-color: #ffe6e6;">Waiting for submitting delivery</td>
					@else
						<td class="info">Waiting for delivery &nbsp;<a href="{{ route('orders.show', $order->id) }}" target="_blank"><span class="glyphicon glyphicon-print" data-toggle="tooltip" data-placement="right" title="print"></span></a> </td>
					@endif
						<td>{{ $order->user->name }}</td>
						<td>{{ $order->created_at->diffForHumans() }}</td>
						<td>{{ $order->updated_at->diffForHumans() }}</td>
						<td>{{ date("d-m-Y", strtotime($order->delivery_at)) }}</td>
						<td>{{ $order->note }}</td>
					  </tr>
					@endforeach
			    </tbody>
		  	</table>
		  	</div>
		  	<!-- End .table-responsive -->

			<!-- Pagination -->
		  	<div class="row">
		  		<div class="text-center">
		  			{{ $orders->render() }}
		  		</div>
		  	</div>
		</div>
		<!-- End .tab-pane -->
		<!-- End Show Order -->

		<!-- Create Order -->
		<div role="tabpanel2" class="tab-pane fade" id="create">
			{!! Form::open(['method'=>'POST', 'action'=>'OrderController@store', 'class'=>'form-group']) !!}

			<div class="form-group col-sm-6">
				{!! Form::label('product', 'Product (*):') !!}
				{!! Form::select('product[]', [''=>'Choose Product'] + $products, null, ['class'=>'form-control', 'required']) !!}
			</div>	

			<div class="form-group col-sm-6">
				{!! Form::label('quantity', 'Quantity (*):') !!}
				{!! Form::number('quantity[]', null, ['class'=>'form-control', 'min'=>0]) !!}
			</div>

			<div class="form-group col-sm-6">
				{!! Form::label('product', 'Product (*):') !!}
				{!! Form::select('product[]', [''=>'Choose Product'] + $products, null, ['class'=>'form-control', 'required']) !!}
			</div>	

			<div class="form-group col-sm-6">
				{!! Form::label('quantity', 'Quantity (*):') !!}
				{!! Form::number('quantity[]', null, ['class'=>'form-control', 'min'=>0]) !!}
			</div>

			<div class="form-group col-sm-6">
				{!! Form::label('vat', 'VAT Code:') !!}
				{!! Form::select('vat', [0=>'No', 1=>'Yes'], 0, ['class'=>'form-control']) !!}
			</div>

			<div class="form-group col-sm-6">
				{!! Form::label('customer', 'Customer (*):') !!}
				<select name="customer" id="customer" class="form-control" required>
					<option value="" selected>Choose Customer</option>
					@foreach($customers as $customer)
						<option value="{{ $customer->id }}">{{ $customer->name .' ( '.$customer->address1 .' )' }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group col-sm-6 has-feedback">
				{!! Form::label('delivery_at', 'Delivery By (*):') !!}
				{!! Form::text('delivery_at', null, ['class'=>'form-control']) !!}
				<span class="glyphicon glyphicon-calendar form-control-feedback" style="right: 10px; top: 22px;"></span>
			</div>

			<div class="form-group col-sm-6">
				{!! Form::label('note', 'Note:') !!}
				{!! Form::textarea('note', null, ['size'=>'30x5', 'class'=>'form-control']) !!}
			</div>
	
			<div class="form-group col-sm-6">
				{!! Form::submit('Create Order', ['class'=>'btn btn-primary']) !!}
				<a class="btn btn-info" href="{{ url('/customer/create') }}">Add Customer</a>
			</div>

			{!! Form::close() !!}
		</div>
		<!-- End .tab-pane -->
		<!-- End Create Order -->
	</div>
	<!-- End .tab-content -->

@stop

@section('scripts')
<script>
	$(function() {
		$('input[id="delivery_at"]').daterangepicker({
			format: 'DD-MM-YYYY',
			singleDatePicker: true,
			showDropdowns: true,
			minDate: moment(),
		},
		function(start, end, label) {
			var years = moment().diff(start, 'years');
		});
	});
</script>
@stop


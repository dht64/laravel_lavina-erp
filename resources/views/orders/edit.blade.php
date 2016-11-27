 @extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>Order Detail</h1>
	<!-- Start .nav nav-tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presenstation" class="active"><a href="#view" aria-controls="view" role="tab" data-toggle="tab"><strong>View Order Detail</strong></a></li>
		@if (!$order->deliver)
		<li role="presenstation"><a href="#create" aria-controls="create" role="tab" data-toggle="tab"><strong>Edit Order</strong></a></li>
		@endif
	</ul>
	<!-- End .nav nav-tabs -->

	<div class="tab-content">
		<!-- Show Orders -->
		<div role="tabpanel1" class="tab-pane fade in active" id="view">
			<br>
			<h4>Order ID: {{ $order->id }}</h4>
			<div class="table-responsive">
			<table class="table table-responsive table-bordered table-striped">
			    <thead>
			      <tr>
			        <th>#</th>
			        <th>Product</th>
			        <th>Price/UOM</th>
			        <th>UOM</th>
			        <th>Quantity</th>
			        @if (!$order->deliver)
				        <th>Stock</th>
			        @endif
			        <th>VAT (5%)</th>
			        <th>Price ($)</th>
			        <th>Status</th>
			      </tr>
			    </thead>
			    <tbody>
		    	@php
		    		$i = 1;
		    	@endphp
				@foreach ($details as $detail)
				  	<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $detail->product->name }}</td>
						<td>{{ $detail->product->cost }}</td>
						<td>{{ $detail->product->unit->name }}</td>
						<td>{{ $detail->quantity }}</td>
						@if (!$order->deliver)
							<td>{{ $detail->product->quantity }}</td>
						@endif
						<td>{{ $order->vat ? 'Yes' : 'No' }}</td>
						<td>{{ $detail->total_cost }}</td>
					@if ($order->submit == 0) 
						<td>Waiting for submission</td>
					@elseif ($order->status == 1)
						<td class="success">Completed <span class="text-success glyphicon glyphicon-ok"></span></td>
					@elseif (($order->deliver == 0) && ($detail->product->quantity < $detail->quantity))
						<td style="background-color: #ffffe6;"><b>Not enough stock</b></td>
					@elseif ($order->deliver == 0) 
						<td>Ready for delivery</td>
					@else
						<td>Waiting for delivery</td>
					@endif
					</tr>
				@endforeach
					<tr>	
						@if ($order->deliver)
						<td colspan="4"></td>
						@else
						<td colspan="5"></td>
						@endif
						<td colspan="2">Total Price:</td>
						<td>{{ $order->total_cost}}</td>
						<td></td>
					</tr>
			    </tbody>
		  	</table>
		  	</div>
		  	<!-- End .table-responsive -->
		  	<a href="{{ url('orders') }}" class="btn btn-info"><span class="glyphicon glyphicon-chevron-left"></span> Back to Orders</a>
		</div>
		<!-- End View Order .tab-pane -->
		
		@if (!$order->deliver)
		<!-- Edit Order -->
		<div role="tabpanel2" class="tab-pane fade" id="create" style="padding: 20px;">
			<div class="row add-button">
				<a class="btn btn-success add-product" style="margin: 0 0 10px 10px;">Add Product</a>
			</div>
			{!! Form::model($order, ['method'=>'PATCH', 'action'=>['OrderController@update', $order->id]]) !!}
			<div class="clone-parent">
			@foreach ($details as $detail)
				<div class="row row-clone">
					<div class="form-group col-sm-6">
						{!! Form::label('products', 'Product (*):') !!}
						{!! Form::select('products[]', $products, $detail->product_id, ['class'=>'form-control product', 'placeholder'=>'Choose Product', 'required']) !!}
					</div>	

					<div class="form-group col-sm-5">
						{!! Form::label('quantity', 'Quantity (*):') !!}
						{!! Form::number('quantity[]', $detail->quantity, ['class'=>'form-control', 'min'=>1, 'required']) !!}
					</div>

					<a class='btn btn-warning remove' style='margin-top:23px;'>Remove</a>
				</div>
			@endforeach
			</div>
			
			<div class="row">
				<div class="form-group col-sm-6">
					{!! Form::label('vat', 'VAT Code:') !!}
					{!! Form::select('vat', [0=>'No', 1=>'Yes'], null, ['class'=>'form-control']) !!}
				</div>

				<div class="form-group col-sm-6">
					{!! Form::label('customer', 'Customer (*):') !!}
					<select name="customer" id="customer" class="form-control" required>
						@foreach($customers as $customer)
							<option value="{{ $customer->id }}" {{ $customer->id == $order->customer_id ? 'selected' : '' }}>{{ $customer->name .' ( '.$customer->address1 .' )' }}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group col-sm-6 has-feedback">
					{!! Form::label('delivery_at', 'Delivery By (*):') !!}
					{!! Form::text('delivery_at', $value=$delivery_at, ['class'=>'form-control']) !!}
					<span class="glyphicon glyphicon-calendar form-control-feedback" style="right: 10px; top: 22px;"></span>
				</div>

				<div class="form-group col-sm-6">
					{!! Form::label('note', 'Note:') !!}
					{!! Form::textarea('note', null, ['size'=>'30x5', 'class'=>'form-control']) !!}
				</div>
			</div>
	
			<div class="form-group col-sm-6">
				{!! Form::submit('Save', ['class'=>'btn btn-primary col-sm-3']) !!}
				<a class="btn btn-warning col-sm-3" href="{{ route('orders.index') }}">Cancel</a>
			</div>

			{!! Form::close() !!}
			<hr>
			<div class="alert alert-warning myalert">
				<ul>
					<li>Products chosen are duplicated.</li>
				</ul>
			</div>
		</div>
		<!-- End Edit Order .tab-pane -->
		@endif
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
<script type="text/javascript">
	$(function() {
		//Add product when clicking button	
		$cloneParent = $("div.clone-parent");
		$cloneInput = $("div.row-clone:first");

		// Hide alert for duplicated products
		$(".myalert").hide();

		// get total number of products could be selected
		productQty = {{ count($products) }};

		// Click button to add products 
		$("div.add-button").on('click', 'a.add-product', function(e) {
			e.preventDefault();
			
			// clone input field
			$cloneInput.clone()
				.appendTo("div.clone-parent");
			$("div.row-clone>.form-group>input:last").val("");
			$("div.row-clone>.form-group>select:last").val("");

			// Disable add-product button if input fields > products quantity
			if ($("div.row-clone").length >= productQty) {
				$("a.add-product").prop("disabled", true);
			}

			// re-allow remove button if more than 1
			if ($("a.btn.remove").length > 1) {
				$("a.btn.remove").prop("disabled", false);
			}
		});

		$submitBut = $("input:submit");
		// Check if duplicated products
		function checkSelected() {
			$selected = $("select.product");
			console.log("select length: " + $selected.length);
			for (i = 0; i < $selected.length
				; i++) {
				flag = 0;
				thisSelect = $selected[i].value;
				console.log("current select: " + thisSelect);
				if (thisSelect == "") { continue; }
				$selected.not($selected[i]).each(function() {
					console.log("value check: " + this.value);
					if (this.value == thisSelect) {
						$(".myalert").show();
						$submitBut.prop("disabled", true);
						flag = 1;
					}
				}); // /.each
				if (flag == 1) { break; }
			} // /for
			if (flag == 0) {
				$(".myalert").hide();
				$submitBut.prop("disabled", false);
			}	
		};

		// Click remove button 
		$cloneParent.on('click', 'a.btn.remove', function(e) {
			e.preventDefault();
			$(this).parent().remove();

			// re-allow add button 
			console.log("pQty:" + productQty);
			console.log("clone length:" + $("div.row-clone").length);
			if ($("div.row-clone").length < productQty) {
				console.log("enable");
				$("a.add-product").prop("disabled", false);
			}
			
			checkSelected();

	    	// Check if last remove then disable
	    	if ($("a.btn.remove").length == 1) {
	    		//console.log("btn remove:" + $(this).length)
	    		$("a.btn.remove").prop("disabled", true);
	    	}  else {
	    		$("a.btn.remove").prop("disabled", false);
	    	}
		}); // /remove button click
		
		// Check if duplicated products when selected
	    $cloneParent.on('change', 'select', function () {
	    	checkSelected();
		});
	});
</script>
@stop


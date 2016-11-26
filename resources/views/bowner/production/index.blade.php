@extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>Production</h1>

	<div class="btn btn-primary" onClick="window.print()"><span class="glyphicon glyphicon-print"></span> Print This Page</div><br><br>

	<!-- Start .table-responsive -->
	<div class="table-responsive">
		<table class="table table-responsive table-bordered table-striped">
			<thead>
				<tr>
					<th>Order Id</th>
					<th>Product</th>
					<th>UOM</th>
					<th>Order Qty</th>
					<th>Inventory Qty</th>
					<th>(Extra)</th>
					<th>Material Qty</th>
					<th>Status</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($orders as $order)
				@php 
					$i = 0; // count items in an order 
					$orderFilled[$order->id] = 1;
				@endphp
				<tr>
					<td rowspan="{{ $count = count($order->orderdetail()->get()) }}">{{ $order->id }}</td>
				@foreach ($order->orderdetail()->get() as $detail)
					@php 
						$i++;
					@endphp
						<td>{{ $detail->product->name }}</td>
						<td>{{ $detail->product->unit->name }}</td>
						<td>{{ $detail->quantity }}</td>
						<td>{{ $products[$detail->product_id] }} (x <i>{{ $detail->product->unit->equi }}</i>)</td>
						<td><i>{{ $detail->product->extra }}<i></td>
						<td>{{ $detail->product->material->quantity }} (x <i>{{ $detail->product->material->unit->equi }}</i>)</td>
						@if (($o_qty = $detail->quantity) <= $products[$detail->product_id])
							@php
								$flag[$detail->product_id] = 0
							@endphp
							<!-- Filled status -->
							<td class="success">Filled &nbsp;
							{{-- Appear print after done checking all items of the order --}}
							@if (($i == $count) && ($orderFilled[$order->id] == 1))
								<a class="btn btn-xs btn-success pull-right" href="{{route('bowner.production.show', $order->id)}}" target="_blank"><span class="glyphicon glyphicon-print" data-toggle="tooltip" data-placement="top" title="print"></span></a>
							@endif
							</td>
						@elseif ((($m_qty = $detail->product->material->quantity) <= 0) || ((($o_qty - $products[$detail->product_id]) * $detail->product->unit->equi) > ($m_qty * $detail->product->material->unit->equi)))
							<!-- Lack Material status -->
							<td class="warning">Lack Material</td>
							@php
								$orderFilled[$order->id] = 0;
							@endphp
						@else
							<!-- Under Production status -->
							<td>Ready for Production 
							@if ($flag[$detail->product_id] == 0)
								<a class="btn btn-xs btn-default pull-right" data-toggle="tooltip" data-placement="top" title="complete production" href="{{ route('bowner.production.complete', [$detail->quantity, $detail->product_id, $products[$detail->product_id]]) }}"><span class="glyphicon glyphicon-ok"></span></a>
								@php 
									$flag[$detail->product_id] = 1;
									$orderFilled[$order->id] = 0;
								@endphp
							@endif
							</td>
						@endif
						<td>{{ date("d-m-Y", strtotime($detail->updated_at)) }}</td>
					</tr>
					@php 
						$products[$detail->product_id] -= $detail->quantity 
					@endphp
				@endforeach
			@endforeach
			</tbody>
		</table>
	</div>
	<!-- / .table-responsive -->

	<!-- Pagination -->
  	<div class="row">
  		<div class="text-center">
  			{{ $orders->render() }}
  		</div>
  	</div>

@stop

@section('scripts')
<script>
</script>
@stop


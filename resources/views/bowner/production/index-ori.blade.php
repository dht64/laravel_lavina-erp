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
				<tr>
					<td>{{ $order->id }}</td>
					<td>{{ $order->product->name }}</td>
					<td>{{ $order->product->unit->name }}</td>
					<td>{{ $order->quantity }}</td>
					<td>{{ $products[$order->product_id] }} (x <i>{{ $order->product->unit->equi }}</i>)</td>
					<td><i>{{ $order->product->extra }}<i></td>
					<td>{{ $order->product->material->quantity }} (x <i>{{ $order->product->material->unit->equi }}</i>)</td>
					@if (($o_qty = $order->quantity) <= $products[$order->product_id])
						@php 
							$flag[$order->product_id] = 0
						@endphp
						<!-- Filled status -->
						<td class="success">Filled &nbsp;<a class="btn btn-xs btn-success pull-right" href="{{route('bowner.production.show', $order->id)}}" target="_blank"><span class="glyphicon glyphicon-print" data-toggle="tooltip" data-placement="top" title="print"></span></a></td>
					@elseif ((($m_qty = $order->product->material->quantity) <= 0) || ((($o_qty - $products[$order->product_id]) * $order->product->unit->equi) > ($m_qty * $order->product->material->unit->equi)))
						<!-- Lack Material status -->
						<td class="warning">Lack Material</td>
					@else
						<!-- Under Production status -->
						<td>Ready for Production 
						@if ($flag[$order->product_id] == 0)
							<a class="btn btn-xs btn-default pull-right" data-toggle="tooltip" data-placement="top" title="complete production" href="{{ route('bowner.production.complete', [$order->id, $products[$order->product_id]]) }}"><span class="glyphicon glyphicon-ok"></span></a>
							@php 
								$flag[$order->product_id] = 1
							@endphp
						@endif
						</td>
					@endif
					<td>{{ date("d-m-Y", strtotime($order->updated_at)) }}</td>
				</tr>
				@php 
					$products[$order->product_id] -= $order->quantity 
				@endphp
				</div>
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


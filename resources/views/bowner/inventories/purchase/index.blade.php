@extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>All Purchases</h1>
	<div class="row">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
			    <thead>
			      <tr>
			        <th>Id</th>
			        <th>Actions</th>
			        <th>Product</th>
			        <th>Cost</th>
			        <th>UOM</th>
			        <th>Quantity</th>
			        <th>Supplier</th>
			        <th>Total Cost</th>
			        <th>Status</th>
			        <th>Date</th>
			      </tr>
			    </thead>
			    <tbody>
					@foreach($purchases as $purchase)
					  <tr>
						<td>{{$purchase->id}}</td>
						<td>
							<div style="display: inline-flex;">
							<!-- Edit button -->
						@if ($purchase->status == 0)
							<a class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="left" title="edit purchase" href="{{route('bowner.purchase.edit', $purchase->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
						@else 
							<a href="#" class="btn btn-xs btn-primary disabled"><span class="glyphicon glyphicon-ok"></span></a>
						@endif
							<!-- Delete button -->
							<a class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="delete purchase" href="{{route('bowner.purchase.destroy', $purchase->id)}}"><span class="glyphicon glyphicon-remove"></span></a>
						@if ($purchase->status == 0)
							<!-- Complete button -->
							<a class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="right" title="complete purchase" href="{{route('bowner.purchase.complete', $purchase->id)}}"><span class="glyphicon glyphicon-ok"></span></a>
						@else
							<!-- Undo button -->
							<!--
							<a class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="right" title="undo completing purchase" href="{{route('bowner.purchase.complete', $purchase->id)}}"><span class="glyphicon glyphicon-repeat"></span></a>
							-->
						@endif
							</div>
						</td>
						<td>{{$purchase->material->name}}</td>
						<td>{{$purchase->material->cost}}</td>
						<td>{{$purchase->material->unit->name}}</td>
						<td>{{$purchase->quantity}}</td>
						<td>{{$purchase->supplier->name}}</td>
						<td>{{number_format($purchase->quantity * $purchase->material->cost,2,'.','')}}</td>
						@if ($purchase->status == 1)
							<td class="success">Completed <span class="glyphicon glyphicon-ok text-success"></span></td>
						@else 
							<td>Pending</td>
						@endif	
						<td>{{date("d-m-Y", strtotime($purchase->updated_at))}}</td>
					  </tr>
					@endforeach
			    </tbody>
		  	</table>
	  	</div><!-- /.table-responsive -->
	</div><!-- /.row -->
	<!-- / View Purchasing Material -->
		
	<!-- Pagination -->
  	<div class="row">
  		<div class="text-center">
  			{{ $purchases->render() }}
  		</div>
  	</div>
	
	<!-- Purchase button -->
	<div class="container">
	  	<a class="btn btn-info" href="{{route('bowner.purchase.create')}}">Purchase Material</a>
	</div>

@stop
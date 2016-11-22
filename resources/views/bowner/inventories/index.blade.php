@extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>Inventories</h1>
	<!-- Start .nav nav-tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presenstation" class="active"><a href="#product" aria-controls="product" role="tab" data-toggle="tab"><strong>Products</strong></a></li>
		<li role="presenstation"><a href="#material" aria-controls="material" role="tab" data-toggle="tab"><strong>Material</strong></a></li>
	</ul>
	<!-- End .nav nav-tabs -->

	<div class="tab-content">
		<!-- View Products -->
		<div role="tabpanel1" class="tab-pane fade in active" id="product">
			<br>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
				    <thead>
				      <tr>
				        <th>Id</th>
				        <th>Actions</th>
				        <th>Product</th>
				        <th>Cost</th>
				        <th>UOM</th>
				        <th>Available Qty</th>
				        <th>Extra Qty (precision)</th>
				        <th>VAT (%)</th>
				        <th>Date</th>
				      </tr>
				    </thead>
				    <tbody>
						@foreach($products as $product)
						  <tr>
							<td>{{$product->id}}</td>
							<td><a class="btn btn-xs btn-primary" href="{{route('bowner.inventories.product.edit', $product->id)}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
							<td>{{$product->name}}</td>
							<td>{{$product->cost}}</td>
							<td>{{$product->unit->name}}</td>
							<td>{{$product->quantity}}</td>
							<td>{{$product->extra}}</td>
							<td>{{$product->vat_rate}}</td>
							<td>{{date("d-m-Y", strtotime($product->updated_at))}}</td>
						  </tr>
						@endforeach
				    </tbody>
			  	</table>
		  	</div><!-- /.table-responsive -->
		</div><!-- /.tab-pane -->
		<!-- / View Product -->

		<!-- View Material -->
		<div role="tabpanel2" class="tab-pane fade" id="material">
			<br>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
				    <thead>
				      <tr>
				        <th>Id</th>
				        <th>Actions</th>
				        <th>Product</th>
				        <th>Cost</th>
				        <th>UOM</th>
				        <th>Available Qty</th>
				        <th>VAT (%)</th>
				        <th>Date</th>
				      </tr>
				    </thead>
				    <tbody>
						@foreach($materials as $material)
						  <tr>
							<td>{{$material->id}}</td>
							<td><a class="btn btn-xs btn-primary" href="{{route('bowner.inventories.material.edit', $material->id)}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
							<td>{{$material->name}}</td>
							<td>{{$material->cost}}</td>
							<td>{{$material->unit->name}}</td>
							<td>{{$material->quantity}}</td>
							<td>{{$material->vat_rate}}</td>
							<td>{{date("d-m-Y", strtotime($material->updated_at))}}</td>
						  </tr>
						@endforeach
				    </tbody>
			  	</table>
		  	</div><!-- /.table-responsive -->
			
			<!-- Purchase button -->
		  	<div class="container">
			  	<a class="btn btn-info" href="{{route('bowner.purchase.create')}}">Purchase Material</a>
		  	</div>
		</div><!-- /.tab-pane -->
		<!-- / View Material -->
	</div>
	<!-- /.tab-content -->

@stop

@section('scripts')
<script>
</script>
@stop


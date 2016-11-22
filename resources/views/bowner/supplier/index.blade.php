@extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>Suppliers</h1>
	<div class="table-responsive">
		<table class="table table-hover table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Name</th>
	        <th>Address</th>
	        <th>Phone</th>
	        <th>Description</th>
	      </tr>
	    </thead>
	    <tbody>
		
		@if($suppliers)
			@foreach($suppliers as $supplier)
			  <tr>
				<td>{{$supplier->id}}</td>
				<td><a href="{{route('bowner.supplier.edit', $supplier->id)}}">{{$supplier->name}}</td>
				<td>{{$supplier->address1 .','. $supplier->address2}}</td>
				<td>{{$supplier->phone}}</td>
				<td>{{$supplier->description}}</td>
			  </tr>
			@endforeach
		@endif  
		
	    </tbody>
	  	</table>
  </div>
	
@stop

@section('scripts')
<script>
</script>
@stop


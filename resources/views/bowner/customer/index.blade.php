@extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>Customers</h1>
	<div class="table-responsive">
		<table class="table table-hover table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Name</th>
	        <th>Address</th>
	        <th>Phone</th>
	        <th>Tax Code</th>
	      </tr>
	    </thead>
	    <tbody>
		
		@if($customers)
			@foreach($customers as $customer)
			  <tr>
				<td>{{$customer->id}}</td>
				<td><a href="{{route('bowner.customer.edit', $customer->id)}}">{{$customer->name}}</td>
				<td>{{$customer->address1 .','. $customer->address2}}</td>
				<td>{{$customer->phone}}</td>
				<td>{{$customer->tax_num}}</td>
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


@extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>Leaves</h1>
	<!-- Start .nav nav-tabs -->
		<div class="table-responsive">
		<table class="table table-responsive table-bordered table-striped">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Name</th>
		        <th>Total Paid Leaves</th>
		        <th>Remaining Paid Leaves</th>
		        <th>Date</th>
		      </tr>
		    </thead>
		    <tbody>
			@if($leaves)
				@foreach($leaves as $leave)
				  <tr>
					<td>{{$leave->id}}</td>
					<td><a href="{{route('bowner.leaves.edit', $leave->id)}}">{{$leave->human->name}}</a></td>
					<td>{{$leave->annual_leave}}</td>
					<td>{{$leave->avai_annual_leave}}</td>
					<td>{{date("m-Y")}}</td>
				  </tr>
				@endforeach
			@endif  
		    </tbody>
	  	</table>
	  	</div>
	  	<!-- End .table-responsive -->

@stop

@section('scripts')
<script>
</script>
@stop


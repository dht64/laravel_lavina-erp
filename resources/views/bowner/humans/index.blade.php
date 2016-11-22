@extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>Employees</h1>
	<div class="table-responsive">
		<table class="table table-hover table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Name</th>
	        <th>Job Title</th>
	        <th>Start Day</th>
	        <th>Date of Birth</th>
	        <th>Gender</th>
	        <th>Address</th>
	        <th>Phone</th>
	        <th>ID#</th>
	      </tr>
	    </thead>
	    <tbody>
		
		@if($humans)
			@foreach($humans as $human)
			  <tr>
				<td>{{$human->id}}</td>
				<td><a href="{{route('bowner.humans.edit', $human->id)}}">{{$human->name}}</td>
				<td>{{$human->job}}</td>
				<td>{{date("d-m-Y", strtotime($human->start_day))}}</td>
				<td>{{date("d-m-Y", strtotime($human->birth))}}</td>
				<td>{{$human->gender}}</td>
				<td>{{$human->address1 .','. $human->address2}}</td>
				<td>{{$human->phone}}</td>
				<td>{{$human->idnum}}</td>
			  </tr>
			@endforeach
		@endif  
		
	    </tbody>
	  	</table>
	</div>
	<a class="btn btn-info" href="{{ url('/bowner/humans/create') }}">Add Employee</a>
	
@stop

@section('scripts')
<script>
</script>
@stop


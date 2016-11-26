@extends('layouts.bowner')

@section('content')

	@include('includes.message')

	<h1>Salary</h1>
	<!-- Start .nav nav-tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presenstation" class="active"><a href="#view" aria-controls="view" role="tab" data-toggle="tab"><strong>View Salary</strong></a></li>
		<li role="presenstation"><a href="#create" aria-controls="create" role="tab" data-toggle="tab"><strong>Create Salary</strong></a></li>
	</ul>
	<!-- End .nav nav-tabs -->

	<div class="tab-content">
		<!-- Show Salary -->
		<div role="tabpanel1" class="tab-pane fade in active" id="view">
			<!-- Submit month for showing -->
			{!! Form::open(['method'=>'POST', 'action'=>'BownerSalariesController@index', 'class'=>'form-inline']) !!}

				<div class="form-group">
					{!! Form::label('month', 'Month:') !!}
					{!! Form::selectMonth('month', $chosenMn, ['class'=>'form-control']) !!}
				</div>	

				<div class="form-group">
					{!! Form::label('year', 'Year:') !!}
					{!! Form::selectYear('year', $thisYr-2, $thisYr, $chosenYr, ['class'=>'form-control']) !!}
				</div>	

				<div class="form-group">
					{!! Form::submit('Submit Date', ['class'=>'btn btn-primary', 'style'=>'margin-left:15px']) !!}
				</div>

			{!! Form::close() !!}

			<hr>
			<div class="table-responsive">
			<table class="table table-responsive table-bordered table-striped">
			    <thead>
			      <tr>
			        <th>Id</th>
			        <th>Name</th>
			        <th>Basic Salary ($)</th>
			        <th>Paid Leaves</th>
			        <th>Un-paid Leaves</th>
			        <th>Changes ($)</th>
			        <th>Date</th>
			        <th>Final Payment ($)</th>
			      </tr>
			    </thead>
			    <tbody>
				@if ($salaries)
					@foreach ($salaries as $salary)
					  <tr>
						<td>{{ $salary->id }}</td>
						<td><a href="{{ route('bowner.salaries.edit', $salary->id) }}">{{ $salary->human->name }}</a></td>
						<td>{{ $salary->basic_salary }}</td>
						<td>{{ $salary->nondeduct_leave }}</td>
						<td>{{ $salary->deduct_leave }}</td>
						<td>{{ $salary->change }}</td>
						<td>{{ date("m-Y", strtotime($salary->dates)) }}</td>
						<td>{{ $salary->total }}</td>
					  </tr>
					@endforeach
				@endif  
					<tr>
						<td colspan="5"></td>
						<td colspan="2" class="success text"><b>Total Salary: </b></td>
						<td class="success"><b>{{ $total }}</b></td>
					</tr>
			    </tbody>
		  	</table>
		  	</div>
		  	<!-- End .table-responsive -->
		</div>
		<!-- End .tab-pane -->
		<!-- End Show Salary -->

		<!-- Create Salary -->
		<div role="tabpanel2" class="tab-pane fade" id="create">
			{!! Form::open(['method'=>'POST', 'action'=>'BownerSalariesController@store', 'class'=>'form-inline']) !!}

				<div class="form-group">
					{!! Form::label('dates', 'Date:') !!}
					{!! Form::select('dates', [date("Y-m-d", strtotime("first day of previous month"))=>date("M-Y", strtotime("first day of previous month")), $dates=>date("M-Y", strtotime($dates)), date("Y-m-d", strtotime("first day of next month"))=>date("M-Y", strtotime("first day of next month"))], $dates, ['class'=>'form-control']) !!}
				</div>	

				<div class="form-group">
					{!! Form::submit('Create Salary', ['class'=>'btn btn-primary']) !!}
				</div>

			{!! Form::close() !!}
		</div>
		<!-- End .tab-pane -->
		<!-- End Create Salary -->

	</div>
	<!-- End .tab-content -->

@stop

@section('scripts')
<script>
</script>
@stop


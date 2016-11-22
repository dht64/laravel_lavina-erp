@extends('layouts.bowner')

@section('content')

	@if(Session::has('exceed_leaves'))
		<div class="alert alert-danger fade" style="margin-top:10px;font-size:14px">			
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{session('exceed_leaves')}}
		</div>
	@endif

	<h1>Edit Salary</h1>
	
	<div class="row">
		<div class="col-sm-3">
			<img src="{{ URL::asset($salary->human->photo ? 'images/'.$salary->human->photo : '/images/human.png') }}" alt="Employee Photo" class="img-responsive img-rounded">
		</div>
		
		<div class="col-sm-9">
			{!! Form::model($salary, ['method'=>'PATCH', 'action'=>['BownerSalariesController@update', $salary->id], 'class'=>'form-horizontal']) !!}

			<input type="hidden" name="dates" value="{{$salary->dates}}">
			<input type="hidden" name="annual_leave_input" value="{{ ($salary->nondeduct_leave != '') ? count(explode(',', $salary->nondeduct_leave)) : 0 }}">

			<div class="form-group">
				{!! Form::label('basic_salary', 'Basic Salary ($):', ['class'=>'control-label col-sm-3']) !!}
				<div class="col-sm-9">
				{!! Form::text('basic_salary', null, ['class'=>'form-control']) !!}
				</div>
			</div>
			
			<div class="form-group has-feedback">
				{!! Form::label('nondeduct_leave', 'Paid Leaves:', ['class'=>'control-label col-sm-3']) !!}
				
				<div class="col-sm-9">
				{!! Form::text('nondeduct_leave', null, ['class'=>'form-control']) !!}
				<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
				</div>
			</div>

			<div class="form-group has-feedback">
				{!! Form::label('avai_annual_leave', '(Available Paid Leaves):', ['class'=>'control-label col-sm-3']) !!}
				
				<div class="col-sm-9">
				{!! Form::text('avai_annual_leave', $leave->avai_annual_leave, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
				</div>
			</div>

			<div class="form-group has-feedback">
				{!! Form::label('deduct_leave', 'Un-paid Leaves:', ['class'=>'control-label col-sm-3']) !!}

				<div class="col-sm-9">
				{!! Form::text('deduct_leave', null, ['class'=>'form-control']) !!}
				<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
				</div>
			</div>
			
			<div class="form-group">
				{!! Form::label('change', 'Change ($):', ['class'=>'control-label col-sm-3']) !!}
				<div class="col-sm-9">
				{!! Form::number('change', null, ['class'=>'form-control']) !!}
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('total', 'Total ($):', ['class'=>'control-label col-sm-3']) !!}

				<div class="col-sm-9">
				{!! Form::text('total', null, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-3">
				{!! Form::submit('Save', ['class'=>'btn btn-primary', 'style'=>'width:100%']) !!}
				</div>
			</div>
			<!--
			<div class="form-group">
				<input class="btn btn-danger" type="submit" value="Delete Salary" action="{{route('bowner.salaries.destroy', $salary->id)}}">
			</div>
			-->

			{!! Form::close() !!}

			{!! Form::open(['method'=>'DELETE', 'action'=>['BownerSalariesController@destroy', $salary->id]]) !!}
				<div class="form-group" style="margin-top:-60px;">
					{!! Form::submit('Delete',['class'=>'btn btn-danger col-sm-3']) !!}
				</div>
			{!! Form::close() !!}
			
		</div>
	</div>
	<div class="row">
		@include('includes.form_error')
	</div>	
@stop

@section('scripts')
	<script type="text/javascript">
	var date = new Date();
	$(function() {
		$('input[id="nondeduct_leave"]').multiDatesPicker({
			dateFormat: 'dd-mm-yy',
			maxPicks: 3,
		}).keypress(function(){
			return false;
		});
		$('input[id="deduct_leave"]').multiDatesPicker({
			dateFormat: 'dd-mm-yy',
		}).keypress(function(){
			return false;
		});
	});
	</script>
@stop

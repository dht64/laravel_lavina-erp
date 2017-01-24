@extends('layouts.bowner')

@section('content')

	<h1>Edit Material</h1>

	{!! Form::model($material, ['method'=>'PATCH', 'route'=>['bowner.inventories.material.update', $material->id], 'class'=>'form-group']) !!}

	<div class="form-group col-sm-6">
		{!! Form::label('name', 'Material:') !!}
		{!! Form::text('name', null, ['class'=>'form-control', 'disabled']) !!}
	</div>	

	<div class="form-group col-sm-6">
		{!! Form::label('quantity', 'Available Quantity (*):') !!}
		{!! Form::number('quantity', null, ['class'=>'form-control', 'min'=>0, 'required']) !!}
	</div>

	<div class="form-group col-sm-6">
		{!! Form::submit('Save', ['class'=>'btn btn-primary col-sm-3']) !!}
		<a class="btn btn-warning col-sm-3" href="{{URL('/bowner/inventories')}}">Cancel</a>
	</div>

	{!! Form::close() !!}

@stop
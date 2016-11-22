@extends('layouts.admin')

@section('content')
	<h1>Create User</h1>
	
	{!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true]) !!}
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('name', 'Name (*):') !!}
			{!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
		</div>

		<div class="form-group col-sm-6">
			{!! Form::label('username', 'Username (*):') !!}
			{!! Form::text('username', null, ['class'=>'form-control', 'required']) !!}
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('password', 'Password (*):') !!}
			{!! Form::password('password', ['class'=>'form-control', 'required']) !!}
		</div>
		
		<div class="form-group col-sm-6">
			{!! Form::label('email', 'Email (*):') !!}
			{!! Form::email('email', null, ['class'=>'form-control', 'required']) !!}
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('role_id', 'Role (*):') !!}
			{!! Form::select('role_id', [''=>'Choose Options'] + $roles, null, ['class'=>'form-control', 'required']) !!}
		</div>
		
		<div class="form-group col-sm-6">
			{!! Form::label('is_active', 'Status (*):') !!}
			{!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), 1, ['class'=>'form-control']) !!}
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-sm-6">
			{!! Form::label('photo_id', 'Photo:') !!}
			{!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-sm-3" style="margin-top: 10px;">
			{!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
		</div>
	</div>
	

	{!! Form::close() !!}	
	
	@include('includes.form_error')
	
@stop
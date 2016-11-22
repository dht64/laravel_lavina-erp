@extends('layouts.admin')

@section('content')

	@include('includes.message')

	<h1>User</h1>
	<div class="container">
	<table class="table table-bordered table-striped">
		<thead>
		  <tr>
			<th>Id</th>
			<th>Photo</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
			<th>Status</th>
			<th>Created</th>
			<th>Updated</th>
		  </tr>
		</thead>
		
		<tbody>
		@if($users)
			@foreach($users as $user)
			  <tr>
				<td>{{$user->id}}</td>
				<td><img height="50px" src="{{URL::asset($user->photo ? $user->photo->file : '/images/user.png')}}" alt="User photo"></td>
				<td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->role->name}}</td>
				<td>{{$user->is_active == 1 ? 'Active' : 'No Active' }}</td>
				<td>{{$user->created_at->diffForHumans()}}</td>
				<td>{{$user->updated_at->diffForHumans()}}</td>
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


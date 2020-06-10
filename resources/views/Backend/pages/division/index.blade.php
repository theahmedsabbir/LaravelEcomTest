@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Manage Divisions</div>
			<div class="card-body">
				<!-- displaying messages here -->
				@include('Backend.partials.messages')
				
				<table class="table table-hover ">
				  <thead class="thead-light">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Name</th>
				      <th scope="col">Priority</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@php $i = 0; @endphp

				  	@foreach ($divisions as $division)
				  		@php $i++; @endphp				  		
					    <tr>
					      <th scope="row">{{ $i }}</th>
					      <td>{{ $division->name }}</td>
					      <td>{{$division->priority}}</td>
					      <td>
					      	<a href="{{ route('admin.division.edit', $division->id ) }}" class="btn btn-success">Edit</a>
					      	<a href="{{ route('admin.division.delete', $division->id ) }}" class="btn btn-danger"  data-toggle="modal" data-target="#deleteProduct{{ $division->id }}">Delete</a>
					      </td>
					  </tr>

					  <!-- Modal Confirmation to delete start-->

					  <!-- Modal -->
					  <div class="modal fade" id="deleteProduct{{ $division->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  	<div class="modal-dialog modal-dialog-centered" role="document">
					  		<div class="modal-content">
					  			<div class="modal-header">
					  				<h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
					  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  					<span aria-hidden="true">&times;</span>
					  				</button>
					  			</div>
					  			<div class="modal-body">
					  				Are you sure you want to delete this division??
					  			</div>
					  			<div class="modal-footer">
					  				<button type="button" class="btn btn-success" data-dismiss="modal">No</button>
					  				<form action="{{ route('admin.division.delete', $division->id) }}" method="POST" class="form-inline">
					  					@csrf
					  					<input type="submit" class="btn btn-danger" value="Yes">
					  				</form>
					  			</div>
					  		</div>
					  	</div>
					  </div>	
					  <!-- Modal Confirmation to delete end-->

				  	@endforeach

				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection



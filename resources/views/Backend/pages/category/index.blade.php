@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Manage Categories</div>
			<div class="card-body">
				<!-- displaying messages here -->
				@include('Backend.partials.messages')
				
				<table class="table table-hover ">
				  <thead class="thead-light">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Name</th>
				      <th scope="col">Image</th>
				      <th scope="col">Parent Category</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@php $i = 0; @endphp

				  	@foreach ($categories as $category)
				  		@php $i++; @endphp				  		
					    <tr>
					      <th scope="row">{{ $i }}</th>
					      <td>{{ $category->name }}</td>
					      <td>
					      	<img src="{{ asset('images/categories/'.$category->image ) }}" alt="" class="img-fluid">
					      </td>
					      <td>
								@if ( $category->parent == null)
									{{ "Primary" }}
								@else
									{{ $category->parent->name }}
								@endif
					      </td>
					      <td>
					      	<a href="{{ route('admin.category.edit', $category->id ) }}" class="btn btn-success">Edit</a>
					      	<a href="{{ route('admin.category.delete', $category->id ) }}" class="btn btn-danger"  data-toggle="modal" data-target="#deleteProduct{{ $category->id }}">Delete</a>
					      </td>
					  </tr>

					  <!-- Modal Confirmation to delete start-->

					  <!-- Modal -->
					  <div class="modal fade" id="deleteProduct{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  	<div class="modal-dialog modal-dialog-centered" role="document">
					  		<div class="modal-content">
					  			<div class="modal-header">
					  				<h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
					  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  					<span aria-hidden="true">&times;</span>
					  				</button>
					  			</div>
					  			<div class="modal-body">
					  				Are you sure you want to delete this category??
					  			</div>
					  			<div class="modal-footer">
					  				<button type="button" class="btn btn-success" data-dismiss="modal">No</button>
					  				<form action="{{ route('admin.category.delete', $category->id) }}" method="POST" class="form-inline">
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



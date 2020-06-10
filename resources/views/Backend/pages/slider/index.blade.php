@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Manage Sliders 
				<a href="#" class="btn btn-primary btn-flat float-right"   data-toggle="modal" data-target="#addSlider">Add Slider</a>				
			</div>
			<div class="card-body">
				<!-- displaying messages here -->
				@include('Backend.partials.messages')
				
				<table class="table table-hover ">
				  <thead class="thead-light">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Title</th>
				      <th scope="col">Image</th>
				      <th scope="col">Priority</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@php $i = 0; @endphp

				  	@foreach ($sliders as $slider)
				  		@php $i++; @endphp				  		
					    <tr>
					      <th scope="row">{{ $i }}</th>
					      <td>{{ $slider->title }}</td>
					      <td>
					      	<img src="{{ asset('images/sliders/'.$slider->image) }}" alt="{{$slider->title}}" width="40">
					      </td>
					      <td>{{$slider->priority}}</td>
					      <td>
					      	<a href="#" class="btn btn-success"  data-toggle="modal" data-target="#editSlider{{ $slider->id }}">Edit</a>
					      	<a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#deleteSlider{{ $slider->id }}">Delete</a>
					      </td>
					  </tr>

					  <!-- Modal edit start-->

					  <!-- Modal -->
					  <div class="modal fade" id="editSlider{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  	<div class="modal-dialog modal-dialog-centered" role="document">
					  		<div class="modal-content">
					  			<div class="modal-header">
					  				<h5 class="modal-title" id="exampleModalLongTitle">Edit Slider</h5>
					  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  					<span aria-hidden="true">&times;</span>
					  				</button>
					  			</div>
					  			<div class="modal-body">
					  				<form action="{{ route('admin.slider.update', $slider->id ) }}" method="POST" enctype="multipart/form-data">
					  					@csrf

					  					<div class="form-group">
					  						<label for="title">Title <sup class="text-danger">Required</sup></label>
					  						<input type="text" name="title" class="form-control" value="{{ $slider->title }}" required>
					  					</div>

					  					<div class="form-group">
					  						<label for="image">Image
												<a href="{{ asset('images/sliders/'.$slider->image) }}" target="_blank" class="text-info">Current Image</a>
					  						</label>
					  						
					  						<input type="file" name="image" class="form-control pt-1">
					  					</div>

					  					<div class="form-group">
					  						<label for="button_text">Slider Button Text</label>
					  						<input type="text" name="button_text" class="form-control" value="{{ $slider->button_text }}">
					  					</div>

					  					<div class="form-group">
					  						<label for="button_link">Slider Button Link</label>
					  						<input type="url" name="button_link" class="form-control" value="{{ $slider->button_link }}">
					  					</div>

					  					<div class="form-group">
					  						<label for="priority">Slider Priority <sup class="text-danger">Required</sup></label>
					  						<input type="number" name="priority" class="form-control" required value="{{ $slider->priority }}">
					  					</div>

					  					<div class="form-group">
					  						<button type="submit" class="btn btn-success">Update Slider</button>

					  						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					  					</div>
					  				</form>
					  			</div>
					  		</div>
					  	</div>
					  </div>	

					  <!-- Modal edit end-->

					  <!-- Modal Confirmation to delete start-->

					  <!-- Modal -->
					  <div class="modal fade" id="deleteSlider{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  	<div class="modal-dialog modal-dialog-centered" role="document">
					  		<div class="modal-content">
					  			<div class="modal-header">
					  				<h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
					  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  					<span aria-hidden="true">&times;</span>
					  				</button>
					  			</div>
					  			<div class="modal-body">
					  				Are you sure you want to delete this slider??
					  			</div>
					  			<div class="modal-footer">
					  				<button type="button" class="btn btn-success" data-dismiss="modal">No</button>
					  				<form action="{{ route('admin.slider.delete', $slider->id) }}" method="POST" class="form-inline">
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



<!-- Modal Add SLider start-->

<!-- Modal -->
<div class="modal fade" id="addSlider" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content bg-light">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add Slider</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					
					<div class="form-group">
						<label for="title">Title <sup class="text-danger">Required</sup></label>
						<input type="text" name="title" class="form-control" required>
					</div>
					
					<div class="form-group">
						<label for="image">Image <sup class="text-danger">Required</sup></label>
						<input type="file" name="image" class="form-control pt-1" required>
					</div>
					
					<div class="form-group">
						<label for="button_text">Slider Button Text</label>
						<input type="text" name="button_text" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="button_link">Slider Button Link</label>
						<input type="url" name="button_link" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="priority">Slider Priority <sup class="text-danger">Required</sup></label>
						<input type="number" name="priority" class="form-control" required>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-success">Add New Slider</button>

						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>	
<!-- Modal Add SLider end-->
@endsection



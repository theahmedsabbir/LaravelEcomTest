@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Update Brand</div>
			<div class="card-body">

				<!-- displaying error here -->
				@include('Backend.partials.messages')
				<form action="{{ route('admin.brand.update', $c_brand->id ) }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" value="{{ $c_brand->name }}">
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" rows="5" class="form-control">{{ $c_brand->description }}</textarea>
					</div>

					<div class="form-group">
						<label for="image" class="mb-4">Brand Image</label><br>

						<img src="{{ asset('Images/categories/'.$c_brand->image ) }}" width="90" alt=""><br>
						<input type="file" name="image" class="form-control mt-2" style="padding: 5px 0; border:none;"><br>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Save Changes">
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection



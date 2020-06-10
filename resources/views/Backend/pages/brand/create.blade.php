@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Add Brand</div>
			<div class="card-body">

				<!-- displaying error here -->
				@include('Backend.partials.messages')
				<form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control">
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" rows="5" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<label for="image">Brand Image</label><br>
						<input type="file" name="image"><br>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Add Brand">
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection



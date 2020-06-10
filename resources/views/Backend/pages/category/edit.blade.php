@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Update Category</div>
			<div class="card-body">

				<!-- displaying error here -->
				@include('Backend.partials.messages')
				<form action="{{ route('admin.category.update', $c_category->id ) }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" value="{{ $c_category->name }}">
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" rows="5" class="form-control">{{ $c_category->description }}</textarea>
					</div>

					<div class="form-group">
						<label for="image" class="mb-4">Category Image</label><br>

						<img src="{{ asset('Images/categories/'.$c_category->image ) }}" width="90" alt=""><br>
						<input type="file" name="image" class="form-control mt-2" style="padding: 5px 0; border:none;"><br>
					</div>

					<div class="form-group">
						<label for="parent_id">Select Parent</label>
						<select name="parent_id" class="form-control">
							<option value="">Primary</option>
							@foreach ($parent_categories as $p_category)
								<option value="{{ $p_category->id }}" 

								@if ( !is_null( $c_category->parent) )
									@if ( $c_category->parent->id == $p_category->id )
										{{ "selected" }}
									@endif
								@endif

								>{{ $p_category->name }}</option>
							@endforeach
						</select>
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



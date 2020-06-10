@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Update Dvision</div>
			<div class="card-body">

				<!-- displaying error here -->
				@include('Backend.partials.messages')
				<form action="{{ route('admin.division.update', $c_division->id ) }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" value="{{ $c_division->name }}">
					</div>

					<div class="form-group">
						<label for="priority">Priority</label>
						<input type="text" name="priority" class="form-control" value="{{ $c_division->priority }}">
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



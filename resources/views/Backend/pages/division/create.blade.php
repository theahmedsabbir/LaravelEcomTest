@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Add Division</div>
			<div class="card-body">

				<!-- displaying error here -->
				@include('Backend.partials.messages')
				<form action="{{ route('admin.division.store') }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control">
					</div>

					<div class="form-group">
						<label for="priority">Priority</label>
						<input type="text" name="priority" class="form-control">
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Add Division">
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection



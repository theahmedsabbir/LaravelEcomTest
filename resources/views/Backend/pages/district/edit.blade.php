@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Update District</div>
			<div class="card-body">

				<!-- displaying error here -->
				@include('Backend.partials.messages')
				<form action="{{ route('admin.district.update', $c_district->id ) }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" value="{{$c_district->name}}">
					</div>
					
					<div class="form-group">
						<label for="division_id">Select Division</label>
						<select name="division_id" id="" class="form-control">
							@foreach ($divisions as $division)
								<option value="{{$division->id}}" {{$division->id == $c_district->division_id ? 'selected' : ''}}>{{$division->name}}</option>
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



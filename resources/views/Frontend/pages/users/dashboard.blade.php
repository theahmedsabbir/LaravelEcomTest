@extends('Frontend.pages.users.master')

@section('sub-content')
	<!--sub content section start -->
	<h2>Welcome {{$user->first_name." ".$user->last_name}}</h2>
	<p class="mt-3">You can change your profile information from here</p>
	<hr class="mt-1 mb-4">
	<div class="row">
		<div class="col-md-4">
			<div class="card mb-4">
				<div class="card-body" onclick="location.href='{{ route('user.edit') }}'">
					<h6 style="cursor: pointer" href="">Update Profile</h6>
				</div>
			</div>
		</div>
	</div>
	<!--sub content section end -->
@endsection
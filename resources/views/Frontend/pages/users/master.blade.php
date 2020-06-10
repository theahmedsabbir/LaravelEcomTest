@extends('Frontend.layouts.app2')

@section('content')
	<div class="container my-5">
		<div class="row">
			<div class="col-md-4">
				<a href="" class="list-group-item">
					<img src="{{App\Helpers\ImageHelper::getUserImage(Auth::user()->id)}}" class="img rounded-circle" width="100px">
				</a>
				<a href="" class="list-group-item {{Route::is('user.dashboard')?'active':''}}">Dashboard</a>
				<a href="" class="list-group-item {{Route::is('user.edit')?'active':''}}">Update Profile</a>
				{{-- <a href="" class="list-group-item {{Route::is('user.dashboard')?'active':''}}">Logout</a> --}}
			</div>
			<div class="col-md-8">
				@yield('sub-content')
			</div>
		</div>
	</div>
@endsection
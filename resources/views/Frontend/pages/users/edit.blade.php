@extends('Frontend.pages.users.master')

@section('sub-content')
<!-- custom styling for this page -->
<style>
	footer{
		position: unset !important;
	}
	label.col-md-4.col-form-label.text-md-right {
		text-align: left !important;
	}
</style>
<!-- custom styling for this page -->

<!--sub content section start -->
<h2>Update Profile</h2>
<hr class="mt-3 mb-4">



<div class="card-body text-left">


    <!--displaying messages start -->
    @include('Frontend.partials.messages')
    <!--displaying messages start -->
	<form method="POST" action="{{ route('user.update') }}">
		@csrf

		<div class="form-group row">
			<label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

			<div class="col-md-6">
				<input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}"  autocomplete="first_name" autofocus>

				@error('first_name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>

		<div class="form-group row">
			<label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

			<div class="col-md-6">
				<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}"  autocomplete="last_name" autofocus>

				@error('last_name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>

		<div class="form-group row">
			<label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

			<div class="col-md-6">
				<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}"  autocomplete="username" autofocus>

				@error('username')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>

		<div class="form-group row">
			<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

			<div class="col-md-6">
				<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="email">

				@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>

		<div class="form-group row">
			<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

			<div class="col-md-6">
				<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

				@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>



		<div class="form-group row">
			<label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

			<div class="col-md-6">
				<input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}"  autocomplete="phone" autofocus>

				@error('phone')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>


		<div class="form-group row">
			<label for="division_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Division') }}</label>

			<div class="col-md-6">
				<select name="division_id" id="" class="form-control">
					@foreach ($divisions as $division)
					<option value="{{$division->id}}" {{ $division->id == $user->division_id ? 'selected': '' }}>{{$division->name}}</option>
					@endforeach
				</select>

				@error('division_id')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>


		<div class="form-group row">
			<label for="district_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Districts') }}</label>

			<div class="col-md-6">
				<select name="district_id" id="" class="form-control">
					@foreach ($districts as $district)
					<option value="{{$district->id}}" {{ $district->id == $user->district_id ? 'selected': '' }}>{{$district->name}}</option>
					@endforeach
				</select>

				@error('district_id')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>



		<div class="form-group row">
			<label for="street_address" class="col-md-4 col-form-label text-md-right">{{ __('Street Address') }}</label>

			<div class="col-md-6">
				<input id="street_address" type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{ $user->street_address }}"  autocomplete="street_address" autofocus>

				@error('street_address')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>



		<div class="form-group row">
			<label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Address') }}</label>

			<div class="col-md-6">
				<textarea rows="5" id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" autocomplete="shipping_address" autofocus>{{ $user->shipping_address }}</textarea>

				@error('shipping_address')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>



		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<button type="submit" class="btn btn-primary">
					{{ __('Update') }}
				</button>
			</div>
		</div>
	</form>
</div>
<!--sub content section end -->
@endsection




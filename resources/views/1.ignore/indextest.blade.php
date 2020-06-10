@extends('layouts.app2')


@section('content')	

	<!-- main content starts -->

	<div class="container margin-top-20">
	<div class="row">
	  <div class="col-md-4">
		<!-- sidebar starts -->
		@include('partials.sidebar')
		<!-- sidebar ends -->
	  </div>
	  <div class="col-md-8">
		<!-- widget Starts-->
		<div class="widget">
			<h3 class="mb-3">Featured Products</h3>
			<div class="row">
				<div class="col-md-3 mb-4">
					<div class="card text-center">
					  <img class="card-img-top img-fluid feature-img" src="{{ asset('images/products/m8.jpg')}}". alt="Card image">
					  <div class="card-body">
					    <h4 class="card-title">Mi 8</h4>
					    <p class="card-text">TK - 15000</p>
					    <a href="#" class="btn btn-outline-warning">Add to Cart</a>
					  </div>
					</div>
				</div>
				<div class="col-md-3 mb-4">
					<div class="card text-center">
					  <img class="card-img-top img-fluid feature-img" src="{{ asset('images/products/m8.jpg')}}". alt="Card image">
					  <div class="card-body">
					    <h4 class="card-title">Mi 8</h4>
					    <p class="card-text">TK - 15000</p>
					    <a href="#" class="btn btn-outline-warning">Add to Cart</a>
					  </div>
					</div>
				</div>
				<div class="col-md-3 mb-4">
					<div class="card text-center">
					  <img class="card-img-top img-fluid feature-img" src="{{ asset('images/products/m8.jpg')}}". alt="Card image">
					  <div class="card-body">
					    <h4 class="card-title">Mi 8</h4>
					    <p class="card-text">TK - 15000</p>
					    <a href="#" class="btn btn-outline-warning">Add to Cart</a>
					  </div>
					</div>
				</div>
				<div class="col-md-3 mb-4">
					<div class="card text-center">
					  <img class="card-img-top img-fluid feature-img" src="{{ asset('images/products/m8.jpg')}}". alt="Card image">
					  <div class="card-body">
					    <h4 class="card-title">Mi 8</h4>
					    <p class="card-text">TK - 15000</p>
					    <a href="#" class="btn btn-outline-warning">Add to Cart</a>
					  </div>
					</div>
				</div>
				<div class="col-md-3 mb-4">
					<div class="card text-center">
					  <img class="card-img-top img-fluid feature-img" src="{{ asset('images/products/m8.jpg')}}". alt="Card image">
					  <div class="card-body">
					    <h4 class="card-title">Mi 8</h4>
					    <p class="card-text">TK - 15000</p>
					    <a href="#" class="btn btn-outline-warning">Add to Cart</a>
					  </div>
					</div>
				</div>
				<div class="col-md-3 mb-4">
					<div class="card text-center">
					  <img class="card-img-top img-fluid feature-img" src="{{ asset('images/products/m8.jpg')}}". alt="Card image">
					  <div class="card-body">
					    <h4 class="card-title">Mi 8</h4>
					    <p class="card-text">TK - 15000</p>
					    <a href="#" class="btn btn-outline-warning">Add to Cart</a>
					  </div>
					</div>
				</div>
			</div>
		</div>
		<!-- widget ends -->
	  </div>
	</div>
	</div>

	<!-- main content ends -->


@endsection
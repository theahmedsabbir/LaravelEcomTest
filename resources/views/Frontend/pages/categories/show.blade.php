@extends('Frontend.layouts.app2')


@section('content')	

<!-- main content starts -->

<div class="container margin-top-20">
	<div class="row">
		<div class="col-md-4">
			<!-- sidebar starts -->
			@include('Frontend.partials.sidebar')
			<!-- sidebar ends -->
		</div>
		<div class="col-md-8">
			<!-- widget Starts-->
			<div class="widget">
				<!--displaying messages start -->
				{{-- @include('Frontend.pages.products.partials.messages') --}}
				<!--displaying messages start -->

				<h3 class="mb-3">All Products in "{{$category->name}}"</h3>

				@php
					$products = $category->products()->paginate(3);
				@endphp

				<!-- Products start -->
				@if ( $products->count() > 0 )
					@include('Frontend.pages.products.partials.all-products')
				@else
					<div class="alert alert-danger">
						Sorry !! No product found in this category
					</div>
				@endif
				<!-- Products end -->	

			</div>
			<!-- widget ends -->
		</div>
	</div>
</div>

<!-- main content ends -->


@endsection
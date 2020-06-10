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
				@include('Frontend.pages.products.partials.messages')
				<!--displaying messages start -->

				<h3 class="mb-3">Products</h3>

				<!-- Products start -->
				@include('Frontend.pages.products.partials.all-products')
				<!-- Products end -->	

			</div>
			<!-- widget ends -->
		</div>
	</div>
</div>

<!-- main content ends -->


@endsection
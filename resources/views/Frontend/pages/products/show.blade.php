@extends('Frontend.layouts.app2')


@section('title')
	{{ $product->title }}
@endsection

@section('content')	

<!-- main content starts -->

<section class="content">
	<div class="container margin-top-20">
		<div class="row">
			<div class="col-md-4">
				<!-- product carousel starts -->
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						@php
						$i=1;
						@endphp

						@foreach ($product->images as $image)
						
						<div class="carousel-item {{ $i==1? 'active' : '' }}">
							<img class="d-block w-100" src="{{ asset('images/products/'.$image->image ) }}" alt="First slide">
						</div>

						@php
						$i--;
						@endphp

						@endforeach
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						{{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> --}}
						<i class="fa fa-arrow-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						{{-- <span class="carousel-control-next-icon" aria-hidden="true"></span> --}}
						<i class="fa fa-arrow-right" aria-hidden="true"></i>
						<span class="sr-only">Next</span>
					</a>
				</div>
				<!-- product carousel ends -->
			</div>
			<div class="col-md-8">
				<!-- widget Starts-->
				<div class="widget">
					<!--displaying messages start -->
					@include('Frontend.pages.products.partials.messages')
					<!--displaying messages start -->


					<!-- Products start -->
					<h3 class="mb-3">{{ $product->title }}
						<span class="badge badge-primary">
							{{ $product->quantity < 2 ? 'Out Of Stock' : $product->quantity.' items in stock' }}
						</span>
					</h3>
					<h5 class="mb-3">tk {{ $product->price }}</h5>
					<hr>

					<div class="badges">
						<div class="badge badge-info">{{$product->category->name}}</div>
						<div class="badge badge-warning">{{$product->brand->name}}</div>
					</div>
					<div class="product_description mt-5 mb-5">
						{!! $product->description !!}
					</div>

					<!-- Products end -->	

				</div>
				<!-- widget ends -->
			</div>
		</div>
	</div>
</section>

<!-- main content ends -->


@endsection
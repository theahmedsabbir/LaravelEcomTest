@extends('Frontend.layouts.app2')


@section('content')	

<style>
	.footer{
		position: unset !important;
	}
	.carousel-item{
		cursor: pointer;
	}
</style>

<!-- sidebar starts -->


<div class="container-fluid p-0">
	<div class="row m-0">
		<div class="col-md-12 p-0">
			<div class="slider">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						@foreach ($sliders as $slider)
							<li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->index == 0 ? 'active' : ''}}"></li>
						@endforeach
					</ol>
					<div class="carousel-inner">
						@foreach ($sliders as $slider)

						<div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}" onclick="window.open('{{$slider->button_link}}', '_blank')">
							<img class="d-block w-100" src="{{ asset('images/sliders/'.$slider->image) }}" alt="{{$slider->title}}" class="img-fluid">

					{{-- 		<div class="carousel-caption d-none d-md-block">
								<h5>{{$slider->title}}</h5>
								<a href="{{$slider->button_link}}" class="btn btn-primary">{{$slider->button_text}}</a>
							</div> --}}
						</div>

						@endforeach
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container margin-top-20">
	<div class="row">
		<div class="col-md-4">
			<!-- sidebar start -->
			@include('Frontend.partials.sidebar')
			<!-- sidebar end -->
		</div>
		<div class="col-md-8">
			<!-- widget Starts-->
			<div class="widget">				
				<!--displaying messages start -->
				@include('Frontend.pages.products.partials.messages')
				<!--displaying messages start -->
				
				<h3 class="mb-3">Featured Products</h3>

				<!-- Products start -->
				@include('Frontend.pages.products.partials.all-products')
				<!-- Products end -->	
				
			</div> <!-- widget ends -->
		</div>
	</div>
</div>

@endsection
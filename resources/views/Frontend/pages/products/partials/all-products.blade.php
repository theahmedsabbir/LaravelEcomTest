<div class="row">
	@foreach ($products as $product)
	<div class="col-md-4 mb-4">

		@php	$i=1;	@endphp

		<div class="card text-center pt-3 main_products">

			@if ( count( $product->images ) == 0 )
			<div class="feature-img-box">
				<a href="{{ route('products.show', $product->slug) }}">
					<img class="card-img-top img-fluid feature-img" src="{{ asset( 'images/products/default2.jpeg' ) }}". alt="Card image">
				</a>
			</div>

			@else
				@foreach ($product->images as $image)

					@if ($i>0)
						<div class="feature-img-box">
							<a href="{{ route( 'products.show', $product->slug ) }}">
								<img class="card-img-top img-fluid feature-img" src="{{ asset( 'images/products/'.$image->image ) }}". alt="Card image">
							</a>
						</div>
					@endif

					@php	$i--;	@endphp

				@endforeach
			@endif

			<div class="card-body mt-3">
				<h4 class="card-title products_h4">
					<a href="{{ route('products.show', $product->slug) }}">
						{{ $product->title }}
					</a>
				</h4>
				<p class="card-text">Tk. {{ $product->price }}</p>
				@include('Frontend.pages.products.partials.cart-button')
			</div>
		</div>
	</div>
	@endforeach

	<div class="pagination pl-3 mb-4">
		{!! $products->links() !!}
	</div>
</div>
@extends('Frontend.layouts.app2')

@section('content')
<!-- contact section start -->
<section class="contact-body margin-top-20 margin-bottom-20">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Cart Items</h2>
				<p class="mt-3">You can update your cart information here</p>
				<hr class="mt-1 mb-4">

				<!-- cart table start -->
				<!-- displaying notifications start-->
				@include( 'Frontend.partials.messages')
				<!-- displaying notifications end -->

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Product Title</th>
							<th>Product Image</th>
							<th>Product Quantity</th>
							<th>Unit Price</th>
							<th>Sub Total Price</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>

						@php
							$total = 0;
						@endphp
						@foreach ( App\Models\Cart::totalCarts() as $cart)
							<tr>
								<td>{{ $loop->index+1 }}</td>
								<td>
									<a href="{{ route('products.show', $cart->product->slug ) }}">
									{{ $cart->product->title }}
									</a>
								</td>
								<td>
									@if (isset($cart->product->images) && count($cart->product->images) > 0)
										<img src="{{ asset('images/products/'.$cart->product->images->first()->image ) }}" alt="" width="60" height="50">
									@endif
								</td>
								<td>
									<form action="{{ route('cart.update') }}" method="POST" class="form-inline">
										@csrf

										<input type="hidden" name="id" value="{{$cart->id}}">
										<input type="number" name="product_quantity" value="{{ $cart->product_quantity }}" class="form-control">
										<input type="submit" class="btn btn-success ml-3" value="Update">
									</form>
								</td>
								<td>৳{{$cart->product->price}}</td>
								<td>
									@php
									$unit_sub_total = $cart->product->price * $cart->product_quantity;
									$total += $unit_sub_total;
									@endphp
									৳{{$unit_sub_total}}</td>
								<td>								
									<form action="{{ route('cart.delete') }}" method="POST" class="form-inline">
										@csrf

										<input type="hidden" name="id" value="{{$cart->id}}">
										<input type="submit" class="btn btn-danger" value="Delete">
									</form>
								</td>
							</tr>
						@endforeach
						<style>
							.borderless{
								border:none !important;
							}
							.footer{
								position: unset !important;
							}
						</style>
						<tr>
							<td class="borderless"></td>
							<td class="borderless" colspan="4">
								<strong>Total Amount</strong>
							</td>
							<td colspan="2"><strong>৳ {{$total}}</strong></td>
						</tr>
					</tbody>
				</table>
				<!-- cart table end -->
				<div class="float-right mt-4">
					<a href="{{ route('products') }}" class="btn btn-info">Continue Shopping</a>
					<a href="{{ route('checkout.index') }}" class="btn btn-success">Procced to Checkout</a>
				</div>
			</div>
		</div>
	</div>		
</section>
<!-- contact section end -->
@endsection
@extends('Frontend.layouts.app2')

@section('content')
<!-- contact section start -->
<section class="content-body margin-top-20 margin-bottom-20">
	<div class="container">
		<div class="row">
			<div class="col-md-12">		

				<!-- displaying notifications start-->

				@if (isset($errors) && $errors->any())

				<div class="alert alert-danger alert-dismissible">
					<a href="" class="close" data-dismiss="alert">&times;</a>
					<ul>
						@foreach ($errors->all() as $error)
						<p>error: {{ $error }}</p>
						@endforeach
					</ul>
				</div>

				@endif
				@include( 'Frontend.partials.messages')
				<!-- displaying notifications end -->

				<div class="card bg-light mb-3">
					<div class="card-header"><h4>Confirm Items</h4></div>
					<div class="card-body">
						<table class="table table-hover table-borderless">
							<thead>
								<tr>
									<th>#</th>
									<th>Product Title</th>
									<th>Product Quantity</th>
									<th>Unit Price</th>
									<th>Sub Total Price</th>
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
										{{ $cart->product_quantity }}
									</td>
									<td>৳{{$cart->product->price}}</td>
									<td>
										@php
										$unit_sub_total = $cart->product->price * $cart->product_quantity;
										$total += $unit_sub_total;
										@endphp
									৳{{$unit_sub_total}}</td>
								</tr>
								@endforeach
								<style>
								.borderless{
									border:none !important;
								}
								.footer{
									position: unset !important;
								}
								.ml-30{
									margin-left: 30px;
								}
								.ml-20{
									margin-left: 20px;
								}
								.pr-10pr{
									padding-right: 6%;
								}
								.footer-link{
									text-decoration: unset;
								}
							</style>
							<tr class="border-top">
								<td class=""></td>
								<td class="" colspan="3">
									<strong>Total Amount</strong>
								</td>
								<td colspan="2"><strong>৳ {{$total}}</strong></td>
							</tr>
							<tr class="border-top">
								<td class="borderless"></td>
								<td class="borderless" colspan="3">
									Shipping Cost
								</td>
								<td colspan="2">৳ 
									<p class="ml-20 d-inline-block">
										{{ App\Models\Setting::first()->shipping_cost }}
									</p>
								</td>
							</tr>
							<tr class="border-top">
								<td class="borderless"></td>
								<td class="borderless" colspan="3">
									<strong>Total Price With Shipping Cost</strong>
								</td>
								<td colspan="2">
									<strong>৳ {{ $total + App\Models\Setting::first()->shipping_cost }}</strong>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="card-footer text-right pr-10pr">						
					<p class="">
						<a class="footer-link btn border" href="{{ route('cart.index') }}">Change Cart Items</a>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card bg-light">
				<div class="card-header"><h4>Shipping Address</h4></div>
				<div class="card-body">	
					<form method="POST" action="{{ route('checkout.store') }}">
						@csrf

						<!-- name starts-->
						<div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check() ? Auth::user()->first_name. " " . Auth::user()->last_name : ''}}"  autocomplete="name" autofocus required>

								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<!-- name ends-->

						<!-- email starts -->
						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ? Auth::user()->email : ''}}"  autocomplete="email">

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<!-- email ends -->


						<!-- phone starts -->
						<div class="form-group row">
							<label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

							<div class="col-md-6">
								<input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::check() ? Auth::user()->phone : ''}}"  autocomplete="phone" autofocus>

								@error('phone')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<!-- phone ends -->


						<!-- additional mesasge starts -->
						<div class="form-group row">
							<label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Additional Message') }}</label>

							<div class="col-md-6">
								<textarea rows="5" id="message" class="form-control @error('message') is-invalid @enderror" name="message" autocomplete="message" autofocus></textarea>

								@error('message')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<!-- additional mesasge ends -->


						<!-- shipping address starts -->
						<div class="form-group row">
							<label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Address') }}</label>

							<div class="col-md-6">
								<textarea rows="5" id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" autocomplete="shipping_address" autofocus required>{{ Auth::check() ? Auth::user()->shipping_address : ''}}</textarea>

								@error('shipping_address')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<!-- shipping address ends -->

						<style>
							.card-bg{
								background: #02aadd !important;
							}
						</style>


						<!-- payment selection starts -->
						<div class="form-group row">
							<label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Select Payment Option') }}</label>

							<div class="col-md-6">
								<select name="payment_method" id="payments" class="form-control" required="">
									<option value="">Please Select a Payment Method</option>
									@foreach ($payments as $payment)

									<option value="{{$payment->short_name}}">
										{{$payment->name}}
									</option>										
									@endforeach
								</select>

								@error('payment_method_id')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror

								@foreach ($payments as $payment)

									@if ($payment->short_name == "cash_in")

									<div id="payment_{{$payment->short_name}}" class="d-none card card-bg text-white mt-4">
										<div class="card-body">
											<h2>We got your order</h2>
											<hr class="mt-1 mb-4">
											<p class="mt-3">You will recieve your product in 2/3 business days</p>
										</div>
									</div>

									@else

									<div id="payment_{{$payment->short_name}}" class="d-none card card-bg text-white mt-4">
										<div class="card-body">	
											<h2>{{$payment->name}}</h2>
											<hr class="mt-1 mb-4">
											<p class="mt-3">
												<strong>{{$payment->name}} Number: </strong>
												{{$payment->no}}
											</p>
											<div class="alert alert-primary mt-5">
												Please send your payment to given bkash number and write transaction code below :
											</div>


											<!--  transaction input here -->	

											<div class="form-group">
												<input type="text" name="transaction_{{$payment->short_name}}" placeholder="Your Transaction Number" class="form-control">
											</div>						
											<!--  transaction input here -->
											
										</div>
									</div>		

									@endif
								@endforeach

								@section('script')
								<script>
									$('#payments').change(function(){
										$payment_method = $('#payments').val();
										if( $payment_method == "cash_in" ){
											$("#payment_cash_in").removeClass('d-none');
											$("#payment_bkash").addClass('d-none');
											$("#payment_rocket").addClass('d-none');
										}else if( $payment_method == "bkash" ){
											$("#payment_cash_in").addClass('d-none');
											$("#payment_bkash").removeClass('d-none');
											$("#payment_rocket").addClass('d-none');
										}else if( $payment_method == "rocket" ){
											$("#payment_cash_in").addClass('d-none');
											$("#payment_bkash").addClass('d-none');
											$("#payment_rocket").removeClass('d-none');
										}else{
											alert("please select a payment method");
										}
									});
								</script>
								@endsection

							</div>
						</div>
						<!-- payment selection ends -->


						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Complete Order') }}
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="card-footer text-right pr-10pr">						
					<p class="card-text">
						<a class="footer-link btn border" href="{{ route('cart.index') }}">Change Cart Items</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>		
</section>
<!-- contact section end -->
@endsection
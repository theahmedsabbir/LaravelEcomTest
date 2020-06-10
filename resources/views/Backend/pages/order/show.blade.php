@extends('Backend.layouts.master')


@section('content')

<style>
.table th {
	height: unset;
}
div.dataTables_wrapper div.dataTables_length select {
	width: 61px;
}
div#dataTables_wrapper {
	font-size: 0.875rem;
}
table.dataTable thead .sorting_asc:before,table.dataTable thead .sorting:before{
	display: none;
}
table.dataTable thead .sorting_asc:after,table.dataTable thead .sorting:after{
	display: none;
}

</style>

<div class="main-panel">
	<div class="content-wrapper">
		<div class="card mb-4">
			<div class="card-header">Order Information</div>
			<div class="card-body">
				<!-- displaying messages here -->
				@include('Backend.partials.messages')
				
				<table class="table table-hover table-bordered">
					<tbody>
						<tr>
							<th>Order ID</th>
							<td>#LE{{$order->id}}</td>
						</tr>
						<tr>
							<th>Customer's Name</th>
							<td>{{$order->name}}</td>
						</tr>
						<tr>
							<th>Customer's Phone</th>
							<td>{{$order->phone}}</td>
						</tr>
						<tr>
							<th>Customer's Email</th>
							<td>{{$order->email}}</td>
						</tr>
						<tr>
							<th>Customer's Shipping Address</th>
							<td>{{$order->shipping_address}}</td>
						</tr>
						<tr>
							<th></th>
							<td></td>
						</tr>
						<tr>
							<th>Payment Method</th>
							<td>{{$order->payment->name}}</td>
						</tr>
						<tr>
							<th>Transaction ID</th>
							<td>{{$order->transaction_id}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		
		<div class="card">
			<div class="card-header">Ordered Items</div>
			<div class="card-body">
				<!-- displaying messages here -->
				@include('Backend.partials.messages')

				<!-- ordered item start -->
				@if (count($order->carts) > 0)

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

						@foreach ( $order->carts as $cart)
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
					<!-- ordered item end -->
				</table>

				<div class="my-4">
					
					<form action="{{ route('admin.order.chargeUpdate', $order->id ) }}" method="POST">
						@csrf

						<div class="form-group">
							<label for="shipping_charge">Shipping Charge</label>
							<input type="number" value="{{$order->shipping_charge}}" name="shipping_charge" class="form-control">
						</div>

						<div class="form-group">
							<label for="custom_discount">Custom Discount</label>
							<input type="number" value="{{$order->custom_discount}}" name="custom_discount" class="form-control">
						</div>

						<div class="form-group">
							<input type="submit" value="Update" class="btn btn-success">
							<a href="{{ route('admin.order.generateInvoice', $order->id) }}" target="_blank" class="btn btn-primary ml-2">Generate Invoice</a>
						</div>
					</form>
				</div>

				<div class="d-flex justify-content-end mt-4">
					<form action="{{ route('admin.order.completed', $order->id ) }}" method="POST" class="form-inline mr-2">
						@csrf

						@if ($order->is_completed)
						<input type="submit" value="Cancel Order" class="btn btn-danger d-inline">

						@else 
						<input type="submit" value="Complete Order" class="btn btn-success d-inline">
						@endif
					</form>

					<form action="{{ route('admin.order.paid', $order->id ) }}" method="POST" class="form-inline">
						@csrf

						@if ($order->is_paid)
						<input type="submit" value="Cancell Payment" class="btn btn-danger">

						@else 
						<input type="submit" value="Completee Payment" class="btn btn-success">
						@endif
					</form>
				</div>
				@endif
		</div>
	</div>
</div>
</div>
@endsection



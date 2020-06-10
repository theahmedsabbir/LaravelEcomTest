@extends('Frontend.layouts.app2')

@section('content')
<style>
.cart-body{
	background: url("{{ asset('images/cart/blank_cart.jpg') }}");
	/* background-position: center; */
	background-repeat: no-repeat;
	background-size: cover;
	min-height: 85vh;
	margin: 0;
	border: none;
}
.card{
	background: unset;
	border: none;
	color:black;
}
.card-title{
	font-weight: 700;
}
hr{
	background: #ffffff;
}
.btn{
	background: #02aadd !important;
	border:1px solid transparent !important;
	color: white;
}
.btn:hover{
	text-decoration: none;
	color: white;
	background: #02aadda8;
	transition: .3s ease-in-out;
	box-shadow: 0px 0px 20px 4px;
	/*font-weight: bold;*/
}
</style>
<!-- content section start -->
<section class="cart-body margin-top-20 margin-bottom-20">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="card mt-4">
					<div class="card-body">						
						<h2 class="card-title">Your cart is empty</h2>
						<p class="mt-3 card-text">
							You havent added any item in your cart. Please do some shopping. Thank you. 
						</p>
						<hr class="mb-4 mt-2">
						<a href="{{ route('products') }}" class="btn btn-flat">Continue Shopping</a>
					</div>
				</div>
			</div>
			<div class="col-md-7"></div>
		</div>
	</div>		
</section>
<!-- content section end -->
@endsection
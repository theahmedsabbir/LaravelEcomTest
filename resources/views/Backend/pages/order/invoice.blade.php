<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice</title>

	<!-- <link rel="stylesheet" href="{{asset('css/temp.css')}}"> -->

	<style>

	
body {
	margin: 0;
	padding: 40px 20px;
	font-family: sans-serif;
}

*{
	margin: 0;
	padding: 0;
}

.box{
	/*float: left;*/
	padding: 15px 0px;
}

.clearfix{
	clear: both;
}

.float-left{
	float: left;
}

.float-right{
	float: right;
	/* background: green; */
	/*width: 30%;*/
}
section{
	width: 100%;
	float: left;
}

.blue{
	color: #2bbaff;
}

.orange{
	color: #EB5C02;
}

.orange-border{
	border-color: #EB5C02;
}


/*gend*/

/*head section */
.head{
	background: #;
	float: left;
	width: 100%;
	background: #e1e1e1;
	padding: 19px 25px 33px 18px;
	box-sizing: border-box;
	border-bottom: 2px solid;
	border-color: darkgray;
	height: 15%;
}
.head .head-left{
	width: 60%;
	/* background: red; */
}
.head .head-left img{}
.head .head-right{
	width: 40%;
}
.head .head-right h3{
	color: #1e1e1e;
	margin-bottom: 19px;
	font-size: 23px;
}
.head .head-right p{
	margin-bottom: 12px;
}
.head .head-right p .blue{color: #2bbaff;font-weight: 500;}

/*head section*/


/*order info */


.order_info{
    padding: 20px 21px;
    border-left: 5px solid #EB5C02;
    line-height: 1.8;
    width: 100%;
    box-sizing: border-box;
    height: 20%;
}
.order_info .float-left{
    text-align: left;
    max-width: 50%;
}
.order_info .float-left p{}
.order_info .float-left h1{}
.order_info .float-right{
    /*text-align: right;*/
    display: inline-block;
    width: 40%;
}
.order_info .float-right h1{
    font-size: 47px;
    padding-left: 10px;
}
.order_info .float-right p{
    text-align: left;
    font-size: 15px;
    padding-left: 10px;
}

/*order info */

/*product */
.table{
	width: 100%;
}
.table, th, td{
	border: 1px solid #e1e1e1;
	border-collapse: collapse;
	text-align: center;
}

.table th, .table td{
	padding:10px 15px;
}


/*product */


	</style>

</head>
<body>

	<!-- head section design start -->
	<section class="head">
		<div class="float-left head-left">	
			<img src="{{public_path('images/logo.png')}}" alt="">
		</div>

		<div class="float-right head-right">
			<h3>Laravel Ecommerce</h3>
			<p>Sector-8, Uttara, Dhaka</p>
			<p>Phone: <span class="blue">01723494591</span></p>
			<p>Email: <span class="blue">iamahmedsabbir@gmail.com</span></p>
		</div>
	</section>

	<div class="clearfix"></div>


	<section class="order_info">
		<div class="float-left">
			<p>Invoice to</p>
			<h1>{{$order->name}}</h1>
			<p><strong>Address:</strong>{{$order->shipping_address}}</p>
			<p>Phone: {{$order->phone}}</p>
			<p>Email: <span class="blue">{{$order->email}}</span></p>
		</div>
		<div class="float-right">
			<h1 class="orange">Invoice #{{$order->id}}</h1>
			<p>{{$order->created_at}}</p>
		</div>
	</section>



	<div class="clearfix"></div>
	
	<section class="product">
		<h1 style="margin: 10px 0;">Products</h1>
		<!-- ordered item start -->
		@if (count($order->carts) > 0)

		<table class="table">
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

				@foreach ( $order->carts as $cart)
				<tr>
					<td>{{ $loop->index+1 }}</td>
					<td class="blue">
						{{ $cart->product->title }}
					</td>
					<td>
						{{ $cart->product_quantity }}
					</td>
					<td>Tk.{{$cart->product->price}}</td>
					<td>
						@php
						$unit_sub_total = $cart->product->price * $cart->product_quantity;
						$total += $unit_sub_total;
						@endphp
					Tk.{{$unit_sub_total}}</td>
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

				<tr style="border: unset;">
					<td style="text-align: left !important;" colspan="4">
						<strong>Discount</strong>
					</td>
					<td><strong>Tk. {{$order->custom_discount}}</strong></td>
				</tr>

				<tr style="border: unset;">
					<td style="text-align: left !important;" colspan="4">
						<strong>Shipping Charge</strong>
					</td>
					<td><strong>Tk. {{$order->shipping_charge}}</strong></td>
				</tr>

				<tr>
					<td style="text-align: left !important;" colspan="4">
						<strong>Total Amount</strong>
					</td>
					<td><strong>Tk. {{$total + $order->shipping_charge - $order->custom_discount}}</strong></td>
				</tr>
			</tbody>
			<!-- ordered item end -->
		</table>
		@endif

	</section>



	<div class="clearfix"></div>


	<style>
		.thanks{
			padding:20px 0;
			font-size: 30px;
		}
		.thanks p{}
	</style>

	
	<div class="thanks">
		<p class="orange">Thank You For Your Business !!</p>
	</div>


	<div class="clearfix"></div>

	<style>
		.sign{
			padding: 20px 0;
			text-align: right;
		}
		.sign p{
			font-size: 20px;
		}
		.sign .orange{}
	</style>

	<div class="sign">
		<p>-------------------------</p>
		<p class="orange">Authority Signature</p>
	</div>


	<!-- head section design end -->

</body>
</html>




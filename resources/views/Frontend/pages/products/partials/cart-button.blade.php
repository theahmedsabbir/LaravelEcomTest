<form action="{{ route('cart.store') }}" method="POST" class="form-inline">
	@csrf
	<input type="hidden" name="product_id" value="{{$product->id}}">
	<button type="button" class="btn btn-warning" onclick="addToCart( {{$product->id}} )">
		<i class="fa fa-cart-plus"></i> Add To Cart
	</button>
</form>
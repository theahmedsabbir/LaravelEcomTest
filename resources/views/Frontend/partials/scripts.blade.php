
	<!-- bootstrap js -->
	<script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<!-- <script src="{{ asset('js/app.js') }}"></script> -->

	<!-- parsley js -->
	<script src="{{ asset('js/parsley.min.js') }}"></script>

	<!-- select2 js -->
	<script src="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js') }}"></script>

	<!-- alertify js -->
	<script src="{{ asset('//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js') }}"></script>

	<!--custom js -->
	<script src="{{ asset('js/custom.js') }}"></script>

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		function addToCart(id){

			// doing a post request through api
			var url = "{{ url('/') }}";
			$.post( url+"/api/cart/store", { product_id: id })
			.done(function( data ) {
				data = JSON.parse(data);
				if(data.status == 'success'){
					// toast
					alertify.set('notifier','position', 'top-center');
					alertify.success(
						'<p>Item Added to Cart Successfully</p>'+
						'<p>total Items: '+data.totalItems+'</p>'+
						'<p><a href="api/cart/">Go To Checkout</a></p>'
					);
					// update cart
					$('#totalItems').html(data.totalItems);
				} 
			});
		}
	</script>

	@yield('script')


<h3 class="mb-3">Find Your Items</h3>
<div class="list-group">



	@foreach (App\Models\Category::orderBy('name', 'asc')->where( 'parent_id', NULL)->get() as $parent)		

	<!-- parent list start --> 

	<a href="#demo{{$parent->id}}" class="list-group-item" data-toggle="collapse" data-target="">
		<img src="{{ asset('images/categories/'.$parent->image) }}" alt="{{ $parent->name }}" width="70" class="mr-3">
		{{ $parent->name }}		
	</a>

	<div id="demo{{$parent->id}}" class="collapse

		@if ( Route::is( 'categories.show' ))
			@if ($check = App\Models\Category::ParentOrNotCategory( $category->id, $parent->id ))
				show
			@endif

		@endif

	 list-group">
		
		<!-- child list start -->

		@foreach (App\Models\Category::orderBy('name', 'asc')->where( 'parent_id', $parent->id)->get() as $child)		


		<a href="{{ route('categories.show', $child->id ) }}" class="list-group-item pl-5 

			@if( isset($category) && Route::is( 'categories.show' && $child->id == $category->id ))
				active
			@endif

		">
			<img src="{{ asset('images/categories/'.$child->image) }}" alt="{{ $child->name }}" width="50" class="mr-3">
			{{ $child->name }}		
		</a>

		@endforeach

		<!-- child list end -->

	</div>


	@endforeach
	<!-- parent list start --> 
</div>


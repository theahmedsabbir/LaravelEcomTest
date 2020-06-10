@extends('Backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">Add Product</div>
			<div class="card-body">

				<!-- displaying error here -->
				@include('Backend.partials.messages')
				<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
					
					@csrf
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" name="title" class="form-control">
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" rows="5" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<label for="price">Price</label>
						<input type="number" name="price" class="form-control">
					</div>

					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input type="number" name="quantity" class="form-control">
					</div>

					<div class="form-group">
						<label for="category_id">Select Category</label>
						<select name="category_id" class="form-control">
							@foreach (App\Models\Category::where('parent_id', NULL)->get() as $parent)
								<option value="{{$parent->id}}">{{$parent->name}}</option>

								@foreach (App\Models\Category::where('parent_id', $parent->id)->get() as $child)
									<option value="{{$child->id}}">{!!"------- ".$child->name!!}</option>
								@endforeach
							@endforeach
							
						</select>
					</div>

					<div class="form-group">
						<label for="brand_id">Select Brand</label>
						<select name="brand_id" class="form-control">
							
							@foreach (App\Models\Brand::orderBy('name', 'asc')->get() as $brand)
								<option value="{{$brand->id}}">{{$brand->name}}</option>
							@endforeach
							
						</select>
					</div>

					<div class="form-group">
						<label for="product_image">Product Image</label><br>
						<input type="file" name="product_image[]" multiple="multiple"><br>
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Add Product">
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection



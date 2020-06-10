
@if ($errors->any())

    <div class="alert alert-danger alert-dismissible">
    	<a href="" class="close" data-dismiss="alert">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <p>error: {{ $error }}</p>
            @endforeach
        </ul>
    </div>

@endif



@if (Session::has('success'))

    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <p class="m-0">{{ Session::get('success') }}</p>
    </div>

@endif



@if (Session::has('sticky_error'))


    <div class="alert alert-danger alert-dismissible my-3">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <p class="m-0">{{ Session::get('sticky_error') }}</p>
    </div>

@endif


{{-- @if (Session::has('errors'))

    <div class="alert alert-success alert-dismissible">
    	<a href="#" class="close" data-dismiss="alert">&times;</a>
    	<p class="m-0">{{ Session::get('errors') }}</p>
    </div>

@endif --}}
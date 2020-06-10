<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <!-- font-awesome cdn -->
    <link rel="stylesheet" href=" {{ asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">

    <!-- parsley css -->
    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">

    <!-- select to css -->
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css') }}" rel="stylesheet" />

    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- bootstrap css -->
    <!-- <link rel="stylesheet" href="{{-- {{ asset('css/app.css') }} --}}"> -->

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin_custom.css') }}">

    <title>Hello, Admin!</title>
</head>
<body>

@yield('content') 



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- bootstrap js -->
<script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- <script src="{{ asset('js/app.js') }}"></script> -->

<!-- parsley js -->
<script src="{{ asset('js/parsley.min.js') }}"></script>

<!-- select2 js -->
<script src="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js') }}"></script>

<!--custom js -->
<script src="{{ asset('js/custom.js') }}"></script>

@yield('script')
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- title -->
	<title>@yield('title', 'Laravel Ecommerce')</title>

  <!-- stylesheets -->
  @include('Frontend.partials.styles')  
</head>

<body class="">

  <!-- nav start -->
  @include('Frontend.partials.nav')
  <!-- nav ends -->

  <!-- contents start -->
  @yield('content')        
  <!-- contents end -->


  <!-- footer starts -->
  @include('Frontend.partials.footer')
  <!-- footer ends -->

  <!-- scripts -->
  @include('Frontend.partials.scripts')
</body>
</html>




















































<!-- 
/*
{{--
			<?php echo "<pre>"; ?>
			{{ print_r($student) }}
			<?php echo "</pre>"; ?>
--}}
*/
 -->


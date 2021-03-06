<!DOCTYPE html>
<html lang="zxx">
  <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="corporate, creative, general, portfolio, photography, blog, e-commerce, shop, product, gallery, retina, responsive">
    <meta name="author" content="ElectronThemes">
	<title>@yield('page-title')</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<script>
		var AppRootPath = '{{ url('/') }}';
	</script>
	
	<style>
		.sidebar .brand-logo a {
			background-image: url('{{ url('/') }}/images/logo-white.png');
		}
	</style>

	<link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" />
	
	<link rel="stylesheet" href="{{ asset('public/css/app.css') }}" />

    @if (trim($__env->yieldContent('header')))
    <!-- Header Scripts only for this page start -->

        @yield('header')
        
    <!-- Header Scripts only for this page end -->
    @endif

  </head>
<body>
<div class="wrapper" id="app">
	@include('partials.sidemenu')

	<!-- START MAIN CONTENT -->
	<main class="main-content">
		@include('partials.navbar')
		@include('errors')
		@yield('page-content')
	</main>
	<!-- MAIN CONTENT END -->
</div>
	
	<script src="{{ asset('public/js/app.js') }}"></script>
	<!-- EndInput -->
	@if (trim($__env->yieldContent('footer')))
	<!-- Footer Scripts only for this page start -->
	@yield('footer')
	<!-- Footer Scripts only for this page end -->
	@endif
</body>
</html>
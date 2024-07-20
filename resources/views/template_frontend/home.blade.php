<!DOCTYPE html>
<html lang="zxx">
<style>
    .hs-item {
        position: relative;
        overflow: hidden;
    }

    .hs-item img {
        width: 100%;
        height: auto;
        display: block;
    }

    .hs-item::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        opacity: 0.5; /* Sesuaikan kebutuhan keberlanjutan warna hitam */
    }
</style>
<head>
	<title>Fine-B Sticker</title>
	<link rel="shortcut icon" href="https://images2.imgbox.com/fb/a4/cl8uCVQl_o.png">
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('user/css/flaticon.css') }}" />
	<link rel="stylesheet" href="{{ asset('user/css/slicknav.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('user/css/jquery-ui.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('user/css/owl.carousel.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('user/css/animate.css') }}" />
	<link rel="stylesheet" href="{{ asset('user/css/style.css') }}" />

	@yield('css')

	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>

<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

  	@include('template_frontend.navbar')

	@yield('content')

  	@include('template_frontend.footer')

@php

// use App\Http\Controllers\LoginController;
// $users = LoginController::user();

@endphp

<html lang="{{ config('app.locale') }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<title>@yield('title') - Super Bank App</title>

	<meta name="description" content="Super Bank App">
	<meta name="author" content="super-bank-app">
	<meta name="robots" content="noindex, nofollow">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" href="{{ asset('assets/ta-logo.png') }}">

	<!-- Fonts and Styles -->
	@yield('css_before')
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" id="css-main" href="{{ url('/css/oneui.css') }}">

	<!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
	<link rel="stylesheet" id="css-theme" href="{{ url('/css/themes/city.css') }}">
	@yield('css_after')

	<script>
		window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};

		function thousands_separators(num) {
			var num_parts = num.toString().split(".");
			num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			return num_parts.join(".");
		}


	</script>
	<style>
		#load-overlay {
			background: rgba(20, 20, 20, 0.90);
			color: red;
			position: absolute;
			height: 100%;
			width: 100%;
			z-index: 5000;
			float: left;
			text-align: center;
		}

		.lds-roller {
			margin: 0 auto;
			display: inline-block;
			position: relative;
			width: 80px;
			height: 80px;
		}

		.lds-roller div {
			animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
			transform-origin: 40px 40px;
		}

		.lds-roller div:after {
			content: " ";
			display: block;
			position: absolute;
			width: 7px;
			height: 7px;
			border-radius: 50%;
			background: #fff;
			margin: -4px 0 0 -4px;
		}

		.lds-roller div:nth-child(1) {
			animation-delay: -0.036s;
		}

		.lds-roller div:nth-child(1):after {
			top: 63px;
			left: 63px;
		}

		.lds-roller div:nth-child(2) {
			animation-delay: -0.072s;
		}

		.lds-roller div:nth-child(2):after {
			top: 68px;
			left: 56px;
		}

		.lds-roller div:nth-child(3) {
			animation-delay: -0.108s;
		}

		.lds-roller div:nth-child(3):after {
			top: 71px;
			left: 48px;
		}

		.lds-roller div:nth-child(4) {
			animation-delay: -0.144s;
		}

		.lds-roller div:nth-child(4):after {
			top: 72px;
			left: 40px;
		}

		.lds-roller div:nth-child(5) {
			animation-delay: -0.18s;
		}

		.lds-roller div:nth-child(5):after {
			top: 71px;
			left: 32px;
		}

		.lds-roller div:nth-child(6) {
			animation-delay: -0.216s;
		}

		.lds-roller div:nth-child(6):after {
			top: 68px;
			left: 24px;
		}

		.lds-roller div:nth-child(7) {
			animation-delay: -0.252s;
		}

		.lds-roller div:nth-child(7):after {
			top: 63px;
			left: 17px;
		}

		.lds-roller div:nth-child(8) {
			animation-delay: -0.288s;
		}

		.lds-roller div:nth-child(8):after {
			top: 56px;
			left: 12px;
		}

		@keyframes lds-roller {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}

		.dropdown-v2 {
			position: relative;
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f1f1f1;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			z-index: 1;
		}

		.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
		}

		.dropdown-content a:hover {background-color: #ddd;}

		.dropdown-v2:hover .dropdown-content {display: block;}
	</style>
</head>

<body>

	<div id="page-container"
	class="sidebar-o sidebar-mini enable-page-overlay sidebar-dark side-scroll page-header-fixed page-header-dark">

	<nav id="sidebar" aria-label="Main Navigation">
		<div class="content-header bg-white-5">
			<a class="font-w600 text-dual" href="{{ url('/') }}">
				<span class="smini-visible">
					<span class="font-w900 text-primary">SB</span>
				</span>
				<span class="smini-hide font-size-h5 tracking-wider">
					SUPER<span class="font-w900 text-primary"> BANK APP</span>
				</span>
			</a>
			<div>
				<a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close"
				href="javascript:void(0)">
				<i class="fa fa-fw fa-times"></i>
			</a>
		</div>
	</div>
	<div class="js-sidebar-scroll">
		<div class="content-side">

			<ul class="nav-main">
                <li class="nav-main-heading">MAIN MENU</li>
				<li class="nav-main-item">
					<a class="nav-main-link{{ request()->is('/') ? ' active' : '' }}"
						href="{{ url('/') }}">
						<i class="nav-main-link-icon si si-home"></i>
						<span class="nav-main-link-name">Home</span>
					</a>
				</li>
				<li class="nav-main-item">
					<a class="nav-main-link{{ request()->is('menus/acc-sub') ? ' active' : '' }}"
					href="{{ url('/menus/acc-sub') }}">
						<i class="nav-main-link-icon fa fa-user"></i>
						<span class="nav-main-link-name">Account Submissions</span>
					</a>
				</li>
            </ul>
        </div>
    </div>
</nav>
<header id="page-header">
	<div class="content-header" style="max-width: none">
		<div class="d-flex align-items-center">

			<button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout"
			data-action="sidebar_toggle">
			<i class="fa fa-fw fa-bars"></i>
		</button>

		<button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block"
		data-toggle="layout" data-action="sidebar_mini_toggle">
		<i class="fa fa-fw fa-ellipsis-v"></i>
	</button>

</div>
<div class="d-flex align-items-center">
<div class="dropdown d-inline-block ml-2">
	<button type="button" class="btn btn-sm btn-dual d-flex align-items-center"
	id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true"
	aria-expanded="false">
	<img class="rounded-circle" src="{{ asset('media/avatars/avatar10.jpg') }}"
	alt="Header Avatar" style="width: 21px;">
	<span class="d-none d-sm-inline-block ml-2"> nama </span>
	<i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
</button>
<div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0"
aria-labelledby="page-header-user-dropdown">
<div class="p-3 text-center bg-primary-dark rounded-top">
	<img class="img-avatar img-avatar48 img-avatar-thumb"
	src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
	<p class="mt-2 mb-0 text-white font-w500"> nik </p>
	<p class="mb-0 text-white-50 font-size-sm">-</p>
</div>
<div class="p-2">
	<a class="dropdown-item d-flex align-items-center justify-content-between"
	href=" {{ url('logout') }} ">
	<span class="font-size-sm font-w500">Log Out</span>
</a>
</div>
</header>
@yield('content')

<?php
echo "<pre>";
print_r(session()->all());
echo "</pre>";
?>

</main>
</div>

<script src="{{ url('js/oneui.app.js') }}"></script>
<script src="{{ url('/js/laravel.app.js') }}"></script>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>
</script>
@yield('js_after')
</body>

</html>

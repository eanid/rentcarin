<!doctype html>

<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>{{ $title }}</title>
	<!-- CSS files -->
	<link href="{{ base_url('tabler') }}/dist/css/tabler.min.css" rel="stylesheet" />
	<link href="{{ base_url('tabler') }}/dist/css/tabler-flags.min.css" rel="stylesheet" />
	<link href="{{ base_url('tabler') }}/dist/css/tabler-payments.min.css" rel="stylesheet" />
	<link href="{{ base_url('tabler') }}/dist/css/tabler-vendors.min.css" rel="stylesheet" />
	<link href="{{ base_url('tabler') }}/dist/css/demo.min.css" rel="stylesheet" />

	<!-- Linear Icon -->
	<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

	@yield('css')

	<style>
		.navbar-dark {
			background: #000;
    		color: rgba(255,255,255,.7);
		}
		.nav-item.active {
			background: #206bc4;
		}
	</style>

</head>

<body class="antialiased">
	<div class="wrapper">

		@include('default.layouts.sidebar')

		<div class="page-wrapper">

			@include('default.layouts.navbar')

			<div class="container-fluid">

				<!-- Page title -->
				<div class="page-header d-print-none">
					<div class="row align-items-center">

						@include('default.layouts.title')

						@include('default.layouts.right_action')

					</div>
				</div>
			</div>

			<div class="page-body">
				<div class="container-fluid">

					@yield('content')

				</div>
			</div>

			<!-- @include('default.layouts.footer') -->

		</div>
	</div>	

	<!-- Tabler Core -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
	<script src="{{ base_url('tabler') }}/dist/js/blockui.js"></script>
	<script src="{{ base_url('tabler') }}/dist/js/tabler.min.js"></script>

	<script>
		feather.replace({
			class: 'icon'
		})
	</script>

	<!-- Libs JS -->
	@yield('js')

	@yield('js_init')


</body>

</html>
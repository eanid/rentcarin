<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>Sign in - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
	<!-- CSS files -->
	<link href="{{ base_url('tabler') }}/dist/css/tabler.min.css" rel="stylesheet" />
	<link href="{{ base_url('tabler') }}/dist/css/tabler-flags.min.css" rel="stylesheet" />
	<link href="{{ base_url('tabler') }}/dist/css/tabler-payments.min.css" rel="stylesheet" />
	<link href="{{ base_url('tabler') }}/dist/css/tabler-vendors.min.css" rel="stylesheet" />
	<link href="{{ base_url('tabler') }}/dist/css/demo.min.css" rel="stylesheet" />
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
	<div class="page page-center">
		<div class="container-tight py-4">
			<div class="text-center mb-4">
				<a href="."><img src="{{ base_url('tabler') }}/static/logo.svg" height="36" alt=""></a>
			</div>
			<?php $attr = [
				'class' => 'card card-md '.$border,
				'autocomplete' => 'off' ]	
			?>		
			<?php echo form_open("auth/login", $attr); ?>
				<div class="card-body">
					<h2 class="card-title text-center mb-0">Login to your account</h2>
					<p class="text-center mb-4 small lh-base text-danger"><?php echo $message ?></p>
					<div class="mb-3">
						<label class="form-label">Email address</label>
						<?php echo form_input($identity); ?>
						<?php echo form_error('identity') ?>
					</div>
					<div class="mb-2">
						<label class="form-label">
							Password
							<span class="form-label-description">
								<a href="#">I forgot password</a>
							</span>
						</label>
						<?php echo form_input($password); ?>							
						<?php echo form_error('password') ?>
					</div>
					<div class="mb-2">
						<label class="form-check">
							<?php echo form_checkbox('remember', '1', FALSE, 'id="remember" class="form-check-input"'); ?>
							<span class="form-check-label">Remember me</span>
						</label>
					</div>
					<div class="form-footer">
						<button type="submit" class="btn btn-primary w-100">Sign in</button>
					</div>
				</div>
				
				
			<?php echo form_close() ?>
			<div class="text-center text-muted mt-3">
				Don't have account yet? <a href="#" tabindex="-1">Contact us</a>
			</div>
		</div>
	</div>
	<!-- Libs JS -->
	<!-- Tabler Core -->
	<script src="{{ base_url('tabler') }}/dist/js/tabler.min.js"></script>
</body>

</html>

<div id="infoMessage"><?php echo $message; ?></div>
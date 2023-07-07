@extends('default.layouts.master')

@section('right_button')
<span class="d-none d-sm-inline">
	<a href="{{ site_url('user/new') }}" class="btn btn-primary btn-sm">
		<i data-feather="plus"></i>Add New User
	</a>
	<a href="{{ site_url('auth') }}" class="btn btn-info btn-sm">
		<i data-feather="users"></i>Users
	</a>
</span>
@endsection

@section('subtitle')
Add new user here
@endsection

@section('title')
New user
@endsection

@section('content')

<div class="row row-cards">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Complete the Form</h3>
			</div>
			<div class="card-body">
				<?php echo form_open("user/new"); ?>

					<div class="form-group mb-3 row">
						<label class="form-label col-3 col-form-label text-end">First Name</label>
						<div class="col-5">
							<?php echo form_input($first_name); ?>
							<?php echo form_error('first_name') ?>
						</div>
					</div>

					<div class="form-group mb-3 row">
						<label class="form-label col-3 col-form-label text-end">Last Name</label>
						<div class="col-4">
							<?php echo form_input($last_name); ?>
							<?php echo form_error('last_name') ?>
						</div>
					</div>

					<?php if ($identity_column !== 'email'): ?>

					<div class="form-group mb-3 row">
						<label class="form-label col-3 col-form-label text-end">Identity</label>
						<div class="col-5">
							<?php echo form_input($identity); ?>
							<?php echo form_error('identity'); ?>
						</div>
					</div>

					<?php endif ?>
					
					<div class="form-group mb-3 row">
						<label class="form-label col-3 col-form-label text-end">Company</label>
						<div class="col-5">
							<?php echo form_input($company) ?>
							<?php echo form_error('company') ?>
						</div>
					</div>

					<div class="form-group mb-3 row">
						<label class="form-label col-3 col-form-label text-end">Email</label>
						<div class="col-3">
							<?php echo form_input($email) ?>
							<?php echo form_error('email') ?>
						</div>
					</div>

					<div class="form-group mb-3 row">
						<label class="form-label col-3 col-form-label text-end">Phone</label>
						<div class="col-3">
							<?php echo form_input($phone) ?>
							<?php echo form_error('phone') ?>
						</div>
					</div>

					<hr>

					<div class="form-group mb-3 row">
						<label class="form-label col-3 col-form-label text-end">Password</label>
						<div class="col-4">
							<?php echo form_input($password) ?>
							<?php echo form_error('password') ?>
						</div>
					</div>

					<div class="form-group mb-3 row">
						<label class="form-label col-3 col-form-label text-end">Confirm Password</label>
						<div class="col-4">
							<?php echo form_input($password_confirm) ?>
							<?php echo form_error('password_confirm') ?>
						</div>
					</div>

					<hr>

					<div class="form-group mb-3 row">
						<div class="col-3"></div>
						<div class="col-2">
							<button class="btn btn-primary w-100">Create User</button>
						</div>						
					</div>					

				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>

@endsection
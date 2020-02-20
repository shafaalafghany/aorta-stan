<!DOCTYPE html>
<html>

<head>
	<title><?= $judul; ?></title>
	<link rel="shortcut icon" type="text/css" href="<?= base_url('assets/User/'); ?>images/logo.ico">
	<link rel="stylesheet" href="<?= base_url('assets/User/'); ?>plugins/fontawesome-free/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/User/'); ?>css/login.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<div class="img">
			<img src="<?= base_url('assets/User/'); ?>images/img.svg">
		</div>
		<div class="login-container">
			<form method="POST" action="<?= base_url('User/login'); ?>">
				<img class="avatar" src="<?= base_url('assets/User/'); ?>images/user2.png">
				<h2>LOG IN</h2>
				<?= $this->session->flashdata('message'); ?>
				<?= form_error('username', '<div class="alert alert-danger" role="alert">', '</div>') ?>
				<?= form_error('password', '<div class="alert alert-danger" role="alert">', '</div>') ?>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div>
						<h5>Username</h5>
						<input type="text" class="input" id="username" name="username">
					</div>
				</div>
				<div class="input-div two">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div>
						<h5>Password</h5>
						<input type="password" class="input" id="password" name="password">
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-user btn-block">LOGIN</button>
				<a href="<?= base_url(); ?>forgot_password">Lupa Password?</a>
				<a href="<?= base_url(); ?>registration">Belum Punya Akun? Klik Disini</a>
			</form>
		</div>
	</div>

	<script src="<?= base_url('assets/User/'); ?>js/sweetalert2.all.min.js"></script>
	<script src="<?= base_url('assets/User/'); ?>js/login.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
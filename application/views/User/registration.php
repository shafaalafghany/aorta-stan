<!DOCTYPE html>
<html>

<head>
	<title><?= $judul; ?></title>
	<link rel="shortcut icon" type="text/css" href="<?= base_url('assets/User/'); ?>images/logo.ico">
	<link rel="stylesheet" href="<?= base_url('assets/User/'); ?>plugins/fontawesome-free/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/User/'); ?>css/login.css">
</head>

<body>
	<div class="container">
		<div class="img">
			<img src="<?= base_url('assets/User/'); ?>images/regist.svg">
		</div>
		<div class="login-container">
			<form method="POST" action="<?= base_url('User/registration'); ?>">
				<h2>REGISTRASI</h2>
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
						<i class="fas fa-user"></i>
					</div>
					<div>
						<h5>Nama Lengkap</h5>
						<input type="text" class="input" id="name" name="name">
					</div>
				</div>
				<div class="input-div three">
					<div class="i">
						<i class="fas fa-at"></i>
					</div>
					<div>
						<h5>Email</h5>
						<input type="text" class="input" id="email" name="email">
					</div>
				</div>
				<div class="input-div four">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div>
						<h5>Password</h5>
						<input type="password" class="input" id="password1" name="password1">
					</div>
				</div>
				<div class="input-div five">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div>
						<h5>Ulangi Password</h5>
						<input type="password" class="input" id="password2" name="password2">
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-user btn-block">DAFTAR</button>
				<a href="<?= base_url(); ?>login">Sudah Punya Akun? Klik Disini</a>
			</form>
		</div>
	</div>

	<script src="<?= base_url('assets/User/'); ?>js/login.js"></script>
</body>

</html>
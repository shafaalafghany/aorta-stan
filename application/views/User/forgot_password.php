<!DOCTYPE html>
<html>

<head>
	<title><?= $judul; ?></title>
	<link rel="stylesheet" href="<?= base_url('assets/User/'); ?>plugins/fontawesome-free/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/User/'); ?>css/login.css">
</head>

<body>
	<div class="container">
		<div class="img">
			<img src="<?= base_url('assets/User/'); ?>images/forgot_password.svg">
		</div>
		<div class="login-container">
			<form>
				<h3>Anda Lupa Password?</h3>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-at"></i>
					</div>
					<div>
						<h5>Masukkan Email Dulu</h5>
						<input type="text" class="input">
					</div>
				</div>
				<input type="submit" class="btn" value="Cek Email">
				<a href="<?= base_url(); ?>login">Sudah Ingat Password? Kembali ke login</a>
			</form>
		</div>
	</div>

	<script src="<?= base_url('assets/User/'); ?>js/login.js"></script>
</body>

</html>
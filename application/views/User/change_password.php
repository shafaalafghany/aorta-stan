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
			<img src="<?= base_url('assets/User/'); ?>images/ganti_password.svg">
		</div>
		<div class="login-container">
			<form>
				<h1>Ganti Password</h1>
				<h4>aortastan@sobatkode.com ?</h4>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-at"></i>
					</div>
					<div>
						<h5>Masukkan Password Baru</h5>
						<input type="text" class="input">
					</div>
				</div>
				<div class="input-div two">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div>
						<h5>Ulangi Password</h5>
						<input type="password" class="input">
					</div>
				</div>
				<input type="submit" class="btn" value="Ganti Password">
			</form>
		</div>
	</div>

	<script src="<?= base_url('assets/User/'); ?>js/login.js"></script>
</body>

</html>
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
			<img src="<?= base_url('assets/User/'); ?>images/forgot_password.svg">
		</div>
		<div class="login-container">
			<form action="<?= base_url('User/forgot_password'); ?>" method="POST">
				<h3>Anda Lupa Password?</h3>
				<?= $this->session->flashdata('message'); ?>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-at"></i>
					</div>
					<div>
						<h5>Masukkan Email Dulu</h5>
						<input type="text" class="input" id="email" name="email">
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-user btn-block">CEK EMAIL</button>
				<a href="<?= base_url(); ?>login">Sudah Ingat Password? Kembali ke login</a>
			</form>
		</div>
	</div>

	<script src="<?= base_url('assets/User/'); ?>js/login.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
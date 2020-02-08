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
			<img src="<?= base_url('assets/User/'); ?>images/regist.svg">
		</div>
		<!-- <?= form_error(
					'username',
					'<div class="alert alert-success" role="alert"><strong>',
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
				); ?>
		<?= form_error(
			'email',
			'<div class="alert alert-success" role="alert"><strong>',
			'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
		); ?>
		<?= form_error(
			'password1',
			'<div class="alert alert-success" role="alert"><strong>',
			'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
		); ?> -->
		<div class="login-container">
			<form method="POST" action="<?= base_url('User/registration'); ?>">
				<h2>REGISTRASI</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div>
						<h5>Username</h5>
						<input type="text" class="input" id="username" name="username" value="<?= set_value('username'); ?>">
					</div>
				</div>
				<div class="input-div two">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div>
						<h5>Nama Lengkap</h5>
						<input type="text" class="input" id="name" name="name" value="<?= set_value('name'); ?>">
					</div>
				</div>
				<div class="input-div three">
					<div class="i">
						<i class="fas fa-at"></i>
					</div>
					<div>
						<h5>Email</h5>
						<input type="text" class="input" id="email" name="email" value="<?= set_value('email'); ?>">
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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
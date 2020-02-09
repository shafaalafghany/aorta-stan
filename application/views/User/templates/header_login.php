<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $judul; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/animate.css">

  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/magnific-popup.css">

  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/aos.css">

  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/ionicons.min.css">

  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/jquery.timepicker.css">


  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/flaticon.css">
  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/icomoon.css">
  <link rel="stylesheet" href="<?= base_url('assets/User/'); ?>css/style.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/User/'); ?>css/pop-up.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-4	">
      <a class="navbar-brand" href="<?= base_url(); ?>">Try Out Online</a>
      <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button> -->

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="<?= base_url('Member/'); ?>" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="<?= base_url('Member/'); ?>tryout_member" class="nav-link">Try Out</a></li>
          <li class="nav-item"><a href="<?= base_url('Member/'); ?>testimoni_member" class="nav-link">Testimoni</a></li>
          <li class="nav-item"><a href="<?= base_url('Member/'); ?>contact_member" class="nav-link">Contact</a></li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown">
              <div class="user-panel d-flex">
                <div class="image">
                  <img src="../../../../assets/User/images/user2.png" class="img-circle" alt="User Image">
                </div>
                <div class="info">
                  <span><?= $user['name']; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-item dropdown-header">
                <img src="../../../../assets/User/images/user2.png" class="img-circle elevation-2" alt="User Image">
                <br>
                <p>
                  <span>Selamat Datang</span>
                  <br>
                  <span><?= $user['name']; ?></span>
                </p>
              </div>
              <div class="dropdown-divider"></div>
              <div class="dropdown-item dropdown-footer">
                <a href="#" class="btn btn-primary">Edit Profile</a>
                <a href="<?= base_url('User/logout') ?>" class="btn btn-danger right">Log out</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->
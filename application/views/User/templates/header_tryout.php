<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $judul; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="shortcut icon" type="text/css" href="<?= base_url('assets/User/'); ?>images/logo.ico">

  <link rel="stylesheet" href="<?= base_url('assets/Admin/') ?>plugins/fontawesome-free/css/all.min.css">

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
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-4	">
      <a class="navbar-brand" href="<?= base_url(); ?>">AORTA STAN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span>
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <?php if (!empty($user)) { ?>
            <li class="nav-item"><a href="<?= base_url('User/'); ?>" class="nav-link">Home</a></li>
            <li class="nav-item active"><a href="<?= base_url('User/'); ?>tryout" class="nav-link">Try Out</a></li>
            <li class="nav-item"><a href="<?= base_url('User/'); ?>testimoni" class="nav-link">Testimoni</a></li>
            <li class="nav-item"><a href="<?= base_url('User/'); ?>contact" class="nav-link">Contact</a></li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown">
                <div class="user-panel d-flex">
                  <div class="image">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-circle" alt="User Image" style="width: 37px; height: 37px; margin-right: 6px;">
                  </div>
                  <div class="info">
                    <span><?= $user['name']; ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-item dropdown-header">
                  <div class="image" style="text-align: center;">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-circle elevation-2" alt="User Image" style="width: 100px; height: 100px;">
                  </div>
                  <br>
                  <p style="text-align: center;">
                    <span>Selamat Datang</span>
                    <br>
                    <span style="font-size: 20px;"><strong><?= $user['name']; ?></strong></span>
                  </p>
                </div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-item dropdown-footer" style="text-align: center;">
                  <a href="<?= base_url('User/profile_saya') ?>" class="btn btn-primary">Profile Saya</a>
                  <a href="<?= base_url('User/logout') ?>" class="btn btn-danger right logout">Log out</a>
                </div>
              </div>
            </li>
          <?php } else { ?>
            <li class="nav-item"><a href="<?= base_url(); ?>" class="nav-link">Home</a></li>
            <li class="nav-item active"><a href="<?= base_url(); ?>tryout" class="nav-link">Try Out</a></li>
            <li class="nav-item"><a href="<?= base_url(); ?>testimoni" class="nav-link">Testimoni</a></li>
            <li class="nav-item"><a href="<?= base_url(); ?>contact" class="nav-link">Contact</a></li>
            <li class="nav-item cta mr-md-1"><a href="<?= base_url(); ?>login" class="nav-link" id="nav-login">Login</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
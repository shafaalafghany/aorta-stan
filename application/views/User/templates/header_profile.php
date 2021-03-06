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
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/User/'); ?>css/card.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-4	">
      <a class="navbar-brand" href="<?= base_url(); ?>">Try Out Online</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span>
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <?php if (!empty($user)) { ?>
            <?php if ($user['role_id'] == 3) { ?>
              <li class="nav-item"><a href="<?= base_url('User/'); ?>" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="<?= base_url('User/'); ?>tryout" class="nav-link">Try Out</a></li>
              <li class="nav-item"><a href="<?= base_url('User/'); ?>topup" class="nav-link">Top Up</a></li>
              <li class="nav-item"><a href="<?= base_url('User/'); ?>testimoni" class="nav-link">Testimoni</a></li>
              <li class="nav-item"><a href="<?= base_url('User/'); ?>contact" class="nav-link">Contact</a></li>
              <li class="nav-item" style="align-self: center;"><a href="<?= base_url('User/logout'); ?>" class="btn btn-danger logout">Log out</a></li>
            <?php }
            else {
              redirect('Administrator');
            } ?>
          <?php } else {
            redirect('User');
          } ?>
          
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->
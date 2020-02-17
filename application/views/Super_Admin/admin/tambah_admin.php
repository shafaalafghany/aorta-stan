<?php if (!empty($user)) {
  if ($user['role_id'] == 1) { ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>Administrator" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Modul
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Administrator/') ?>daftar_modul" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Modul</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Administrator/') ?>tambah_modul" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Modul</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekap Data Modul</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-week"></i>
              <p>
                Event
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Administrator/') ?>daftar_event" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Event</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Administrator/') ?>daftar_soal" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Soal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Administrator/') ?>tambah_event" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Event</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Administrator/') ?>tambah_soal" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Tambah Soal</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>
                Data Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Administrator/') ?>daftar_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Administrator/') ?>tambah_admin" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekap Data Admin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Peserta
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Administrator/') ?>daftar_peserta" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Peserta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekap Data Peserta</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">PENGATURAN</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Tools
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Back Up Database</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">AKUN</li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>Administrator/profile_admin" class="nav-link">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Profile Saya
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>User/logout" class="nav-link logout">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Log out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      </div>
    <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tambah Administrator</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Formulir Tambah Admin</h3>
              </div>
              <?= form_error(
                'username',
                '<div class="alert alert-danger" role="alert"><strong>',
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
              ); ?>
              <?= form_error(
                'email',
                '<div class="alert alert-danger" role="alert"><strong>',
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
              ); ?>
              <?= form_error(
                'password1',
                '<div class="alert alert-danger" role="alert"><strong>',
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
              ); ?>

              <form method="POST" action="<?= base_url('Super_Admin/tambah_admin'); ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" id="username" class="form-control" name="username" value="<?= set_value('username'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputName">Nama</label>
                    <input type="text" id="name" class="form-control" name="name" value="<?= set_value('name'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" id="email" class="form-control" name="email" value="<?= set_value('email'); ?>">
                  </div>
                  <!-- <div class="form-group">
            <label for="inputStatus">Status</label>
            <select class="form-control custom-select">
              <option selected disabled>Select one</option>
              <option>On Hold</option>
              <option>Canceled</option>
              <option>Success</option>
            </select>
          </div> -->
                  <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" id="password1" class="form-control" name="password1">
                  </div>
                  <div class="form-group">
                    <label for="inputUlangiPassword">Ulangi Password</label>
                    <input type="password" id="password2" class="form-control" name="password2">
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary float-right swalDefaultSuccess">Tambah Admin</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2019 <a href="http://sobatkode.com">Sobatkode</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/Admin/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/User/'); ?>js/sweetalert2.all.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/Admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url('assets/Admin/') ?>plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/Admin/') ?>dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('assets/Admin/') ?>dist/js/demo.js"></script>

    <script src="<?= base_url('assets/User/'); ?>js/logout.js"></script>
    </body>

    </html>
  <?php }
} else{
  redirect('User/login');
} ?>
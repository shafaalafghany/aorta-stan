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
              <a href="<?= base_url('Administrator/') ?>daftar_admin" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Admin</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Administrator/') ?>tambah_admin" class="nav-link">
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
              <h1>Daftar Admin</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Administrator</h3>
              </div>

              <!-- /.card-body -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Admin</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($admin as $loadAdmin) { ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $loadAdmin['name']; ?></td>
                        <td><?= $loadAdmin['email']; ?></td>
                        <td><?php if ($loadAdmin['is_active'] == 1) {
                              echo "Aktif";
                            } else {
                              echo "Tidak Aktif";
                            } ?></td>
                        <td class="project-actions text-center">
                          <a class="btn btn-primary btn-sm" href="#">
                            <i class="fas fa-folder">
                            </i>
                            View
                          </a>
                          <a class="btn btn-danger btn-sm" href="<?= base_url(); ?>Administrator/hapus_admin/<?= $loadAdmin['id']; ?>">
                            <i class="fas fa-trash">
                            </i>
                            Delete
                          </a>
                        </td>
                      </tr>
                    <?php $i++;
                    } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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
    <!-- DataTables -->
    <script src="<?= base_url('assets/Admin/') ?>plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets/Admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/Admin/') ?>dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('assets/Admin/') ?>dist/js/demo.js"></script>

    <script src="<?= base_url('assets/User/'); ?>js/logout.js"></script>
    <!-- page script -->
    <script>
      $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
        });
      });
    </script>
    </body>

    </html>
<?php }
} else {
  redirect('User/login');
} ?>
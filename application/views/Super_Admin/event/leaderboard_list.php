<?php if (!empty($user)) { ?>
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
        </ul>
      </li>
      <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
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
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('Administrator/') ?>leaderboard" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Leaderboard</p>
            </a>
          </li>
        </ul>
      </li>
      <?php if ($user['role_id'] == 1) { ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
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
              <a href="<?= base_url('Administrator/') ?>tambah_admin" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Admin</p>
              </a>
            </li>
          </ul>
        </li>
      <?php } ?>
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
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('Administrator/') ?>testimoni" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Testimoni</p>
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
            <a href="<?= base_url('Administrator/') ?>topup" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Setting Top Up</p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('Administrator/') ?>backup" class="nav-link">
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
            <h1>Leaderboard</h1>
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
              <h3 class="card-title">Leaderboard List</h3>
            </div>

            <!-- /.card-body -->
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Nama Event</label>
                <input type="text" id="inputName" class="form-control" disabled="disabled" value="<?= $event['nama_event'] ?>">
              </div>
              
              <?php if ($leader) { ?>
                <a class="btn btn-danger btn-sm float-right reset-ulang-event" href="<?= base_url('Administrator/'); ?>reset_data_event/<?= $event['id_event']; ?>">
                  <i class="fas fa-trash">
                  </i>
                  Reset Ulang Semua Peserta
                </a>
              <?php } ?>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nilai TPA</th>
                    <th>Nilai TBI</th>
                    <th>Nilai SKD</th>
                    <th>Nilai Total</th>
                    <?php if ($soalPsiko) { ?>
                      <th scope="col">Nilai Psikotes</th>
                    <?php } ?>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($leader as $loadLeader) { ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <?php 
                        $id_leader = $loadLeader['id_leaderboard'];
                        $nama = $this->db->query("SELECT u.name from user u join leaderboard l on u.id = l.id_user where l.id_leaderboard = $id_leader")->row()->name; ?>
                      <td><?= $nama; ?></td>
                      <td><?= $loadLeader['nilai_tpa']; ?></td>
                      <td><?= $loadLeader['nilai_tbi']; ?></td>
                      <td><?= $loadLeader['nilai_skd']; ?></td>
                      <td><?= $loadLeader['nilai_total']; ?></td>
                      <?php if ($soalPsiko) { ?>
                        <?php if ($loadLeader['nilai_psikotes'] == null) { ?>
                          <td>Belum Mengerjakan</td>
                        <?php } else { ?>
                          <td><?= $loadLeader['nilai_psikotes']; ?></td>
                        <?php } ?>
                      <?php } ?>
                      <td><?= $loadLeader['status']; ?></td>
                      <td class="project-actions text-center">
                        <a class="btn btn-primary btn-sm" href="<?= base_url('Administrator/'); ?>leader_detail/<?= $event['id_event']; ?>/<?= $loadLeader['id_leaderboard']; ?>">
                          <i class="fas fa-folder">
                          </i>
                          View
                        </a>
                        <!-- <a class="btn btn-danger btn-sm delete_peserta" href="#">
                          <i class="fas fa-trash">
                          </i>
                          Delete
                        </a> -->
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/Admin/') ?>plugins/jquery/jquery.min.js"></script>

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

      $('.delete_peserta').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
          title: 'Anda Yakin',
          text: "Ingin menghapus member ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.value) {
            Swal.fire(
              'Berhasil',
              'Akun telah dihapus',
              'success'
            ).then((result) => {
              document.location.href = href;
            })
          }
        })
      });
      
      $('.reset-ulang-event').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
          title: 'Anda Yakin',
          text: "Ingin mereset semua peserta dalam event ini? Dengan klik tombol yakin, maka semua peserta dalam event ini akan hilang.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.value) {
            Swal.fire(
              'Berhasil',
              'Semua data peserta berhasil direset',
              'success'
            ).then((result) => {
              document.location.href = href;
            })
          }
        })
      });
    });
  </script>
  </body>

  </html>
<?php } else {
  redirect('User/login');
} ?>
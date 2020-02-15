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
              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
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
                    <a href="<?= base_url('Administrator/') ?>tambah_modul" class="nav-link active">
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
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rekap Data Admin</p>
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
              <h1>Tambah Modul</h1>
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
                <h3 class="card-title">Isi formulir dulu yuk!</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Judul Modul</label>
                  <input type="text" id="inputName" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputStatus">Jenis Modul</label>
                  <select class="form-control custom-select">
                    <option selected disabled>Pilih Salah Satu</option>
                    <option>TKD</option>
                    <option>Bhs. Inggris</option>
                    <option>Matematika</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputProjectLeader">Deskripsi</label>
                  <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <input type="submit" value="Submit" class="btn btn-primary float-right swalDefaultSuccess">
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
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
  <!-- SweetAlert2 -->
  <script src="<?= base_url('assets/Admin/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="<?= base_url('assets/Admin/') ?>plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/Admin/') ?>dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url('assets/Admin/') ?>dist/js/demo.js"></script>

  <script src="<?= base_url('assets/User/'); ?>js/logout.js"></script>

  <script type="text/javascript">
    $(function () {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500
      });

      $('.swalDefaultSuccess').click(function() {
        Toast.fire({
          type: 'success',
          title: 'Satu modul berhasil ditambahkan, bisa dilihat pada daftar modul'
        })
      });
    });
  </script>
  </body>
  </html>
<?php } else{
  redirect('User/login');
} ?>
<?php if (!empty($user)) { ?>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview menu-open">
        <a href="<?= base_url() ?>Administrator" class="nav-link active">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>5</h3>

                <p>Modul Terpublikasi</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-open"></i>
              </div>
              <a href="<?= base_url('Administrator/') ?>daftar_modul" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>3</h3>

                <p>Event Dibuat</p>
              </div>
              <div class="icon">
                <i class="far fa-calendar"></i>
              </div>
              <a href="<?= base_url('Administrator/') ?>daftar_event" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>5</h3>

                <p>Administrator</p>
              </div>
              <div class="icon">
                <i class="fas fa-users-cog"></i>
              </div>
              <?php if ($user['role_id'] == 1) { ?>
                <a href="<?= base_url('Administrator/') ?>daftar_admin" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } else { ?>
                <a href="#" class="small-box-footer">Just Info <i class="fas fa-arrow-circle-right"></i></a>
              <?php } ?>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>40</h3>

                <p>Peserta Aktif</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?= base_url('Administrator/') ?>daftar_peserta" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/Admin/') ?>dist/img/avatar5.png" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $user['name']; ?></h3>

                <?php if ($user['role_id'] == 1) { ?>
                  <p class="text-muted text-center">Ketua Administrator</p>
                <?php } else { ?>
                  <p class="text-muted text-center">Administrator</p>
                <?php } ?>


                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Username</b> <a class="float-right"><?= $user['username']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right" style="font-size: 13px;"><?= $user['email']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Tgl Dibuat</b> <a class="float-right" style="font-size: 13px;">1 Februari 2020</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tentang Saya</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-user-graduate mr-1"></i> Riwayat Pendidikan</strong>

                <p class="text-muted">
                  TK Deket Rumah, SDN 1 Maju, SMPN 1 Jaya, SMAN 1 Selalu
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Lokasi</strong>

                <p class="text-muted">Jawa Timur, Indonesia</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Keahlian</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">Adobe Illustrator,</span>
                  <span class="tag tag-success">C++,</span>
                  <span class="tag tag-info">Javascript,</span>
                  <span class="tag tag-warning">PHP,</span>
                  <span class="tag tag-primary">Java</span>
                </p>

                <hr>

                <strong><i class="far fa-star mr-1"></i> Qoutes Of The Day</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#deskripsi" data-toggle="tab">Deskripsi</a></li>
                  <li class="nav-item"><a class="nav-link" href="#edit_profile" data-toggle="tab">Edit Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#edit_tentangsaya" data-toggle="tab">Edit Tentang Saya</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="deskripsi">
                    <!-- Post -->
                    <div class="post">
                      <h3><strong>Halo <?= $user['name']; ?></strong></h3>
                      <br>
                      <?php if ($user['role_id'] == 1) { ?>
                        <div class="callout callout-info">
                          <h5><i class="fas fa-info"></i> Note:</h5>
                          Anda adalah Super Admin yang memiliki kuasa paling tinggi, anda dapat menambah modul, menambah admin,
                          menambah event, backup data-data dan backup database.
                        </div>
                      <?php } else { ?>
                        <div class="callout callout-info">
                          <h5><i class="fas fa-info"></i> Note:</h5>
                          Anda adalah Admin dalam sistem try out AORTASTAN ini, anda dapat menambah modul, menambah event, backup data-data dan backup database.
                        </div>
                      <?php } ?>
                      <br>
                      <h5><i class="far fa-star mr-1"></i>Qoutes Of The Day</h5>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.
                      </p>
                      <hr>
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="edit_profile">
                    <form action="Administrator/index" method="POST" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama*</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputUsername" class="col-sm-2 col-form-label">Username*</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email*</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password1" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password1" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password2" class="col-sm-2 col-form-label">Ulangi Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password2" placeholder="Ulangi Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputFile" class="col-sm-2 col-form-label">Ganti Foto</label>
                        <div class="input-group col-sm-10">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                            <label class="custom-file-label" for="image">Choose file</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-10">
                          <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="edit_tentangsaya">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputEducation" class="col-sm-2 col-form-label">Riwayat Pendidikan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputEducation"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputLocation" class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputLocation"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Keahlian</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputSkills"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputQoutes" class="col-sm-2 col-form-label">Qoutes Of The Day</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputQoutes"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
<?php } else { ?>
<?php redirect('User/login');
} ?>
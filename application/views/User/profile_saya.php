    <div class="hero-wrap" style="background-image: url(<?= base_url('assets/User/'); ?>images/bg_1.jpg); width: 100%; height: 300px;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text">
          <div class="col-md-12 ftco-animate text-center" style="margin-top: 11%;">
            <h1 class="mb-3 bread">Profile Saya</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pt">
      <div class="container">
        <div class="row">
          <div class="category-wrap ftco-animate mr-3 image-profile" style="margin-left: 41%; margin-top: -7%;">
            <div class="text-center">
              <img class="image-profile" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="User Image">
            </div>
          </div>
          <div class="col-md-12 ftco-animate">
            <div class="heading-section text-center">
              <h2><strong><?= $user['name']; ?></strong></h2>
            </div>
            <div>
              <h6 style="color: black;" class="text-center">
                <span><strong>Terdaftar sejak <?= date("j M Y", strtotime($user['date_created'])); ?></strong></span>
              </h6>
            </div>
            <div class="text-center">
              <span class="mr-2"><i class="far fa-envelope"></i></span>
              <span><?= $user['email'] ?></span>
              <br>
              <span class="mr-2"><i class="fas fa-phone"></i></span>
              <span><?= $user['telepon'] ?></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <?= $this->session->flashdata('message'); ?>

    <section class="ftco-section ftco-no-pt">
      <div class="container">
        <div class="row-card">
          <div class="column-card ftco-animate">
            <div class="card card-profile">
              <div class="card-body text-center">
                <h1 class="card-text" style="color: #ffffff;"><strong><?= $user['point'] ?></strong></h1>
                <h2 class="card-text" style="color: #ffffff;"><strong> POINT </strong></h2>
              </div>
            </div>
          </div>
          <div class="column-card ftco-animate">
            <div class="card card-profile">
              <div class="card-body text-center">
                <h1 class="card-text" style="color: #ffffff;"><strong><?= count($transaksi); ?></strong></h1>
                <h2 class="card-text" style="color: #ffffff;"><strong> EVENT </strong></h2>
              </div>
            </div>
          </div>
          <div class="column-card ftco-animate">
            <div class="card card-profile">
              <div class="card-body text-center">
                <h1 class="card-text" style="color: #ffffff;"><strong><?= count($modul); ?></strong></h1>
                <h2 class="card-text" style="color: #ffffff;"><strong> MODUL </strong></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="ftco-section ftco-no-pt">
      <div class="container">
        <div class="row ftco-animate">
          <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Tentang Saya</a>
              <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Ubah Profile</a>
            </div>
          </div>
          <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <h4 style="margin-bottom: 20px;"><strong>Tentang Saya</strong></h4>
                <p><?= $user['tentang']; ?></p>
              </div>
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <h4 style="margin-bottom: 20px;"><strong>Pengaturan Profile Akun</strong></h4>
                <?= form_open_multipart('User/profile_saya'); ?>
                <!-- <form action=" //base_url('User/profile_saya'); " method="POST" enctype="multipart/form-data"> -->
                <div class="form-group col-md-12">
                  <label>Foto Diri</label>
                  <br>
                  <div style="display: flex;">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" style="width: 150px; height: 150px; margin-right: 40px;">
                    <div style="display: all; margin-top: 4%">
                      <label>Foto Profile sebaiknya memiliki rasio 1:1 dan tidak lebih dari 2MB.</label>
                      <input type="file" id="image" name="image" accept="image/*">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Nama*</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                </div>
                <div class="form-group">
                  <label>Username*</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Email*</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>No.HP*</label>
                  <input type="number" class="form-control" id="telepon" name="telepon" value="<?= $user['telepon']; ?>">
                </div>
                <div class="form-group">
                  <label>Tentang Saya</label>
                  <textarea cols="5" rows="4" class="form-control" id="tentang" name="tentang"><?= $user['tentang']; ?></textarea>
                </div>
                <div class="form-group" style="text-align: right;">
                  <button type="submit" class="btn btn-primary py-2 px-4">Simpan Perubahan</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
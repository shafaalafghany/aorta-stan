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
          <div class="category-wrap ftco-animate mr-3 image-profile" style="margin-left: 2%;">
            <div class="text-center">
              <img class="image-profile" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="User Image">
            </div>
          </div>
          <div class="col-md-7 ftco-animate">
            <div class="heading-section">
              <h2><?= $user['name']; ?></h2>
            </div>
            <div>
              <p style="color: black;">
                <span>Terdaftar sejak 20 Januari 2020</span>
              </p>
            </div>
            <div>
              <span class="mr-2"><i class="far fa-envelope"></i></span>
              <span><?= $user['email'] ?></span>
              <br>
              <span class="mr-2"><i class="fas fa-phone"></i></span>
              <span>+62 81234567890</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-no-pt">
      <div class="container">
        <div class="row-card">
          <div class="column-card ftco-animate">
            <div class="card card-profile">
              <div class="card-body text-center">
                <h4 class="card-title">Mendapatkan</h4>
                <h3 class="card-text"><?= $user['point'] ?></h3>
                <h2 class="card-text">Points</h2>
              </div>
            </div>
          </div>
          <div class="column-card ftco-animate">
            <div class="card card-profile">
              <div class="card-body text-center">
                <h4 class="card-title">Mengikuti</h4>
                <h3 class="card-text">2</h3>
                <h2 class="card-text">Event</h2>
              </div>
            </div>
          </div>
          <div class="column-card ftco-animate">
            <div class="card card-profile">
              <div class="card-body text-center">
                <h4 class="card-title">Mempelajari</h4>
                <h3 class="card-text">2</h3>
                <h2 class="card-text">Modul</h2>
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
              <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-topup" role="tab" aria-controls="v-pills-messages" aria-selected="false">Top Up Point</a>
            </div>
          </div>
          <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <h4 style="margin-bottom: 20px;"><strong>Tentang Saya</strong></h4>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <h4 style="margin-bottom: 20px;"><strong>Pengaturan Profile Akun</strong></h4>
                <?php echo form_open_multipart('User/profile_saya'); ?>
                <div class="form-group col-md-12">
                  <label>Foto Diri</label>
                  <br>
                  <div style="display: flex;">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" style="width: 150px; height: 150px; margin-right: 40px;">
                    <div style="display: all; margin-top: 4%">
                      <form action="/action_page.php">
                        <label>Foto Profile sebaiknya memiliki rasio 1:1 dan tidak lebih dari 2MB.</label>
                        <input type="file" id="image" name="image" accept="image/*">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Nama*</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                </div>
                <div class="form-group">
                  <label>Username*</label>
                  <input type="text" class="form-control" id="username" name="usernam" value="<?= $user['username']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Email*</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
                <div class="form-group" style="text-align: right;">
                  <button type="submit" class="btn btn-primary py-2 px-4">Simpan Perubahan</button>
                </div>
                </form>
              </div>
              <div class="tab-pane fade" id="v-pills-topup" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <h4 style="margin-bottom: 20px;"><strong>Top Up dulu yuk!!</strong></h4>
                <div class="job-post-item p-4 d-block d-lg-flex align-items-center">
                  <div class="one-third mb-4 mb-md-0">
                    <div class="job-post-item-header align-items-center">
                      <h2 class="mr-3 text-black"><i class="fas fa-star mr-3"></i>TOP UP 50 POINT</h2>
                    </div>
                    <div class="job-post-item-body d-block d-md-flex">
                      <div class="mr-3" toggle="Waktu Pelaksanaan">
                        <span><i class="fas fa-money-bill-wave mr-1"></i></span>
                        <span>Rp 50.000</span>
                      </div>
                    </div>
                  </div>

                  <div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
                    <a href="#" class="btn btn-primary py-2">Top Up</a>
                  </div>
                </div>
                <div class="job-post-item p-4 d-block d-lg-flex align-items-center">
                  <div class="one-third mb-4 mb-md-0">
                    <div class="job-post-item-header align-items-center">
                      <h2 class="mr-3 text-black"><i class="fas fa-star mr-3"></i>TOP UP 100 POINT</h2>
                    </div>
                    <div class="job-post-item-body d-block d-md-flex">
                      <div class="mr-3" toggle="Waktu Pelaksanaan">
                        <span><i class="fas fa-money-bill-wave mr-1"></i></span>
                        <span>Rp 100.000</span>
                      </div>
                    </div>
                  </div>

                  <div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
                    <a href="#" class="btn btn-primary py-2">Top Up</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
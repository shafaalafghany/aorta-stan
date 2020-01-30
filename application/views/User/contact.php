    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
          <div class="col-md-12 ftco-animate text-center mb-5">
            <p class="breadcrumbs mb-0"><span class="mr-3"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact</span></p>
            <h1 class="mb-3 bread">Contact us</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h3">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3">
            <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
          </div>
          <div class="col-md-3">
            <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Website</span> <a href="#">yoursite.com</a></p>
          </div>
        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form action="#" class="bg-white p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>

          </div>

          <div class="col-md-6 d-flex">
            <div id="map" class="bg-white"></div>
          </div>
        </div>
      </div>
    </section>

    <div class="bg-modal ftco-animate" id="modal-login">
      <div class="modal-content">
        <div class="close" id="close-login">+</div>
        <img src="<?= base_url('assets/User/'); ?>images/user2.png" class="avatar-img">
        <h2>Login</h2>

        <form>
          <div>
            <input type="email" id="email-login" required="">
            <label>Email</label>
          </div>
          <div>
            <input type="password" id="password-login" required="">
            <label>Password</label>
          </div>
          <input type="submit" name="" value="Login" id="btn-login">
          <a href="#" id="lupa-password">Lupa Password?</a>
          <p>Belum punya akun? <a href="#" id="registrasi">Klik Disini</a></p>
        </form>
      </div>
    </div>

    <div class="bg-modal ftco-animate" id="modal-registrasi">
      <div class="modal-content">
        <div class="close" id="close-regist">+</div>
        <h2>Registration</h2>

        <form>
          <div>
            <input type="text" id="nama-lengkap" required="">
            <label>Nama Lengkap</label>
          </div>
          <div>
            <input type="email" id="email-regist" required="">
            <label>Email</label>
          </div>
          <div>
            <input type="password" id="password-regist" required="">
            <label>Password</label>
          </div>
          <div>
            <input type="password" id="password-ulang-regist" required="">
            <label>Ulangi Password</label>
          </div>
          <input type="submit" name="" value="Daftar" id="btn-daftar">
          <p>Udah punya akun? <a href="#" id="kembali-login">Kembali ke login</a></p>
        </form>
      </div>
    </div>

    <div class="bg-modal ftco-animate" id="modal-lupa-password">
      <div class="modal-content">
        <div class="close" id="close-lupa-password">+</div>
        <h2>Anda Lupa Password?</h2>

        <form>
          <div>
            <input type="email" id="email-lupa" required="">
            <label>Masukin Email Dulu Yuk</label>
          </div>
          <input type="submit" name="" value="Cek Email" id="btn-cek-email">
          <p>Belum punya akun? <a href="#" id="lupa-keregist">Klik Disini</a></p>
        </form>
      </div>
    </div>

    <div class="bg-modal ftco-animate" id="modal-ganti-password">
      <div class="modal-content">
        <h2 class="ganti-password">Ganti Password</h2>
        <h6 id="email-user">sobatkode@gmail.com</h6>

        <form>
          <div>
            <input type="password" id="password-ganti" required="">
            <label>Masukkan Password Baru</label>
          </div>
          <div>
            <input type="password" id="password-ulang-ganti" required="">
            <label>Ulangi Password</label>
          </div>
          <input type="submit" name="" value="Ganti Password" id="btn-ganti-password">
        </form>
      </div>
    </div>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Skillhunt Jobboard</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Employers</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="pb-1 d-block">Browse Candidates</a></li>
                <li><a href="#" class="pb-1 d-block">Post a Job</a></li>
                <li><a href="#" class="pb-1 d-block">Employer Listing</a></li>
                <li><a href="#" class="pb-1 d-block">Resume Page</a></li>
                <li><a href="#" class="pb-1 d-block">Dashboard</a></li>
                <li><a href="#" class="pb-1 d-block">Job Packages</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Candidate</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="pb-1 d-block">Browse Jobs</a></li>
                <li><a href="#" class="pb-1 d-block">Submit Resume</a></li>
                <li><a href="#" class="pb-1 d-block">Dashboard</a></li>
                <li><a href="#" class="pb-1 d-block">Browse Categories</a></li>
                <li><a href="#" class="pb-1 d-block">My Bookmarks</a></li>
                <li><a href="#" class="pb-1 d-block">Candidate Listing</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Account</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="pb-1 d-block">My Account</a></li>
                <li><a href="#" class="pb-1 d-block">Sign In</a></li>
                <li><a href="#" class="pb-1 d-block">Create Account</a></li>
                <li><a href="#" class="pb-1 d-block">Checkout</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Have a Questions?</h2>
              <div class="block-23 mb-3">
                <ul>
                  <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                  <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
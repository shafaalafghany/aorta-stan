    <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row no-gutters slider-text align-items-end justify-content-start">
    			<div class="col-md-12 ftco-animate text-center mb-5">
    				<p class="breadcrumbs mb-0"><span class="mr-3"> Home <i class="ion-ios-arrow-forward"></i></span> <span>Testimoni</span></p>
    				<h1 class="mb-3 bread">Testimonial</h1>
    			</div>
    		</div>
    	</div>
    </div>

    <section class="ftco-section ftco-candidates ftco-candidates-2 bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-8 pr-lg-4">
    				<div class="row ftco-animate">

                        <?php foreach ($testimoni as $loadTestimoni) { ?>
                            <div class="col-md-12">
                                <div class="team d-md-flex p-4 bg-white">
                                    <div class="img">
                                        <img class="image-profile" src="<?= base_url('assets/img/profile/') . $loadTestimoni['image']; ?>" alt="User Image">
                                    </div>
                                    <div class="text pl-md-4" style="margin-top: 5%;">
                                        <h2><?= $loadTestimoni['nama_user']; ?></h2>
                                        <span class="position"><?= $loadTestimoni['subjek']; ?></span>
                                        <p class="mb-2"><?= $loadTestimoni['pesan']; ?></p>
                                        <span class="seen"><?php 
                                        $date = time() - $loadTestimoni['date_create'];
                                        if ($date >= 0 && $date < 60) {
                                            echo "Baru saja";
                                        } elseif ($date >= 60 && $date < 120) {
                                            echo "1 Menit yang lalu";
                                        } elseif ($date >= 120 && $date < 180) {
                                            echo "2 Menit yang lalu";
                                        } elseif ($date >= 180 && $date < 240) {
                                            echo "3 Menit yang lalu";
                                        } elseif ($date >= 240 && $date < 3600){
                                            echo "Beberapa menit yang lalu";
                                        } elseif ($date >= 3600 && $date < 7200) {
                                            echo "1 Jam yang lalu";
                                        } elseif ($date >= 7200 && $date < 10800) {
                                            echo "2 Jam yang lalu";
                                        } elseif ($date >= 10800 && $date < 86400) {
                                            echo "Beberapa Jam yang lalu";
                                        } elseif ($date >= 86400 && $date < 172800) {
                                            echo "Hari ini";
                                        } elseif ($date >= 172800 && $date < 259200) {
                                            echo "Kemarin";
                                        } elseif ($date >= 259200 && $date < 345600) {
                                            echo "2 Hari yang lalu";
                                        } elseif ($date >= 345600 && $date < 604800) {
                                            echo "Beberapa hari yang lalu";
                                        } elseif ($date >= 604800 && $date < 1209600) {
                                            echo "1 Minggu yang lalu";
                                        } elseif ($date >= 1209600 && $date < 2592000) {
                                            echo "Beberapa minggu yang lalu";
                                        } elseif ($date >= 2592000 && $date < 5184000) {
                                            echo "1 Bulan yang lalu";
                                        } elseif ($date >= 5184000) {
                                            echo "Berbulan-bulan yang lalu";
                                        } ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
    				</div>
    			</div>
                <?php if (!empty($user)) { ?>
                    <div class="col-lg-4 sidebar">
                      <div class="sidebar-box bg-white p-4 ftco-animate">
                        <h3 class="heading-sidebar"><strong>Berikan Testimoni Anda</strong></h3>
                        <form action="<?= base_url('User/'); ?>testimoni" method="post" class="contact-form mb-3">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" readonly>
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="inputEmail" name="inputEmail" value="<?= $user['email']; ?>" readonly>
                          </div>
                          <div class="form-group">
                            <label>Subject</label>
                            <input type="text" id="inputSubjek" name="inputSubjek" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Pesan</label>
                            <textarea id="inputPesan" name="inputPesan" cols="30" rows="7" class="form-control"></textarea>
                          </div>
                          <div class="form-group" style="text-align: center;">
                            <input type="submit" value="Submit" class="btn btn-primary py-2 px-4">
                          </div>
                        </form>

                      </div>
                    </div>
                <?php } 
                    else { ?>
                    <div class="col-lg-4 sidebar">
                      <div class="sidebar-box bg-white p-4 ftco-animate">
                        <h3 class="heading-sidebar"><strong>Berikan Testimoni Anda</strong></h3>
                        <form action="#" class="contact-form mb-3">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" disabled="disabled">
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" disabled="disabled">
                          </div>
                          <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Pesan</label>
                            <textarea name="" id="" cols="30" rows="7" class="form-control"></textarea>
                          </div>
                          <div class="form-group" style="text-align: center;">
                            <a href="<?= base_url('User/login') ?>" class="btn btn-warning py-2 px-4">Login Dulu</a>
                          </div>
                        </form>

                      </div>
                    </div>
                <?php } ?>
    		</div>
    	</div>
    </section>
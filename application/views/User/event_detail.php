    <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row no-gutters slider-text align-items-end justify-content-start">
    			<div class="col-md-12 ftco-animate text-center mb-5">
    				<p class="breadcrumbs mb-0"><span class="mr-3">Home <i class="ion-ios-arrow-forward"></i></span><span class="mr-3">Try Out <i class="ion-ios-arrow-forward"></i></span> <span>Event</span></p>
    				<h1 class="mb-3 bread">Event Detail</h1>
    			</div>
    		</div>
    	</div>
    </div>

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg">
    				<div class="row">
    					<div class="col-md-12 ftco-animate">
    						<div class="job-post-item p-4 d-block d-lg-flex align-items-center">
    							<div class="one-third mb-4 mb-md-0">
    								<div class="job-post-item-header align-items-center">
    									<span class="subadge">Try Out <?= $event['id_event'] ?></span>
    									<h2 class="mr-3 text-black"><?= $event['nama_event'] ?></h2>
    								</div>
    								<div class="job-post-item-body d-block d-md-flex">
    									<div class="mr-3" toggle="Waktu Pelaksanaan">
                                            <span><i class="far fa-clock mr-1"></i></span>
                                            <span><?= $event['tgl_mulai'] ?></span>
                                        </div>
                                        <div class="mr-3">
                                                <span><i class="fas fa-money-bill-wave mr-1"></i></span>
                                                <span><?= $event['harga'] ?> Point</span>
                                            </div>
    									<div>
                                            <span><i class="fas fa-layer-group mr-1"></i></span>
                                            <span><?= $event['tingkat'] ?></span>
                                        </div>
    								</div>
    							</div>

    							<div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
                                    <?php if (!empty($user)) { ?>
                                        <a href="<?= base_url('User/'); ?>tes_tpa/<?= $event['id_event']; ?>" class="btn btn-primary py-2 mulai-event">Mulai Event</a>
                                    <?php }
                                    else { ?>
                                        <a href="<?= base_url(); ?>login" class="btn btn-warning py-2 toLogin text-white">Login Dulu Yaa </a>
                                    <?php } ?>
    							</div>
    						</div>
    					</div><!-- end -->

                        <div class="col-md-12 ftco-animate">
                          <div class="job-post-item bg-white p-4 d-block">
                            <h2 class="mb-5"><strong>Detail Event</strong></h2>
                            <form action="#" class="contact-form mb-3">
                              <div class="form-group">
                                <label class="mb-3">Nama Event
                                <h4 class="mr-3"><?= $event['nama_event'] ?></h4></label>
                              </div>
                              <div class="form-group">
                                <label class="mb-3">Deskripsi 
                                    <h4 class="mr-3"><?= $event['deskripsi'] ?></h4></label>
                              </div>
                              <div class="form-group">
                                <label class="mb-3">Tingkat Try Out 
                                    <h4 class="mr-3"><?= $event['tingkat'] ?></h4></label>
                              </div>
                              <div class="form-group">
                                <label class="mb-3">Harga 
                                    <h4 class="mr-3"><?= $event['harga'] ?> Point</h4></label>
                              </div>
                              <div class="form-group">
                                <label class="mb-3">Durasi Pengerjaan Soal</label>
                                <br>
                                <div style="margin-left: 20px;">
                                    <label class="mr-3"><?= $topik_tpa['nama_topik_tes']; ?>
                                    <h4 class="mr-3"><?= $topik_tpa['waktu'] ?> menit</h4></label>
                                </div>
                                <div style="margin-left: 20px;">
                                    <label class="mr-3"><?= $topik_tbi['nama_topik_tes']; ?>
                                    <h4 class="mr-3"><?= $topik_tbi['waktu'] ?> menit</h4></label>
                                </div>
                                <div style="margin-left: 20px;">
                                    <label class="mr-3"><?= $topik_skd['nama_skd']; ?>
                                    <h4 class="mr-3"><?= $topik_skd['waktu'] ?> menit</h4></label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="mb-3">Tanggal Dimulai 
                                    <h4 class="mr-3"><?= $event['tgl_mulai'] ?></h4></label>
                              </div>
                              <div class="form-group">
                                <label class="mb-3">Tanggal Berakhir 
                                    <h4 class="mr-3"><?= $event['tgl_akhir'] ?></h4></label>
                              </div>
                            </form>

                          </div>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
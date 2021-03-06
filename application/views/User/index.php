    <!-- END nav -->
    <div class="hero-wrap img" style="background-image: url(<?= base_url('assets/User/'); ?>images/bg_1.jpg);">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row d-md-flex no-gutters slider-text align-items-center justify-content-center">
    			<div class="col-md-8 align-items-center ftco-animate">
    				<div class="text text-center">
    					<img src="<?= base_url('assets/User/'); ?>images/logo1-01.png" style="width: 230px; height: 230px;">
    					<p class="mb-2">Ayo Uji Latihan Kerasmu Disini!</p>
    					<h1 class="mb-4">Try Out Online Kedinasan STAN</h1>
    					<div class="ftco-counter ftco-no-pt ftco-no-pb">
    						<div class="row">
    							<div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
    								<div class="block-18 text-center">
    									<div class="text d-flex">
    										<div class="icon mr-2">
    											<span class="flaticon-worldwide"></span>
    										</div>
    										<div class="desc text-left">
    											<strong class="number" data-number="34">0</strong>
    											<span>Provinsi Di Indonesia</span>
    										</div>
    									</div>
    								</div>
    							</div>
    							<div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
    								<div class="block-18 text-center">
    									<div class="text d-flex">
    										<div class="icon mr-2">
    											<span class="flaticon-visitor"></span>
    										</div>
    										<div class="desc text-left">
    											<strong class="number" data-number="1000">0</strong>
    											<span>Lebih Participant</span>
    										</div>
    									</div>
    								</div>
    							</div>
    							<div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
    								<div class="block-18 text-center">
    									<div class="text d-flex">
    										<div class="icon mr-2">
    											<span class="flaticon-resume"></span>
    										</div>
    										<div class="desc text-left">
    											<strong class="number" data-number="500">0</strong>
    											<span>Lebih Soal Terbaik</span>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
    			<div class="col-md-7 heading-section text-center ftco-animate">
    				<span class="subheading">Event</span>
    				<h2 class="mb-0">Event Kami</h2>
    			</div>
    		</div>
            <div class="row">
                <?php foreach ($event as $loadEvent) : ?>
                    <div class="col-md-3 ftco-animate">
                        <ul class="category text-center">
                            <li><a href="<?= base_url('User/'); ?>event/<?= $loadEvent['id_event']; ?>"><?= $loadEvent['nama_event']?><br><span class="number"><?= date("j M Y", strtotime($loadEvent['tgl_mulai'])); ?></span><i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
    	</div>
    </section>

    <section class="ftco-section services-section">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
    				<div class="media block-6 services d-block">
    					<div class="icon"><span class="flaticon-resume"></span></div>
    					<div class="media-body">
    						<h3 class="heading mb-3">Ratusan Soal Dan Modul</h3>
    						<p>Banyak kumpulan soal tahun lalu.</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
    				<div class="media block-6 services d-block">
    					<div class="icon"><span class="flaticon-team"></span></div>
    					<div class="media-body">
    						<h3 class="heading mb-3">Trik-Trik Jitu Pengerjaan Soal</h3>
    						<p>Trik singkat dan cepat mengerjakan soal.</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
    				<div class="media block-6 services d-block">
    					<div class="icon"><span class="flaticon-career"></span></div>
    					<div class="media-body">
    						<h3 class="heading mb-3">Peringkat Se-Nasional</h3>
    						<p>Diranking dengan semua peserta seluruh Indonesia.</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
    				<div class="media block-6 services d-block">
    					<div class="icon"><span class="flaticon-employees"></span></div>
    					<div class="media-body">
    						<h3 class="heading mb-3">Uji Skill Dengan Ribuan Peserta</h3>
    						<p>Uji kemampuanmu dengan peserta lain diseluruh Indonesia.</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-9 pr-lg-5">
    				<div class="row justify-content-center pb-3">
    					<div class="col-md-12 heading-section ftco-animate">
    						<span class="subheading">Modul</span>
    						<h2 class="mb-4">Modul Materi Kami</h2>
    					</div>
    				</div>
    				<div class="row">

                        <?php 
                        $i = 1;
                        foreach ($modul as $loadModul) { ?>
                            <div class="col-md-12 ftco-animate">
                                <div class="job-post-item p-4 d-block d-lg-flex align-items-center">
                                    <div class="one-third mb-4 mb-md-0">
                                        <div class="job-post-item-header align-items-center">
                                            <span class="subadge">Modul <?= $i; ?></span>
                                            <h2 class="mr-3 text-black"><a href="#"><?= $loadModul['judul_modul']; ?></a></h2>
                                        </div>
                                        <div class="job-post-item-body d-block d-md-flex">
                                            <div class="mr-3"><span class="icon-layers mr-1"></span><?= $loadModul['deskripsi']; ?></div>
                                        </div>
                                    </div>

                                    <?php if ($user) { ?>
                                        <div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
                                            <a href="<?= base_url('User/'); ?>openModul/<?= $loadModul['id_modul']; ?>" class="btn btn-primary py-2" target="_blank">Lihat</a>
                                        </div>
                                    <?php } else{ ?>
                                        <div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
                                            <a href="<?= base_url('User/'); ?>login" class="btn btn-warning py-2">Login Dulu</a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div><!-- end -->
                        <?php $i++; } ?>
    					
    				</div>
    			</div>
    			<!-- <div class="col-lg-3 sidebar">
    				<div class="row justify-content-center pb-3">
    					<div class="col-md-12 heading-section ftco-animate">
    						<h2 class="mb-4">Top Recruitments</h2>
    					</div>
    				</div>
    				<div class="sidebar-box ftco-animate">
    					<div class="">
    						<a href="#" class="company-wrap"><img src="<?= base_url('assets/User/'); ?>images/company-1.jpg" class="img-fluid" alt="Colorlib Free Template"></a>
    						<div class="text p-3">
    							<h3><a href="#">Company Company</a></h3>
    							<p><span class="number">500</span> <span>Open position</span></p>
    						</div>
    					</div>
    				</div>
    				<div class="sidebar-box ftco-animate">
    					<div class="">
    						<a href="#" class="company-wrap"><img src="<?= base_url('assets/User/'); ?>images/company-2.jpg" class="img-fluid" alt="Colorlib Free Template"></a>
    						<div class="text p-3">
    							<h3><a href="#">Facebook Company</a></h3>
    							<p><span class="number">700</span> <span>Open position</span></p>
    						</div>
    					</div>
    				</div>
    			</div> -->
    		</div>
    	</div>
    </section>



    <section class="ftco-section testimony-section bg-primary">
    	<div class="container">
    		<div class="row justify-content-center mb-4">
    			<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
    				<span class="subheading">Testimonial</span>
    				<h2 class="mb-4">Testimoni Peserta</h2>
    			</div>
    		</div>
    		<div class="row ftco-animate">
    			<div class="col-md-12">
    				<div class="carousel-testimony owl-carousel ftco-owl">

                        <?php foreach ($testimoni as $loadTestimoni) { ?>
                            <div class="item" style="height: 200px;">
                            <div class="testimony-wrap py-4">
                                <div class="text">
                                    <p class="mb-4" style="color: #5b5353;"><?= $loadTestimoni['pesan'] ?></p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url(<?= base_url('assets/img/profile/') . $loadTestimoni['image']; ?>)"></div>
                                        <div class="pl-3">
                                            <p class="name"><?= $loadTestimoni['nama_user']; ?></p>
                                            <span class="number"><?= $loadTestimoni['subjek'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
    <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row no-gutters slider-text align-items-end justify-content-start">
    			<div class="col-md-12 ftco-animate text-center mb-5">
    				<p class="breadcrumbs mb-0"><span class="mr-3">Home <i class="ion-ios-arrow-forward"></i></span> <span>Try Out</span></p>
    				<h1 class="mb-3 bread">Event Try Out</h1>
    			</div>
    		</div>
    	</div>
    </div>

    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg">
    				<div class="row">
    					<?= $this->session->flashdata('message'); ?>
    					<?php foreach ($event as $loadEvent) : ?>
    						<div class="col-md-12 ftco-animate">
    							<div class="job-post-item p-4 d-block d-lg-flex align-items-center">
    								<div class="one-third mb-4 mb-md-0">
    									<div class="job-post-item-header align-items-center">
    										<span class="subadge">Try Out <?= $loadEvent['id_event'] ?></span>
    										<h2 class="mr-3 text-black"><?= $loadEvent['nama_event'] ?></h2>
    									</div>
    									<div class="job-post-item-body d-block d-md-flex">
    										<div class="mr-3" toggle="Waktu Pelaksanaan">
    											<span><i class="far fa-clock mr-1"></i></span>
    											<span><?= date("j M Y", strtotime($loadEvent['tgl_mulai'])); ?></span>
    										</div>
    										<div class="mr-3">
    											<span><i class="fas fa-money-bill-wave mr-1"></i></span>
    											<span><?= $loadEvent['harga'] ?> Point</span>
    										</div>
    										<div>
    											<span><i class="fas fa-layer-group mr-1"></i></span>
    											<span><?= $loadEvent['tingkat'] ?></span>
    										</div>
    									</div>
    								</div>

    								<div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
    									<a href="<?= base_url('User/'); ?>event/<?= $loadEvent['id_event']; ?>" class="btn btn-primary py-2">Ikuti Try Out</a>
    								</div>
    							</div>
    						</div><!-- end -->
    					<?php endforeach; ?>
    				</div>
    				<div class="row mt-5">
    					<div class="col text-center">
    						<div class="block-27">
    							<ul>
    								<li><a href="#">&lt;</a></li>
    								<li class="active"><span>1</span></li>
    								<li><a href="#">2</a></li>
    								<li><a href="#">3</a></li>
    								<li><a href="#">4</a></li>
    								<li><a href="#">5</a></li>
    								<li><a href="#">&gt;</a></li>
    							</ul>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
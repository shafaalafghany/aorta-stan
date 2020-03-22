    <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row no-gutters slider-text align-items-end justify-content-start">
    			<div class="col-md-12 ftco-animate text-center mb-5">
    				<p class="breadcrumbs mb-0"><span class="mr-3">Home <i class="ion-ios-arrow-forward"></i></span> <span>Top Up</span></p>
    				<h1 class="mb-3 bread">Top Up Point</h1>
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
										<span class="subadge">Top Up 50</span>
										<h2 class="mr-3 text-black">Top up point kamu 50</h2>
									</div>
									<div class="job-post-item-body d-block d-md-flex">
										<div class="mr-3">
											<span><i class="fas fa-money-bill-wave mr-1"></i></span>
											<span>Point</span>
										</div>
										<div>
											<span><i class="fas fa-layer-group mr-1"></i></span>
											<span><?= $loadEvent['tingkat'] ?></span>
										</div>
									</div>
								</div>

								<div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
									<a href="<?= base_url('User/'); ?>topup/<?= $loadEvent['id_event']; ?>" class="btn btn-primary py-2">Top Up</a>
								</div>
							</div>
						</div><!-- end -->
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
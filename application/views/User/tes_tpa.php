    <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row no-gutters slider-text align-items-end justify-content-start">
    			<div class="col-md-12 ftco-animate text-center mb-5">
    				<p class="breadcrumbs mb-0"><span class="mr-3">Home <i class="ion-ios-arrow-forward"></i></span><span class="mr-3">Try Out <i class="ion-ios-arrow-forward"></i></span> <span>Event</span></p>
    				<h1 class="mb-3 bread">Tes TPA</h1>
    			</div>
    		</div>
    	</div>
    </div>

    <section class="ftco-section bg-light" id="deskripsiTPA">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg">
					<div class="col-md-12 ftco-animate">
						<div class="job-post-item p-4" style="text-align: center;">
                            <table id="example1" class="table table-striped">
                              <tbody>
                                <tr>
                                  <td>
                                    <span class="subadge">Tes 1</span>
                                    <h4 class="mr-3 text-black">Tes <?= $topik['nama_topik'] ?></h4>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <span class="subadge">Durasi</span>
                                    <h4 class="mr-3 text-black"><?= $topik['durasi_topik'] ?></h4>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <span class="subadge">Point Benar</span>
                                    <h4 class="mr-3 text-black"><?= $topik_rule['jwbn_benar'] ?></h4>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <span class="subadge">Point Salah</span>
                                    <h4 class="mr-3 text-black"><?= $topik_rule['jwbn_salah'] ?></h4>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="col-md-12 text-center">
                                <a href="<?= base_url('User/'); ?>kerjakan_tpa/<?= $event['id_event']; ?>" class="btn btn-success" style="width: 100%; height: 100%;" id="mulai_tes">Kerjakan</a>
                            </div>
						</div>
					</div><!-- end -->
    			</div>
    		</div>
    	</div>
    </section>
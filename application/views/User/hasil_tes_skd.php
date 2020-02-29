    <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row no-gutters slider-text align-items-end justify-content-start">
    			<div class="col-md-12 ftco-animate text-center mb-5">
    				<p class="breadcrumbs mb-0"><span class="mr-3">Home <i class="ion-ios-arrow-forward"></i></span><span class="mr-3">Try Out <i class="ion-ios-arrow-forward"></i></span> <span>Event</span></p>
    				<h1 class="mb-3 bread">Hasil Tes</h1>
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
                      <span class="subadge">Hasil Tes</span>
                      <h4 class="mr-3 text-black"><?= $topik_skd['nama_skd']; ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="subadge">Skor Maksimal</span>
                      <h4 class="mr-3 text-black">SKD : <?= $topik_skd['maks_score'] ?></h4>
                      <h4 class="mr-3 text-black">TWK : <?= $topik_twk['maks_score'] ?></h4>
                      <h4 class="mr-3 text-black">TIU : <?= $topik_tiu['maks_score'] ?></h4>
                      <h4 class="mr-3 text-black">TKP : <?= $topik_tkp['maks_score'] ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="subadge">Passing Grade</span>
                      <h4 class="mr-3 text-black">SKD : <?= $topik_skd['ambang_score'] ?></h4>
                      <h4 class="mr-3 text-black">TWK : <?= $topik_twk['ambang_score'] ?></h4>
                      <h4 class="mr-3 text-black">TIU : <?= $topik_tiu['ambang_score'] ?></h4>
                      <h4 class="mr-3 text-black">TKP : <?= $topik_tkp['ambang_score'] ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="subadge">Score Anda</span>
                      <h4 class="mr-3 text-black">SKD : <?php $hasil = $hasil_twk['hasil'] + $hasil_tiu['hasil'] + $hasil_tkp['hasil']; echo $hasil; ?></h4>
                      <h4 class="mr-3 text-black">TWK : <?= $hasil_twk['hasil'] ?></h4>
                      <h4 class="mr-3 text-black">TIU : <?= $hasil_tiu['hasil'] ?></h4>
                      <h4 class="mr-3 text-black">TKP : <?= $hasil_tkp['hasil'] ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="subadge">Status SKD</span>
                      <h4 class="mr-3 text-black">
                        <?php if ($hasil < $topik_skd['ambang_score']) {
                          echo "TIDAK LULUS";
                        } else {
                          echo "LULUS";
                        }?>
                      </h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="subadge">Status TWK</span>
                      <h4 class="mr-3 text-black">
                        <?php if ($hasil_twk['hasil'] < $topik_skd['ambang_score']) {
                          echo "TIDAK LULUS";
                        } else {
                          echo "LULUS";
                        }?>
                      </h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="subadge">Status TIU</span>
                      <h4 class="mr-3 text-black">
                        <?php if ($hasil_tiu['hasil'] < $topik_skd['ambang_score']) {
                          echo "TIDAK LULUS";
                        } else {
                          echo "LULUS";
                        }?>
                      </h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="subadge">Status TKP</span>
                      <h4 class="mr-3 text-black">
                        <?php if ($hasil_tkp['hasil'] < $topik_skd['ambang_score']) {
                          echo "TIDAK LULUS";
                        } else {
                          echo "LULUS";
                        }?>
                      </h4>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="col-md-12 text-center">
                <a href="#" class="btn btn-success" style="width: 100%; height: 100%;" id="mulai_tes">Lihat Leaderboard</a>
              </div>
						</div>
					</div><!-- end -->
    			</div>
    		</div>
    	</div>
    </section>
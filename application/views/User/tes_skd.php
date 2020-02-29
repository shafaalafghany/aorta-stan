    <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-12 ftco-animate text-center mb-5">
                    <p class="breadcrumbs mb-0"><span class="mr-3">Home <i class="ion-ios-arrow-forward"></i></span><span class="mr-3">Try Out <i class="ion-ios-arrow-forward"></i></span> <span>Event</span></p>
                    <h1 class="mb-3 bread"><?= $topik_skd['nama_skd']; ?></h1>
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
                                  <span class="subadge">
                                    Tes 3
                                  </span>
                                  <h4 class="mr-3 text-black"><?= $topik_skd['nama_skd']; ?></h4>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="subadge">Durasi</span>
                                  <h4 class="mr-3 text-black"><?= $topik_skd['waktu']; ?> menit</h4>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="subadge">Jawaban Benar</span>
                                  <?php foreach ($klmpk_rule_skd as $kelompok_rule) { ?>
                                    <h4 class="mr-3 text-black"><?= $kelompok_rule['nama_topik_tes']; ?>  :  <?= $kelompok_rule['score_benar']; ?></h4>
                                  <?php } ?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="subadge">Jawaban Salah</span>
                                  <?php foreach ($klmpk_rule_skd as $kelompok_rule) { ?>
                                    <h4 class="mr-3 text-black"><?= $kelompok_rule['nama_topik_tes']; ?>  :  <?= $kelompok_rule['score_salah']; ?></h4>
                                  <?php } ?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="subadge">Jawaban Kosong</span>
                                  <?php foreach ($klmpk_rule_skd as $kelompok_rule) { ?>
                                    <h4 class="mr-3 text-black"><?= $kelompok_rule['nama_topik_tes']; ?>  :  <?= $kelompok_rule['score_kosong']; ?></h4>
                                  <?php } ?>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <span class="subadge">Point TKP</span>
                                    <h4 class="mr-3 text-black">Mulai paling tinggi 5, 4, 3, 2, 1 dan tidak menjawab 0</h4>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="col-md-12 text-center">
                              <a href="<?= base_url('User/'); ?>kerjakan_skd/<?= $user['id']; ?>/<?= $event['id_event']; ?>/3" class="btn btn-success" style="width: 100%; height: 100%;" id="mulai_tes">Kerjakan</a>
                          </div>
                        </div>
                    </div><!-- end -->
                </div>
            </div>
        </div>
    </section>
<?php if ($user) { ?>
   <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
          <div class="col-md-12 ftco-animate text-center mb-5">
            <p class="breadcrumbs mb-0"><span class="mr-3">Home <i class="ion-ios-arrow-forward"></i></span><span class="mr-3">Try Out <i class="ion-ios-arrow-forward"></i></span> <span>Event</span></p>
            <h1 class="mb-3 bread">Pilih Jurusan</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section bg-light" id="deskripsiTPA">
      <div class="container">
        <div class="row">
          <div class="col-lg">
          <div class="col-md-12 ftco-animate">
            <?= form_open_multipart('User/proses_jurusan/' . $user['id'] . '/' . $event['id_event']); ?>
              <div class="job-post-item p-4" style="text-align: center;">
                <?= $this->session->flashdata('message'); ?>
                <?php
                  for ($i=1; $i <= $event['jurusan']; $i++) { ?>
                    <div class="form-group">
                      <label for="optionJurusan">Jurusan <?= $i; ?></label>
                      <select class="custom-select col-md-12 mb-3" id="optionJurusan<?= $i; ?>" name="optionJurusan<?= $i; ?>">
                        <option value="0">Silahkan Dipilih....</option>
                        <option value="D3 Kebendaharaan Negara">Diploma 3 Kebendaharaan Negara</option>
                        <option value="D3 Manajemen Aset">Diploma 3 Manajemen Aset</option>
                        <option value="D1 Kebendaharaan Negara">Diploma 1 Kebendaharaan Negara</option>
                        <option value="D3 Pajak">Diploma 3 Pajak</option>
                        <option value="D3 PBB/Penilai">Diploma 3 PBB/Penilai</option>
                        <option value="D1 Pajak">Diploma 1 Pajak</option>
                        <option value="D3 Kepabeanan dan Cukai">Diploma 3 Kepabeanan dan Cukai</option>
                        <option value="D1 Kepabeanan dan Cukai">Diploma 1 Kepabeanan dan Cukai</option>
                        <option value="D3 Akuntansi">Diploma 3 Akuntansi</option>
                      </select>
                    </div>
                <?php } ?>
                <div class="col-md-12 text-center">
                  <input type="submit" value="Submit" class="btn btn-success" style="width: 100%; height: 100%;">
                </div>
              </div>
            </form>
          </div><!-- end -->
          </div>
        </div>
      </div>
    </section>
<?php } else{
  $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  redirect('User/login');
} ?>
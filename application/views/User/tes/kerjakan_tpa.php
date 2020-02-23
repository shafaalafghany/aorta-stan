    <style>
      .mySlides {display:none;}
    </style>

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

    <section class="ftco-section bg-light" id="soal1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pr-lg-4">
                    <div class="row ftco-animate">
                        <div class="col-md-12">

                          <?php 
                            $i = 1;
                            foreach ($soal as $loadSoal) { ?>
                            <div class="card mySlides" id="slide<?= $i; ?>" name="slide<?= $i; ?>">
                              <div class="card-header">
                                <h5>Soal No: <button type="button" class="btn btn-primary ml-2" style="width: 40px; height: 40px;"><?= $i ?></button></h5>
                              </div>
                              <div class="card-body">
                                <form class="questionForm" id="q1" data-question="1">
                                    <h4><?= $loadSoal['soal'] ?></h4>
                                    <br>
                                    <?php $jawaban = $this->db->get_where('jawaban', ['id_soal' => $loadSoal['id_soal']])->result_array(); ?>
                                    <?php 
                                      $j = 1;
                                      foreach ($jawaban as $jwb) { ?>
                                      <label class="btn btn-default">
                                        <input onclick="klikJwbn(<?= $i; ?>)" name="<?= $loadSoal['id_soal']; ?>" class="jawab" data-eve="<?= $event['id_event']; ?>" data-soal="<?= $loadSoal['id_soal']; ?>" data-idp="<?= $user['id']; ?>" data-jwb="<?= $jwb['id_jawaban']; ?>" type="radio" value="<?= $jwb['id_jawaban']; ?>"> <?= $jwb['jawaban']; ?>
                                      </label>
                                      <br>
                                    <?php $j++; } ?>
                                </form>
                              </div>
                              <div class="card-footer text-muted">
                                <button class="btn btn-info col-md-3 ml-2 mr-5 prev float-left" id="prev<?= $i; ?>" name="prev<?= $i; ?>" onclick="prevSoal(<?= $i; ?>)"><i class="fas fa-chevron-left"></i> Soal Sebelumnya</button>
                                <label class="btn btn-warning text-white col-md-3 ml-4"><input onclick="ragu(<?= $i; ?>);" type="checkbox" id="btn-ragu-<?= $i; ?>" name="btn-ragu-<?= $i; ?>"> Ragu-Ragu</label>
                                <button class="btn btn-primary col-md-3 ml-5 next float-right" id="next<?= $i; ?>" name="next<?= $i; ?>" onclick="nextSoal(<?= $i; ?>)">Soal Selanjutnya <i class="fas fa-chevron-right"></i></button>
                              </div>
                            </div>
                          <?php $i++; } ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 sidebar">
                  <div class="sidebar-box bg-white p-4 ftco-animate">
                    <h4 class="heading-sidebar mb-4">Daftar Soal</h4>
                    <form>
                      <?php $i = 1;
                        foreach ($soal as $loadSoal) { ?>
                            <button type="button" class="btn btn-outline-primary mr-4 mb-3 daftar-soal" id="nomor<?= $i; ?>" name="nomor<?= $i; ?>" style="width: 40px; height: 40px;" onclick="klikNomor(<?= $i; ?>)"><?= $i; ?></button>
                      <?php $i++; } ?>
                    </form>
                    <hr>
                    <a href="#" class="btn btn-success col-md-12">Submit Jawaban</a>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.easing.1.3.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.stellar.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.magnific-popup.min.js"></script>

    <script>
      var x = $('.mySlides');
      var maxIndex = x.length;
      var slideIndex = 1;
      showMaxDivs(maxIndex);
      showDivs(slideIndex);

      function showMaxDivs(n) {
        var i;
        var x = $('.mySlides');
        var next = $('.next');
        var prev = $('.prev');
        var ragu = $('.ragu');
        var nomor = $('.nomor');

        if (n == x.length) {next[maxIndex - 1].style.display = "none";}
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        x[maxIndex-1].style.display = "block";
      }

      function showDivs(n) {
        var i;
        var x = $('.mySlides');
        var next = $('.next');
        var prev = $('.prev');
        var ragu = $('.ragu');
        var nomor = $('.nomor');

        if (n == x.length) {next[maxIndex - 1].style.display = "none";}
        if (n == 1) {prev[slideIndex - 1].style.display = "none";}
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        x[slideIndex-1].style.display = "block";
      }

      function prevSoal(n) {
        var i;
        var x = $('.mySlides');

        for (var i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        $('#slide'+(n-1)).show();
      }

      function nextSoal(n) {
        var i;
        var x = $('.mySlides');
        var prev = $('.prev');
        var next = $('.next');

        if (n == x.length) {
          next.style.display = "none";
        }
        for (var i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        $('#slide'+(n+1)).show();
      }

      function ragu(e) {
        e.addAttr('checked="checked"');
        var checked = e.addAttr('checked="checked"');
        if (checked == true) {
          $('#nomor'+e).addClass('btn-warning');
        } else{
          $('#nomor'+e).removeClass('btn-warning');
        }
      }

      /*var j;
      var slide = $('.mySlides');
      var daftarSoal = $('.daftar-soal');
      var nomor = $('#nomor');

      for (var i = daftarSoal.length; i >= 1; i--) {
        $('#btn-ragu-'+i+"").on('click', function() {
            j = i+1;
            if ($(this).prop("checked") == true) {
              $('#nomor-'+j+"").removeClass('btn-outline-primary').addClass('btn-warning');
            } else if ($(this).prop("checked") == false) {
              $('#nomor-'+j+"").removeClass('btn-warning').addClass('btn-outline-primary');
            }
        });
      }*/

      function klikJwbn(e) {
        $('#nomor'+e).addClass('btn-primary');
      }

      function klikNomor(e) {
        var i;
        var x = $(".mySlides");
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        $('#slide'+e).show();
      }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
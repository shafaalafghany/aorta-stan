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
                            <div class="card mySlides">
                              <div class="card-header">
                                <h5>Soal No: <button type="button" class="btn btn-primary ml-2" style="width: 40px; height: 40px;"><?= $i ?></button></h5>
                              </div>
                              <div class="card-body">
                                <form class="questionForm" id="q1" data-question="1">
                                    <h4><?= $loadSoal['soal'] ?></h4>
                                    <br>
                                    <!-- <div class="custom-control custom-radio">
                                      <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                      <label class="custom-control-label" for="customRadio1">Sekolah Maju Kedepan</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                      <label class="custom-control-label" for="customRadio2">Sekolah Mundur Kebelakang</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                      <label class="custom-control-label" for="customRadio3">Sekolah Menengah Kejuruan</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                      <label class="custom-control-label" for="customRadio4">Sapi Makan Kerbau</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                      <label class="custom-control-label" for="customRadio5">Sapi Makan Kuda</label>
                                    </div> -->
                                    <label class="btn btn-default">
                                        <input type="radio" name="q1" value="a"> Sekolah Maju Kawan
                                    </label>
                                    <br>
                                    <label class="btn btn-default">
                                        <input type="radio" name="q1" value="b"> Sekolah Mundur Kawan
                                    </label>
                                    <br>
                                    <label class="btn btn-default">
                                        <input type="radio" name="q1" value="c"> Sekolah Menengah Kejuruan
                                    </label>
                                    <br>
                                    <label class="btn btn-default">
                                        <input type="radio" name="q1" value="d"> Sayang Mereka Kawan
                                    </label>
                                    <br>
                                    <label class="btn btn-default">
                                        <input type="radio" name="q1" value="e"> Semua Makan Kawan
                                    </label>
                                </form>
                              </div>
                              <div class="card-footer text-muted">
                                <button class="btn btn-info col-md-3 ml-2 mr-5 prev float-left" onclick="plusDivs(-1)"><i class="fas fa-chevron-left"></i> Soal Sebelumnya</button>
                                <label class="btn btn-warning text-white col-md-3 ml-4"><input type="checkbox" id="btn-ragu-<?= $i; ?>" name="btn-ragu"> Ragu-Ragu</label>
                                <button class="btn btn-primary col-md-3 ml-5 next float-right" onclick="plusDivs(1)">Soal Selanjutnya <i class="fas fa-chevron-right"></i></button>
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
                            <button type="button" class="btn btn-outline-primary mr-4 mb-3 daftar-soal" id="nomor-<?= $i; ?>" style="width: 40px; height: 40px;"><?= $i; ?></button>
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
      var slideIndex = 1;
      showDivs(slideIndex);

      function plusDivs(n) {
        showDivs(slideIndex += n);
      }

      function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var next = document.getElementsByClassName("next");
        var prev = document.getElementsByClassName("prev");
        var ragu = document.getElementsByClassName("ragu");
        var nomor = document.getElementsByClassName("nomor");

        if (n == x.length) {next[slideIndex - 1].style.display = "none";}
        if (n == 1) {prev[slideIndex - 1].style.display = "none";}
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        x[slideIndex-1].style.display = "block";
      }

      var j;
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
      }
    </script>
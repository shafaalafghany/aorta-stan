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
                                <label class="btn btn-warning text-white col-md-3 ml-4"><input type="checkbox" id="btn-ragu" name="btn-ragu"> Ragu-Ragu</label>
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
                      <?php for ($i=1; $i <=5; $i++) { ?>
                        <button type="button" class="btn btn-outline-primary mr-4 mb-3 nomor" style="width: 40px; height: 40px;"><?= $i; ?></button>
                      <?php } ?>
                    </form>
                    <hr>
                    <a href="#" class="btn btn-success col-md-12">Submit Jawaban</a>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

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
    </script>
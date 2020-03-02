<?php if ($user) { ?>
  <?php
$telah_berlalu = time() - $transaksi['waktu_daftar'];

$temp_waktu = ($topik['waktu'] * 60) - $telah_berlalu; //dijadikan detik dan dikurangi waktu yang berlalu
$temp_menit = (int)($temp_waktu / 60);               //dijadikan menit lagi
$temp_detik = $temp_waktu % 60;                       //sisa bagi untuk detik

if ($temp_menit < 60) {
    /* Apabila $temp_menit yang kurang dari 60 meni */
    $jam    = 0;
    $menit  = $temp_menit;
    $detik  = $temp_detik;
} else {
    /* Apabila $temp_menit lebih dari 60 menit */
    $jam    = (int)($temp_menit / 60);    //$temp_menit dijadikan jam dengan dibagi 60 dan dibulatkan menjadi integer 
    $menit  = $temp_menit % 60;           //$temp_menit diambil sisa bagi ($temp_menit%60) untuk menjadi menit
    $detik  = $temp_detik;
}
?>

    <style>
      .mySlides {display:none;}
    </style>

    <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg'); height: 300px;" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
          <div class="col-md-12 ftco-animate text-center mb-5">
            <p class="breadcrumbs mb-0"><span class="mr-3">Home <i class="ion-ios-arrow-forward"></i></span><span class="mr-3">Try Out <i class="ion-ios-arrow-forward"></i></span> <span>Event</span></p>
            <h1 class="mb-3 bread"><?= $topik['nama_topik_tes']; ?></h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section bg-light" id="tes">
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
                                <h5>Soal No: <button type="button" class="btn btn-primary ml-2" style="width: 45px; height: 45px;"><?= $i ?></button></h5>
                              </div>
                              <div class="card-body">
                                <form class="questionForm" id="q1" data-question="1">
                                    <h4><?= $loadSoal['soal'] ?></h4>
                                    <br>
                                    <?php $jawaban = $this->db->get_where('jawaban', ['id_soal' => $loadSoal['id_soal']])->result_array(); ?>
                                    <?php
                                      foreach ($jawaban as $jwb) : ?>
                                        <?php
                                          $query = $this->db->get_where('event_jawaban', [
                                            'id_user' => $user['id'],
                                            'id_topik' => $topik['id_topik_tes'],
                                            'id_event' => $event['id_event'],
                                            'id_soal' => $loadSoal['id_soal'],
                                            'id_jawaban' => $jwb['id_jawaban']
                                          ]);
                                          $checked = $query->row_array();

                                          if ($checked > 0) {
                                              $checked = 'checked="checked"';
                                          } else {
                                              $checked = '';
                                          }
                                        ?>
                                        <label class="btn btn-default">
                                          <input onchange="klikJwbn(<?= $i; ?>)" id="jwbnSoal<?= $i; ?>" name="jwbnSoal<?= $i; ?>" class="jawab" data-eve="<?= $event['id_event']; ?>" data-soal="<?= $loadSoal['id_soal']; ?>" data-idp="<?= $user['id']; ?>" data-jawaban="<?= $jwb['id_jawaban']; ?>" data-topik="<?= $topik['id_topik_tes']; ?>" type="radio" value="<?= $jwb['id_jawaban']; ?>" <?= $checked; ?>> <?= $jwb['jawaban']; ?>
                                        </label>
                                        <br>
                                    <?php endforeach; ?>
                                </form>
                              </div>
                              <div class="card-footer text-muted">
                                <button class="btn btn-info col-md-3 ml-2 mr-5 prev float-left" id="prev<?= $i; ?>" name="prev<?= $i; ?>" onclick="prevSoal(<?= $i; ?>)"><i class="fas fa-chevron-left"></i> Soal Sebelumnya</button>
                                <?php $jawaban = $this->db->get_where('jawaban', ['id_soal' => $loadSoal['id_soal']])->result_array(); ?>
                                    <?php
                                      foreach ($jawaban as $jwb) : ?>
                                        <?php
                                          $query = $this->db->get_where('event_jawaban', [
                                            'id_user' => $user['id'],
                                            'id_topik' => $topik['id_topik_tes'],
                                            'id_event' => $event['id_event'],
                                            'id_soal' => $loadSoal['id_soal']
                                          ]);
                                          $checked = $query->row_array();

                                          if ($checked > 0) {
                                            $query = $this->db->select('btn_ragu')->get_where('event_jawaban', [
                                              'id_user' => $user['id'],
                                              'id_topik' => $topik['id_topik_tes'],
                                              'id_event' => $event['id_event'],
                                              'id_soal' => $loadSoal['id_soal']
                                            ]);
                                            $check = $query->row()->btn_ragu;
                                            if ($check == 1) {
                                              $cek = 'checked="checked"';
                                              $ragu = 0;
                                            } elseif ($check == 0) {
                                              $cek = '';
                                              $ragu = 1;
                                            }
                                          } else{
                                            $ragu = 1;
                                            $cek = '';
                                          }
                                       endforeach; ?>
                                <label class="btn btn-warning text-white col-md-3 ml-4"><input class="btnRagu" type="checkbox" id="btn-ragu-<?= $i; ?>" name="btn-ragu-<?= $i; ?>" data-ragu="<?= $ragu; ?>" data-eve="<?= $event['id_event']; ?>" data-soal="<?= $loadSoal['id_soal']; ?>" data-idp="<?= $user['id']; ?>" data-topik="<?= $topik['id_topik_tes']; ?>" <?= $cek; ?>> Ragu-Ragu</label>
                                <button class="btn btn-primary col-md-3 ml-5 next float-right" id="next<?= $i; ?>" name="next<?= $i; ?>" onclick="nextSoal(<?= $i; ?>)">Soal Selanjutnya <i class="fas fa-chevron-right"></i></button>
                              </div>
                            </div>
                          <?php $i++; } ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 sidebar">
                  <div class="sidebar-box bg-white p-4 ftco-animate">
                    <h4 class="heading-sidebar mb-4">Daftar Soal<div class="float-right" id="timer"></div></h4>
                    <form>
                      <?php $i = 1;
                        foreach ($soal as $loadSoal) { ?>
                          <?php
                              $query = $this->db->get_where('event_jawaban', [
                                'id_user' => $user['id'],
                                'id_topik' => $topik['id_topik_tes'],
                                'id_event' => $event['id_event'],
                                'id_soal' => $loadSoal['id_soal']
                              ]);
                              $cek = $query->row_array();

                              if ($cek > 0) {
                                $query = $this->db->select('btn_ragu')->get_where('event_jawaban', [
                                  'id_user' => $user['id'],
                                  'id_topik' => $topik['id_topik_tes'],
                                  'id_event' => $event['id_event'],
                                  'id_soal' => $loadSoal['id_soal']
                                ]);
                                $check = $query->row()->btn_ragu;
                                if ($check == 1) {
                                  $cek = 'btn-warning';
                                } elseif ($check == 0) {
                                  $query = $this->db->select('id_jawaban')->get_where('event_jawaban', [
                                    'id_user' => $user['id'],
                                    'id_topik' => $topik['id_topik_tes'],
                                    'id_event' => $event['id_event'],
                                    'id_soal' => $loadSoal['id_soal']
                                  ]);
                                  $cekJwbn = $query->row()->id_jawaban;
                                  if ($cekJwbn > 0) {
                                    $cek = 'btn-success';
                                  } else{
                                    $cek = 'btn-outline-primary';
                                  }
                                }
                              } else {
                                $cek = 'btn-outline-primary';
                              }
                            ?>
                          <button type="button" class="btn <?= $cek; ?> mr-4 mb-3 daftar-soal" id="nomor<?= $i; ?>" name="nomor<?= $i; ?>" style="width: 40px; height: 40px;" onclick="klikNomor(<?= $i; ?>)"><?= $i; ?></button>
                      <?php $i++; } ?>
                    </form>
                    <hr>
                    <a href="<?= base_url('User/'); ?>koreksi/<?= $user['id']; ?>/<?= $event['id_event']; ?>/<?= $topik['id_topik_tes'] ?>" class="btn btn-success col-md-12 selesai">Submit Jawaban</a>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.easing.1.3.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.stellar.min.js"></script>
    <script src="<?= base_url('assets/User/'); ?>js/jquery.magnific-popup.min.js"></script>

    <script>

    $(document).ready(function() {
          /** Membuat Waktu Mulai Hitung Mundur Dengan 
           * var detik;
           * var menit;
           * var jam;
           */
          var detik = <?= $detik; ?>;
          var menit = <?= $menit; ?>;
          var jam = <?= $jam; ?>;

          /**
           * Membuat function hitung() sebagai Penghitungan Waktu
           */
          function hitung() {
              /** setTimout(hitung, 1000) digunakan untuk 
               * mengulang atau merefresh halaman selama 1000 (1 detik) 
               */
              setTimeout(hitung, 1000);

              /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
              if (menit < 10 && jam == 0) {
                  var peringatan = 'style="color:red"';
              };

              /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
              $('#timer').html(
                  '<span' + peringatan + '><i class="fas fa-timer border-primary" data-bs-hover-animate="swing"></i>' + jam + ' : ' + menit + ' : ' + detik + '<span>'
              );

              /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
              detik--;

              /** Jika var detik < 0
               * var detik akan dikembalikan ke 59
               * Menit akan Berkurang 1
               */
              if (detik < 0) {
                  detik = 59;
                  menit--;

                  /** Jika menit < 0
                   * Maka menit akan dikembali ke 59
                   * Jam akan Berkurang 1
                   */
                  if (menit < 0) {
                      menit = 59;
                      jam--;

                      /** Jika var jam < 0
                       * clearInterval() Memberhentikan Interval dan submit secara otomatis
                       */

                      if (jam < 0) {
                          clearInterval(hitung);
                          /** Variable yang digunakan untuk submit secara otomatis di Form */
                          var frmSelesai = $(".selesai").attr('href');
                          Swal.fire({
                            title: 'Waktu Habis!',
                            text: "Waktu pengerjaan soal sudah habis, silahkan tekan OK.",
                            icon: 'error'
                          }).then((result) => {
                            if (result.value) {
                              document.location.href = frmSelesai;
                            }
                          })
                      }
                  }
              }
          }
          /** Menjalankan Function Hitung Waktu Mundur */
          hitung();
      });

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

        if (n == x.length) {
          next[maxIndex - 1].style.display = "none";
          $('#nomor'+n).removeClass('active');
        }
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
        var daftarSoal = $('.daftar-soal');

        if (n == x.length) {next[maxIndex - 1].style.display = "none";}
        if (n == 1) {
          prev[slideIndex - 1].style.display = "none";
          $('#nomor'+n).addClass('active');
        }
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
        $('#nomor'+(n)).removeClass('active');
        $('#nomor'+(n-1)).addClass('active');
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
          $('#nomor'+i).removeClass('active');
        }
        $('#slide'+(n+1)).show();
        $('#nomor'+(n+1)).addClass('active');
      }

      $('.btnRagu').on('click', function() {
        var soal = $(this).data('soal');
        var idp = $(this).data('idp');
        var eve = $(this).data('eve');
        var topik = $(this).data('topik');
        var ragu = $(this).data('ragu');

        $.ajax({
            url: "<?= base_url('User/'); ?>ragu",
            data: {
                eve: eve,
                idp: idp,
                soal: soal,
                ragu: ragu,
                topik: topik
            },
            method: 'POST',
            dataType: 'json',
            success: function() {}
        });

        location.reload();
      });

      function klikJwbn(e) {
        $('#nomor'+e).removeClass('btn-outline-primary');
        $('#nomor'+e).addClass('btn-success');
      }

      $('.jawab').on('click', function() {

        var soal = $(this).data('soal');
        var jwb = $(this).data('jawaban');
        var idp = $(this).data('idp');
        var eve = $(this).data('eve');
        var topik = $(this).data('topik');

        $.ajax({
            url: "<?= base_url('User/'); ?>jawab",
            data: {
                eve: eve,
                idp: idp,
                soal: soal,
                jwb: jwb,
                topik: topik
            },
            method: 'POST',
            dataType: 'json',
            success: function() {}
        });
      });

      function klikNomor(e) {
        var i;
        var x = $(".mySlides");
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
          $('#nomor'+maxIndex).removeClass('active');
          $('#nomor'+i).removeClass('active');
        }
        $('#slide'+e).show();
        $('#nomor'+e).addClass('active');
      }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
<?php } else{
  $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  redirect('User/login');
} ?>
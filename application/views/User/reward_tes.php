    <!-- END nav -->
    <div class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url('assets/User/'); ?>images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row no-gutters slider-text align-items-end justify-content-start">
    			<div class="col-md-12 ftco-animate text-center mb-5">
    				<p class="breadcrumbs mb-0"><span class="mr-3">Home <i class="ion-ios-arrow-forward"></i></span><span class="mr-3">Try Out <i class="ion-ios-arrow-forward"></i></span> <span>Event</span></p>
    				<h1 class="mb-3 bread">Hasil Analisis Jurusan</h1>
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
    						<?php if ($leader['analisis_jurusan'] == "Tidak Masuk ke Jurusan") { ?>
                                <div class="job-post-item p-4 align-items-center" style="border-style: solid; border-width: 10px; border-color: black; background: url('../../assets/User/images/reward2.png'); background-repeat: no-repeat; background-size: 100% 100%; background-position: center; object-position: 0.5">
                                    <div class=" mb-4 mb-md-0">
                                        <div class="job-post-item-header text-center">
                                            <br><br>
                                            <h1 class="mr-3 text-black" style="font-family: CoolveticaRg Regular*; color: white; font-size: 50px;"><storng>MAAF</storng></h1>
                                        </div>
                                        <div class="text-center">
                                            <h1 style="font-family: CoolveticaRg Regular*; color: white; font-size: 60px;"><strong><?= $user['name']; ?></strong></h1>
                                            <h2 style="font-family: CoolveticaRg Regular*; color: white;"><strong>Berdasarkan hasil analisa dari Tim AORTASTAN,</strong></h2>
                                            <h2 style="font-family: CoolveticaRg Regular*; color: white;"><strong>nilai kamu belum mencukupi untuk masuk jurusan yang telah kamu pilih</strong></h2>
                                            <br>
                                            <h2 style="font-family: CoolveticaRg Regular*; color: white;"><strong>JANGAN PUTUS ASA DAN TETAP SEMANGAT!!!</strong></h2>
                                            <br><br><br>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="job-post-item p-4 align-items-center" style="border-style: solid; border-width: 10px; border-color: black; background: url('../../assets/User/images/reward.png'); background-repeat: no-repeat; background-size: 100% 100%; background-position: center; object-position: 0.5">
                                    <div class=" mb-4 mb-md-0">
                                        <div class="job-post-item-header text-center">
                                            <br><br><br><br><br><br>
                                            <h1 class="mr-3 text-black" style="font-family: CoolveticaRg Regular*;"><storng>SELAMAT</storng></h1>
                                        </div>
                                        <div class="text-center">
                                            <h3 style="font-family: CoolveticaRg Regular*;"><strong><?= $user['name']; ?></strong></h3>
                                            <h5 style="font-family: CoolveticaRg Regular*;"><strong>Berdasarkan hasil analisa dari Tim AORTASTAN,</strong></h5>
                                            <h5 style="font-family: CoolveticaRg Regular*;"><strong>nilai kamu telah dinyatakan LULUS untuk masuk jurusan</strong></h5>
                                            <h3 style="font-family: CoolveticaRg Regular*;"><strong><?= $leader['analisis_jurusan'] ?></strong></h3>
                                            <br><br><br>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
    					</div><!-- end -->
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
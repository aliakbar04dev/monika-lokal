<?= $this->extend('components/template_mobile') ?>
<?= $this->section('content_admin') ?>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<?php
					if ($lvl != 'MULV002' && $lvl != 'MULV004') {
					?>
						<div class="card mb-3">
							<div class="card-header">
								<h4 style="color: #fdc134;">Chart<samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
								<h5 class="pt-2" style="color: #000;">Technical Analysis</h5>
								<!-- <img class="pb-2 app" width="65%" alt="image" src="/public/assets/img/playstore.png"> -->
							</div>
							<div class="card-body pb-5" id="tempatgambar">
								<img id="defchartpic" alt="image" src="/public/assets/img/chartTA.png" style="width: 100%;">
								<div id="tempatchart">
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-body" style="background-color: #C1C1C1; border-radius:5px;">
								<form method="POST" id="mshowchart" class="needs-validation" novalidate="">
									<div class="row pb-3">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-lg-10 pt-2">
													<input id="commandchart" type="text" class="form-control" name="commandchart" placeholder="Input Command" required>
													<input id="kode" type="hidden" class="form-control" name="kode" value="<?= $lvl; ?>">
												</div>
												<div class="col-lg-2 pt-2">
													<button type="submit" style="width:auto;" class="boxed-save">
														Confirm
													</button>
												</div>
											</div>
										</div>
										<div class="col-lg-12 pt-4">
											<div class="row">
												<div class="col-lg-3 pt-2">
													<span>/cma = Chart PS Moving Average</span><br>
													<span>/cco = Chart PS Bumi Langit</span><br>
													<span>/cal = Chart PS Alligator</span><br>
													<span>/cah = Chart PS Good Swing</span><br>
													<span>/cas = Chart PS Ichimoku & Asing</span><br>
													<span>/cfn = Chart PS Spike Analizer</span><br>
												</div>
												<div class="col-lg-4 pt-2">
													<span>/ctl = Chart PS MultiTrendline</span><br>
													<span>/odt = Chart PS ODT / BSJP</span><br>
													<span>/psl = Chart PS Lover</span><br>
													<span>/cfr = Chart Performance Saham</span><br>
													<span>/aps = Chart Gerak Putar Saham</span><br>
												</div>
												<div class="col-lg-5 pt-2">
													<div class="alert alert-dark">
														 <samp>Contoh Perintah :</samp><br>
															<div class="col-lg-12">
																<samp>/cah05 untr = Chart UNTR 5 menit</samp><br>
																<samp>/cah15 untr = Chart UNTR 15 menit</samp><br>
																<samp>/cah30 untr = Chart UNTR 30 menit</samp><br>
																<!-- <samp>30m = 30 menit</samp><br> -->
																<samp>/cahhh untr = Chart UNTR Hourly</samp><br>
																<samp>/cahdd untr = Chart UNTR Daily</samp><br>
																<samp>/cahww untr = Chart UNTR Weekly</samp><br>
																<samp>/cahmm untr = Chart UNTR Monthly</samp><br>
															</div>
														<!-- <p class="att">Use both upper dan lowercase characters include at lease one
														symbol
														(#&^%$^^%etc) Don't use
														dictionary words</p> -->

														<!--
														<strong>Note : </strong>
														<samp>
															/cah tlkm w
														</samp><br>
														<samp>
															Keterangan : req chart cah, kode saham tlkm, interval weekly
														</samp> -->
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<samp>Daftar Interval :</samp><br>
											<div class="row">
												<div class="col-lg-3 pt-2">
													<span>/"Perintah"05 = 5 Menit</span><br>
													<span>/"Perintah"15 = 15 Menit</span><br>
													<span>/"Perintah"30 = 30 Menit</span><br>
												</div>
												<div class="col-lg-4 pt-2">
													<span>/"Perintah"hh = Hourly</span><br>
													<span>/"Perintah"dd = Daily</span><br>
													<span>/"Perintah"ww = Weekly</span><br>
													<span>/"Perintah"mm = Mountly</span><br>
												</div>
											</div>
										</div>
									</div>
								</form>

							</div>
						</div>
					<?php
					} else {
						echo $this->include('components/template_upgrade');
					}
					?>
				</div>
				<script>
					var demoTrigger = document.querySelector('.demo-trigger');

					new Drift(demoTrigger, {
						paneContainer: document.querySelector('.detail'),
						inlinePane: 900,
						inlineOffsetY: -85,
						containInline: true,
						sourceAttribute: 'href'
					});

					new Luminous(demoTrigger);
				</script>
            </div>
    </section>
</main>
<?= $this->endSection(); ?>
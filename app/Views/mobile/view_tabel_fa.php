<?= $this->extend('components/template_mobile') ?>
<?= $this->section('content_admin') ?>

<style>
	section {
		padding: 0px 0;
		overflow: hidden;
	}
</style>

<main class="body" id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<?php
					if ($lvl != 'MULV002' && $lvl != 'MULV003') {
					?>
						<div class="card mb-3">
							<div class="card-header">
								<h4 style="color: #fdc134; font-family:Poppins;">Tabel<samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
                				<h5 class="pt-2" style="color: #000; font-family:Poppins">Filter Analisa Fundamental</h5>
							</div>
							<div class="card-body">
								<div style="overflow-x:auto;">
									<img id="defchartpic" alt="image" src="/public/assets/img/chartTA.png" style="width: 100%;">

									<div id="tempattabel">
									</div>
									<!--
								<table class="table table-striped" id="table-1">
									<thead>
										<tr>
											<th>Ticker</th>
											<th>Date/Time</th>
											<th>Close</th>
											<th>Persen</th>
											<th>Peluang</th>
											<th>Continuation</th>
											<th>Value</th>
											<th>Spike Vol-1%</th>
											<th>Spike Vol %</th>
											<th>Stokastik</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>a</td>
											<td>b</td>
											<td>c</td>
											<td>d</td>
											<td>e</td>
											<td>f</td>
											<td>g</td>
											<td>e</td>
											<td>f</td>
											<td>g</td>
										</tr>

									</tbody>
								</table>-->
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body" style="background-color: #C1C1C1; border-radius:5px;">
								<form method="POST" id="mshowtablefa" class="needs-validation" novalidate="">
									<div class="row pb-3">
										<div class="col-sm-8">
											<div class="row">
												<div class="col-lg-10 pt-2">
													<!-- <input id="commandtable" type="text" class="form-control" name="commandtable" placeholder="Input Command" required> -->
													<select class="custom-select col-12" name="commandtable" id="commandtable" >
														<!-- <option value="" disabled selected hidden>Pilih Command</option> -->
															<!-- <option value="/fa pbv">/fa pbv</option>
															<option value="/fa pebv5">/fa pebv5</option>
															<option value="/fa grow">/fa grow</option>
															<option value="/fa bara ">/fa bara </option>
															<option value="/fa per">/fa per</option> -->
															<option value="/fa per">PER <= 10</option>
														<option value="/fa pbv">PBV <= 1</option>
														<option value="/fa der">DER <= 1</option>
														<option value="/fa roe">ROE >= 10%</option>
														<option value="/fa npm">NPM >= 10%</option>
														<option value="/fa peg">PEG <= 1</option>
													</select>
													<input id="kode" type="hidden" class="form-control" name="kode" value="<?= $lvl; ?>">
												</div>
												<div class="col-lg-2 pt-2 mt-3 text-center">
													<button type="submit" style="width:auto;" class="boxed-save">
														<b style="font-family:Poppins; color:white;">Kirim</b>
													</button>
												</div>
											</div>
											<div class="text-center mt-3">
												<p style="text-align:center; color:#D19200; font-family:Poppins; font-weight:bold; font-size:13px;">DAFTAR PERINTAH </p>
											</div>
										</div>
										<div class="col-sm-8 text-center mt-2">
											<div class="container" style="border: 3px solid white; padding: 10px; border-top-left-radius: 25px; border-top-right-radius: 25px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
												<table class="table table-bordered" style="border:none; font-family:Poppins;">
													<tr style="border:none;">
														<td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;"></td>
													</tr>   
													<tr style="border:none;">
														<td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">PER <= 10</b> &nbsp;&nbsp; = Saham murah di bawah PER <=10 </td>
													</tr>  
													<tr style="border:none;">
														<td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">PBV <= 1</b> &nbsp;&nbsp; = Saham murah di bawah PBV <=1</td>
													</tr>   
													<tr style="border:none;">
														<td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">DER <= 1</b> &nbsp;&nbsp; = Saham dengan Hutang lebih kecil dari Ekuitas</td>
													</tr>   
													<tr style="border:none;">
														<td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">ROE >= 10%</b> &nbsp;&nbsp; = Saham yang laba lebih dari 10% terhadap ekuitas</td>
													</tr>  
													<tr style="border:none;">
														<td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">NPM >= 10%</b> &nbsp;&nbsp; = Saham dengan Net Profit Margin diatas 10%</td>
													</tr>   
													<tr style="border:none;">
														<td style="border:none; text-align:left; height: 20px; color:black; font-size:12px;"><b style="color: #000;">PEG <= 1</b> &nbsp;&nbsp; = Saham dengan potensi pertumbuhan EPS</td>
													</tr>                          
												</table>
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
			</div>
    </section>
</main>
<?= $this->endSection(); ?>
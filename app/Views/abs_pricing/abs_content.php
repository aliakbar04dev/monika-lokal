<div class="container">
	<h4 style="margin-left: 80%; color: black;"><?= (strpos(strtoupper($d['title']), 'PAKET') !== false) ? strtoupper($d['title']) : 'PAKET ' . strtoupper($d['title']) ?></h4>
	<div class="row">
		<!-- card -->
		<div class="card mb-4" style="width: 100%;">
			<div class="row no-gutters">
				<div class="back-card col-md-3">
					<?php
					if ($d['title'] == 'Paket TA') { ?>
						<?= $this->include('abs_pricing/ta'); ?>
					<?php }
					if ($d['title'] == 'Paket FA') { ?>
						<?= $this->include('abs_pricing/fa'); ?>
					<?php }
					if ($d['title'] == 'Paket Ultimate') { ?>
						<?= $this->include('abs_pricing/ultimate'); ?>
					<?php } ?>
					<img src="<?= base_url() ?>/public/assets/img/pricing/logo-card.png" class="card-img custem-img-card-ah">
				</div>
				<div class="col-md-9">
					<form method="POST" id="formpembayaran" class="needs-validation">
						<div class="card-header">
							<?php
							if ($respay == 'yes') {
								echo '<h3 class="pt-2">MELANJUTKAN PEMBAYARAN</h3>';
							} else {
								echo '<h3 class="pt-2">PILIHAN PENAGIHAN</h3>';
							}
							?>
						</div>
						<p style="display:none" id="bulanval" value="<?= $d['harga_paket'] ?>"><?= rupiah($d['harga_paket']) ?>/bln</p>
						<p style="display:none" id="tahunval" value="<?= $d['harga_paket_tahunan'] ?>"><?= rupiah($d['harga_paket_tahunan']) ?>/thn</p>

						<div class="card-body">
							<input type="hidden" name="paket" value="<?= $d['kode_harga_paket'] ?>" />
							<input type="hidden" name="extnd" value="<?= $extnd ?>" />

							<?php
								if($respay != 'yes'){
							?>
								<div class="pb-4">
									<select id="langganan" name="langganan" class="pembelian-select">
										<option value="bulan">Periode Penagihan 1 Bulan <?= rupiah($d['harga_paket']) ?>,-</option>
										<option value="tigabulan">Periode penagihan 3 Bulan <?= rupiah($d['harga_paket']*3) ?>,-</option>
										<option value="enambulan">Periode penagihan 6 Bulan <?= rupiah($d['harga_paket']*6) ?>,-</option>
										<option value="tahun">Periode penagihan 12 Bulan <?= rupiah($d['harga_paket_tahunan']) ?>,-</option>
									</select>
								</div>
							<?php
								}else{
									if($langg == 'tahun'){
							?>
									<div class="pb-4">
										<select id="langganan" name="langganan" class="pembelian-select">
											<option value="tahun">Periode penagihan 12 Bulan <?= rupiah($d['harga_paket_tahunan']) ?>,-</option>
										</select>
									</div>
							<?php
									}else if($langg == 'bulan'){
							?>
									<div class="pb-4">
										<select id="langganan" name="langganan" class="pembelian-select">
											<option value="bulan">Periode Penagihan 1 Bulan <?= rupiah($d['harga_paket']) ?>,-</option>
										</select>
									</div>
							<?php
									}else if($langg == 'tigabulan'){
							?>
									<select id="langganan" name="langganan" class="pembelian-select">
										<option value="tigabulan">Periode penagihan 3 Bulan <?= rupiah($d['harga_paket']*3) ?>,-</option>
									</select>
							<?php
									}else if($langg == 'enambulan'){
							?>
									<select id="langganan" name="langganan" class="pembelian-select">
										<option value="enambulan">Periode penagihan 6 Bulan <?= rupiah($d['harga_paket']*6) ?>,-</option>
									</select>
							<?php
									}
								}
							?>
							
							<p class="tombol float-right">Rp. <span id="price">0</span>,-</p>
							<p class="tombol pt-1">Harga <?= (strpos(strtoupper($d['title']), 'PAKET') !== false) ? strtoupper($d['title']) : 'Paket ' . strtoupper($d['title']) ?></p>
							<p class="tombol float-right">Rp. 5.000,-</p>
							<p class="tombol pt-1">Biaya Admin</p>
							<p class="tombol float-right">Rp. <span id="afterdisc">0</span>,-</p>
							<p class="tombol pt-1" <?= ($jnis['kode_jenis_member'] != 'JMBR001' && $jnis['kode_jenis_member'] != '')? 'id="diskon"':'' ?>>Diskon</p>

							<?php
								if ($jnis['kode_jenis_member'] != 'JMBR001' && $jnis['kode_jenis_member'] != '') {

									if ($jnis['kode_jenis_member'] == 'JMBR002') {
										echo '<input type="hidden" id="discbulan" name="discbulan" value="' . $d['harga_koperasi'] . '">';
										echo '<input type="hidden" id="disctahun" name="disctahun" value="' . $d['harga_koperasi_tahunan'] . '">';
									} else if ($jnis['kode_jenis_member'] == 'JMBR003') {
										echo '<input type="hidden" id="discbulan" name="discbulan" value="' . $d['harga_komunitas'] . '">';
										echo '<input type="hidden" id="disctahun" name="disctahun" value="' . $d['harga_komunitas_tahunan'] . '">';
									} else if ($jnis['kode_jenis_member'] == 'JMBR004') {
										echo '<input type="hidden" id="discbulan" name="discbulan" value="' . $d['harga_dual'] . '">';
										echo '<input type="hidden" id="disctahun" name="disctahun" value="' . $d['harga_dual_tahunan'] . '">';
									}
								}
							?>

						</div>
						<div class="row ml-3 mb-3">
							<div class="col-lg-12">
								<div class="form-group col-12">
									<p>Referal Code</p>
									<div class="row">
										<div class="col-lg-6">
											<input style="outline: none;" id="referal" type="text" class="form-control" name="referal" placeholder="Optional / di isi jika ada" tabindex="1" autofocus value="<?= $koref ?>" <?= ($koref != '') ? 'disabled' : '' ?>>
										</div>
										<!-- <div class="col-lg-6"><button type="submit" class="boxed-basic">Check</button></div> -->
									</div>
								</div>
							</div>
						</div>

						<ul>
							<li class="list-group-item owh" style="background-color: #CBF4C8;">
								<h3 style="color:#358522;" class="pt-2 float-right">Rp <span style="color:#358522;" id="total">0</span>/<span style="color:#358522;" id="tblth">bln</span></h3>
								<h3 class="pt-2">Total</h3>
								<a>Ditagih Setiap <a id="bultah2">Bulan</a></a>
							</li>
						</ul>
						<div class="card-body">
							<li class="foot float-right">
								<h5>Please select a payment method :</h5>
							</li>
						</div>
						<div class="card-body" style="margin-top: -40px;">
							<div class="foot float-right">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" required>
									<label class="form-check-label" for="exampleRadios1">
										<h6>Credit Card / Mandiri Clickpay / Transfer ATM Bersama / Go-Pay / Alfamart</h6>
									</label>
								</div>
							</div>
						</div>
						<div class="card-body" style="margin-top: -40px;">
							<li class="foot float-right">
								<a href="<?= base_url('pricing') ?>" class="boxed-basic">Back To Selection</a> 
								<button type="submit" class="boxed-basic">Pay</button>
							</li>
						</div>
						<div class="card-body">
							<div class="accordion-wrapper" style="cursor: pointer;">
								<div class="acc-head card p-3">
									<a class="acc font pr-3" style="font-size: 20px; color: #432C1A; ">Cara pembayaran apa yang dapat diterima ?</a>
								</div>
								<div class="acc-body">
									<a style="font-size: 13px;">Kartu Kredit</a><br>
									ATM BCA<br>
									ATM Mandiri<br>
									Bank Transfer<br>
									Pembayaran lewat metode 1-4 tidak perlu melakukan konfirmasi. Akses Pro langsung terbuka setelah pembayaran dilaksanakan.</a>
								</div>
							</div>
							<div class="accordion-wrapper" style="cursor: pointer;">
								<div class="acc-head card p-3">
									<a class="acc font pr-3" style="font-size: 20px; color: #432C1A; ">Ada pertanyaan Lain ?</a>
								</div>
								<div class="acc-body">
									<a style="font-size: 13px;">Bisa kontak tim support kami lewat
										<a style="color: #E8A303;" href="mailto:support.monikas@panensaham.com"><u> support.monika@panensaham.com</u></a> atau kunjungin halaman Help kami untuk informasi terkait.
									</a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<img class="float-right" width="100%" src="<?= base_url() ?>/public/assets/img/pricing/gbr-chart.png">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
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
							<h3 class="pt-2">PILIHAN PENAGIHAN</h3>
						</div>
						<div class="card-body">
							<input type="hidden" name="paket" value="<?= $d['kode_harga_paket'] ?>" />
							<div class="icon d-inline">
								<p class="tombol float-right" id="tahunval" value="<?= $d['harga_paket_tahunan'] ?>"><?= rupiah($d['harga_paket_tahunan']) ?>/thn</p>
								<div class="custom-control custom-radio">
									<input type="radio" id="pertahun" name="langganan" value="tahun" class="custom-control-input" required>
									<label class="custom-control-label" for="pertahun">
										<p class="tombol"> Per Tahun</p>
									</label>
								</div>
							</div>
							<p>
								<!--Hemat 20% untuk pembayaran per tahun.-->Ditagih setiap tahun
							</p>
							<hr>
							<div class="icon d-inline">
								<p class="tombol float-right" id="bulanval" value="<?= $d['harga_paket'] ?>"><?= rupiah($d['harga_paket']) ?>/bln</p>
								<div class="custom-control custom-radio">
									<input type="radio" id="perbulan" name="langganan" value="bulan" class="custom-control-input" required>
									<label class="custom-control-label" for="perbulan">
										<p class="tombol"> Per Bulan</p>
									</label>
								</div>

							</div>
							<p>Pillihan yang tepat untuk mulai mencoba mempelajari tools kami. Ditagih setiap bulan </p>
						</div>

						<div class="card-body" style="border-top: 1px solid #E5E5E5;">
							<p class="tombol float-right">Rp. <span id="price">0</span>/bln</p>
							<p class="tombol pt-1"><span id="bultah">Bulanan</span> <?= (strpos(strtoupper($d['title']), 'PAKET') !== false) ? $d['title'] : 'Paket ' . $d['title'] ?></p>
							<p class="tombol float-right">Rp. 5.000</p>
							<p class="tombol pt-1"><span id="bultah">Biaya Admin</p>
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

							?>
								<p class="tombol float-right">Rp. <span id="afterdisc">0</span>/bln</p>
								<a class="pt-1" id="diskon">Diskon <?= $jnis['jenis_member'] ?></a>
								<span id="befdisc" class="float-right mr-3" style="color: #BD4244!important; letter-spacing: -1px; font-size: 17px; text-decoration: line-through #BD4244;"> Rp. 0 </span>
							<?php
							}
							?>

						</div>
						<div class="row ml-3 mb-3">
							<div class="col-lg-6">
								<div class="form-group col-12">
									<p>TEST</p>
									<input style="outline: none;" id="referal" type="text" class="form-control" name="referal" placeholder="Referal Code1" tabindex="1" autofocus value="<?= $koref ?>" <?= ($koref != '') ? 'disabled' : '' ?>>
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
							<li class="foot float-right"><button type="submit" class="boxed-basic">Pay</button></li>
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
										<a style="color: #E8A303;" href="mailto:cs.aps@panensaham.com"><u> cs.aps@panensaham.com</u></a> atau kunjungin halaman Help kami untuk informasi terkait.
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

<script>
</script>
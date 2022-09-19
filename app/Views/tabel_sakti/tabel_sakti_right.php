<div class="col-lg-9">
	<?php
		if ($lvl == 'MULV003' || $lvl == 'MULV005') {
    ?>
	<div class="card">
		<div class="card-header">
			<h4 style="color: #fdc134;">Tabel Sakti<samp style="border-left: 1px #bababa solid; margin-left: 10px;"></samp></h4>
			<h5 class="pt-2" style="color: #000;">Pilihan Tabel</h5>
		</div>
		<div class="card-body bg-sakti">
			<form method="POST" id="formtable">
				<div class="row pb-3">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-2">
								<div class="d-block pt-2">
									<label for="ex" class="control-label float-right">Jenis Tabel</label>
								</div>
							</div>
							<!--<div class="col-lg-8">
								<div id="a" class="wrapper-dropdown-a" tabindex="2">
									<span name="jnstable" id="jnstable">&nbsp;</span>
									<ul class="dropdown">
										<?php foreach ($jns as $j) : ?>
											<li value="<?= $j->kode_jenis_tsakti ?>"><a href="#"><?= $j->jenis_t_sakti ?></a></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>-->
							<div class="col-lg-10">
								<div tabindex="2">
									<select class="custom-select" name="jnstable" id="jnstable" data-placeholder="Select box" required>
										<?php
										foreach ($jns as $j) {
											echo '<option value="' . $j->kode_jenis_tsakti . '">' . $j->jenis_t_sakti . '</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row pb-3">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-2">
								<div class="d-block pt-2">
									<label for="startdate" class="control-label float-right">Tanggal Dari</label>
								</div>
							</div>
							<div class="col-lg-4">
								<input type="date" id="startdate" class="form-control" name="startdate" tabindex="2" required>
							</div>
							<div class="col-lg-2">
								<div class="d-block pt-2">
									<label for="enddate" class="control-label float-right">sampai</label>
								</div>
							</div>
							<div class="col-lg-4">
								<input type="date" id="enddate" class="form-control" name="enddate" tabindex="2" required>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="row pb-3">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-2">
									<div class="d-block pt-2">
										<label for="ex" class="control-label float-right">Sampai</label>
									</div>
								</div>
								<div class="col-lg-9">
									<input id="ex" type="text" class="form-control" name="ex" tabindex="2">
								</div>
							</div>
						</div>
					</div> -->
				<div class="row pb-3">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-1">
								<div class="d-block">
								</div>
							</div>
							<div class="col-lg-10">
								<button type="submit" style="width:auto;" class="boxed-save" tabindex="4">
									Cari
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="card-body">
			<div id="tempattabel">
			<table id="tablesaktiresult" style="font-size:12px;" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
					<thead>
						<tr>
							<th>Chart</th>
							<th>Tanggal</th>
							<th width="10">Ukuran</th>
							<th width="10" style="text-align: center;">Download</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if (!is_null($skti) && count($skti) > 0) {
								foreach ($skti as $d) {
									echo '<tr>
												<td>' . $d['judul_tsakti'] . '</td>
												<td>' . $d['tanggal_input'] . '</td>
												<td>' . $d['ukuran'] . '</td>
												<td><a href="#" id="tabledownload" value="' . $d['filename'] . '"><i class="fas fa-download"></i></a></td>
											</tr>';
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php
    } else {
        echo $this->include('components/template_upgrade');
    }
?>
</div>

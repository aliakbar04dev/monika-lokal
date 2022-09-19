<?= $this->extend('components/template_admin') ?>
    
<?= $this->section('content') ?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <!-- <h6 class="h2 text-white d-inline-block mb-0">Datatables</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="datatables.html#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="datatables.html#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Datatables</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-6 col-5 text-right">
              <!-- <a href="datatables.html#" class="btn btn-sm btn-neutral">New</a>
              <a href="datatables.html#" class="btn btn-sm btn-neutral">Filters</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt--6">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0">Detail Poin Reward</h3>
              <p class="text-sm mb-0">
                Menampilkan poin yang terkumpul peruser serta histori order
              </p>
			        <br>
            </div>
            <div class="table-responsive py-4">
			      <h4 class="text-center">Detail Poin Periode <?= date("d-m-Y", strtotime($start_date)); ?> 
				      sampai <?= date("d-m-Y", strtotime($end_date)); ?> ( <?= $kode; ?> ) </h4>
              <table class="table table-flush" id="datatable-featurespoin">
                <thead class="thead-light">
                    <tr>
                    <th>No</th>
					          <th>Nama Lengkap</th>
                    <th>Jenis Paket</th>
                    <th>Tanggal Pesan</th>
                    <th>Reward</th>
                    </tr>
                </thead>
                <tbody>
                   <?php 
                    $no = 0;
                    foreach($detail_poin as $item): 
                    $no++;
                  ?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $item->nama_lengkap; ?></td>
						<td><?= $item->title; ?></td>
						<td><?= date("d-m-Y", strtotime($item->insert_date)); ?></td>
						<td><?= $item->reward_poin . " Poin"; ?></td>
					</tr>
					<?php endforeach; ?>
                </tbody> 
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<?= $this->endSection(); ?>
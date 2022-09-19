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
              <h3 class="mb-0">Data Invoice</h3>
              <p class="text-sm mb-0">
                Data ini berisi informasi status tagihan beserta paket yang dipilih oleh user
              </p>
              <br>
              <?= form_open('/admbillinginvfilter', ['class' => 'formFilterbillinginv']); ?>
              <?= csrf_field(); ?>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Start date</label>
                    <input class="form-control datepicker" placeholder="Start date" type="text" 
                      value="<?= $start_date; ?>" name="billinginv_filterstdate" id="billinginv_filterstdate" required>
                    <div class="invalid-feedback bg-secondary errorFeaturesfilterstdate">test</div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">End date</label>
                    <input class="form-control datepicker" placeholder="End date" type="text" 
                     value="<?= $end_date ?>"  name="billinginv_filtereddate" id="billinginv_filtereddate" required>
                    <div class="invalid-feedback bg-secondary errorFeaturesfiltereddate">test</div>
                  </div>
                </div>
                <div class="col-md-4 pt-4">
                <button type="submit" class="btn btn-primary btn-sm mt-3 btnfilterbillinginv">
                  Filter Data
                </button>
                <?= form_close(); ?>
                <button type="button" class="btn btn-success btn-sm mt-3" data-toggle="modal" data-target="#modalexportbillinginv">Export Excel</button>
                </div>
              <!-- <button type="button" class="btn btn-primary btn-sm mt-3" 
                      data-toggle="modal" data-target="#modaltambahpackagedisc" onClick="generatekodepackagedisc()">
               <i class="fa fa-plus-circle"></i> Tambah Data
              </button> -->
            </div>
            <div class="table-responsive py-4">
              <h4 class="text-center" id="filterdate">Periode <?= date("d-m-Y", strtotime($start_date)); ?> sampai <?= date("d-m-Y", strtotime($end_date)); ?></h4>
              
              <table class="table table-flush" id="datatable-billinginvoice">
                <thead class="thead-light">
                    <tr>
                      <th>No</th>
                      <th>Tgl Terbit</th>
                      <th>Kode Pembayaran</th>
                      <th>ID User</th>
                      <th>Email</th>
                      <th>Kode Ref</th>
                      <th>Paket</th>
                      <th>Berlangganan</th>
                      <th>Total</th>
                      <th>Metode Pembayaran</th>
                      <th>Expire Date</th>
                      <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?= $this->include('menubilling/export_billinginvoice'); ?>
<?= $this->endSection(); ?>
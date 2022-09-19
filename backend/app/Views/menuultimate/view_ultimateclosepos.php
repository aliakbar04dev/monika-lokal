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
            <h3 class="mb-0">Copy Trades | Data Close Position</h3>
              <p class="text-sm mb-0">
                Berisi data close position yang akan ditampilkan pada menu copy trades difitur ultimate
              </p>
              <button type="button" class="btn btn-primary btn-sm mt-3" 
                      data-toggle="modal" data-target="#modaltambahultimateclosepos"
                      onClick="generatekodeultimateclosepos()">
               <i class="fa fa-plus-circle"></i> Tambah Data
              </button>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-ultimateclosepos">
                <thead class="thead-light">
                    <tr>
                    <th style="text-align: center;">#</th>
                    <th>Kode Saham</th>
                    <th>Buy Price</th>
                    <th>Sell Price</th>
                    <th>Buy Date</th>
                    <th>Sell Date</th>
                    <th>Profit</th>
                    <th>Days Hold</th>
                    <th>Active</th>
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
    
    <?= $this->include('menuultimate/add_ultimateclosepos'); ?>
    <?= $this->include('menuultimate/edit_ultimateclosepos'); ?>
<?= $this->endSection(); ?>
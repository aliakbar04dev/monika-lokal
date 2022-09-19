<?= $this->extend('components/template_admin') ?>
    
<?= $this->section('content') ?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"></div>
            <div class="col-lg-6 col-5 text-right"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt--6" style="overflow: hidden;">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0">Fact Sheet</h3>
              <p class="text-sm mb-0">
                Berisi data yang akan ditampilkan pada menu fact sheet di fitur copy trade
              </p>
              <button type="button" class="btn btn-primary btn-sm mt-3" data-toggle="modal" data-target="#modaltambahultimatefactsheet" onClick="generatekodeultimatefactsheet()">
               <i class="fa fa-plus-circle"></i> Tambah Data
              </button>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-ultimatefactsheet" style="width: 100%;">
                <thead class="thead-light">
                    <tr>
                    <th style="text-align: center; width: 1%;">#</th>
                    <th style="width: 1%;">No</th>
                    <th>Kode Fact Sheet</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <!-- <th>is active</th> -->
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
    
    <?= $this->include('menuultimate/add_ultimatefactsheet'); ?>
    <?= $this->include('menuultimate/edit_ultimatefactsheet'); ?>
    <?= $this->include('menuultimate/editpdf_ultimatefactsheet'); ?>
<?= $this->endSection(); ?>
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
          <h3 class="mb-0">Information | Data News & Events</h3>
          <p class="text-sm mb-0">
            Berisi kumpulan berita dan event berdasarkan kategorinya
          </p>
          <button type="button" class="btn btn-primary btn-sm mt-3" data-toggle="modal"
            data-target="#modaltambahinfonews" onClick="generatekodeinfonews()">
            <i class="fa fa-plus-circle"></i> Tambah Data
          </button>
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-infonews">
            <thead class="thead-light">
              <tr>
                <th style="text-align: center;">#</th>
                <th>No</th>
                <th>Tanggal Dibuat</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Status Berita</th>
                <th>Judul Berita</th>
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

<?= $this->include('menuinformation/add_infonews'); ?>
<?= $this->include('menuinformation/edit_infonews'); ?>
<?= $this->include('menuinformation/editgambar_infonews'); ?>
<?= $this->include('menuinformation/editcover_infonews'); ?>
<?= $this->endSection(); ?>
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
          <h3 class="mb-0">Information | Data Bursa & Emiten IPO</h3>
          <p class="text-sm mb-0">
            Berisi kumpulan informasi bursa dan emiten ipo berdasarkan kategorinya
          </p>
          <button type="button" class="btn btn-primary btn-sm mt-3" data-toggle="modal"
            data-target="#modaltambahinfobursaemiten" onClick="generatekodeinfobursaemiten()">
            <i class="fa fa-plus-circle"></i> Tambah Data
          </button>
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-infobursaemiten">
            <thead class="thead-light">
              <tr>
                <th style="text-align: center;">#</th>
                <th>Tgl Dibuat</th>
                <th>Jenis Berita</th>
                <th>Kategori Berita</th>
                <th>Status Berita</th>
                <th>Judul Berita</th>
                <th>Active</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
              <?php  foreach($dataResult as $result) : ?>
              <tr>
                <td>
                  <button type="button" class="btn btn-warning btn-sm btneditinfocategory" onclick="editinfobursaemiten('<?= $result['kode_pengumuman'] ?>')"><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-dark btn-sm" onclick="changepdfinfobursaemiten('<?= $result['kode_pengumuman'] ?>')"><i class="fa fa-file-pdf"></i></button>
                  <button type="button" class="btn btn-danger btn-sm" onclick="deleteinfobursaemiten('<?= $result['kode_pengumuman'] ?>')"><i class="fa fa-trash"></i></button>
                </td>
                <td><?= date("d/m/Y H:i", strtotime($result['tgl_pengumuman'])) ?></td>
                <td><?= $result['jenis_pengumuman'] ?></td>
                <td><?= $result['nama_kategori_pengumuman'] ?></td>
                <td>
                  <?php if ( $result['status'] == 'NEW' ) : ?>
                    <span class="badge badge-primary">NEW</span>
                  <?php elseif ($result['status'] == 'HOT'): ?>
                    <span class="badge badge-danger">HOT</span>
                  <?php else : ?>
                      -
                  <?php endif; ?>
                </td>
                <td><?= strlen($result['judul']) <= 40 ? substr($result['judul'], 0, 40) : substr($result['judul'], 0, 40). ' ...' ?></td>
                <td>
                  <?php if ( $result['is_active'] == 1 ) : ?>
                    <span style="color:#2dce89;">Active</span>
                  <?php else : ?>
                    <span style="color:#f5365c;">Not Active</span>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->include('menuinformation/add_infobursaemiten'); ?>
<?= $this->include('menuinformation/edit_infobursaemiten'); ?>
<?= $this->include('menuinformation/editgambar_infobursaemiten'); ?>
<?= $this->include('menuinformation/editpdf_infobursaemiten'); ?>
<?= $this->endSection(); ?>
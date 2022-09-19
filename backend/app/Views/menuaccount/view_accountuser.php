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
          <div class="row">
            <div class="col-6">
            <h3 class="mb-0">Data User</h3>
            <p class="text-sm">
              Berisi data akun yang memiliki status user
            </p>
            </div>
            <div class="col-6 text-right">
              <button type="button" class="btn btn-success btn-sm mt-3" data-toggle="modal" data-target="#modalexportuser">Export Excel</button>
            </div>
          </div>
        </div>
        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-accountuser">
            <thead class="thead-light">
              <tr>
                <th style="width: 5%; text-align:center;">#</th>
                <th>No</th>
                <th>Kode User</th>
                <th>User Level</th>
                <th>User Level Temp</th>
                <th>Jenis Member</th>
                <th>Username</th>
                <th>Client Id</th>
                <th>Email Anggota</th>
                <th>Nama lengkap</th>
                <th>Alamat email</th>
                <th>No Hp</th>
                <th>Kota</th>
                <th>Kode Referal</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tgl Lahir</th>
                <th>Website</th>
                <th>Alamat</th>
                <th>Tentang Saya</th>
                <th>Tgl Daftar</th>
                <th>Kode Verifikasi</th>
                <th>Kode Reset Password</th>
                <th>Expired Reset Password</th>
                <th>Is Verif</th>
                <th>Trial Expire</th>
                <th>Exp Date</th>
                <th>Exp Date Temp</th>
                <th>Regis No Hp</th>
                <th>Regis Otp</th>
                <th>Regis Otp Exp</th>
                <th>Ubah No Hp</th>
                <th>Phone Otp</th>
                <th>Phone Otp Exp</th>
                <th>Sesi Token</th>
                <th>Ubah Password</th>
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

<?= $this->include('menuaccount/edit_accountuser'); ?>
<?= $this->include('menuaccount/view_accountuserexport'); ?> 
<?= $this->endSection(); ?>
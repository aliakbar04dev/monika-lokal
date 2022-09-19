 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahcareerlocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Lokasi Pekerjaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('career/LocationcarController/simpandata', ['class' => 'formModaltambahcareerlocation']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Lokasi Pekerjaan</label>
                  <input class="form-control" type="text" placeholder="TLOP001" 
                        name="careerlocation_kode" id="careerlocation_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareerlocationKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infotype-input" class="form-control-label">Lokasi Pekerjaan</label>
                  <input class="form-control" type="text" placeholder="South Jakarta" 
                        name="careerlocation_nama" id="careerlocation_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareerlocationNama">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahCareerlocation">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
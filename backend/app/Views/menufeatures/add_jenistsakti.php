 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahfeaturesjenistsakti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jenis Tabel Sakti</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('features/jenistsakticontroller/simpandata', 
            ['class' => 'formModaltambahfeaturesjenistsakti']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Jenis Tabel Sakti</label>
                  <input class="form-control" type="text"  placeholder="JSAK001" 
                        name="featuresjenistsakti_kode" id="featuresjenistsakti_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenistsaktiKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Jenis Tabel Sakti</label>
                  <input class="form-control" type="text" placeholder="Weekly Chart" 
                        name="featuresjenistsakti_nama" id="featuresjenistsakti_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenistsaktiNama">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahfeaturesjenistsakti">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahfeaturesjenistsakti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jenis Tabel Sakti</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('features/jenistsakticontroller/perbaruidata', 
            ['class' => 'formModalubahfeaturesjenistsakti']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Jenis Tabel Sakti</label>
                  <input class="form-control" type="text"  placeholder="JSAK001" 
                        name="featuresjenistsakti_kodeubah" id="featuresjenistsakti_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenistsaktiKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Jenis Tabel Sakti</label>
                  <input class="form-control" type="text" placeholder="Weekly Chart" 
                        name="featuresjenistsakti_namaubah" id="featuresjenistsakti_namaubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenistsaktiNamaubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahfeaturesjenistsakti">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
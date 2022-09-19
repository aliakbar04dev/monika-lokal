 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahfilesfeaturestsakti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Tabel Sakti</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('features/tsakticontroller/perbaruifile', 
            ['class' => 'formModalubahfilesfeaturestsakti']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Tabel Sakti</label>
                  <input class="form-control" type="text"  placeholder="JSAK001" 
                        name="featurestsakti_kodeubahfile" id="featurestsakti_kodeubahfile" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturestsaktiKodeubahfile">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Files</label>
                  <input type="file" name="featurestsakti_filesubahfile" class="form-control" 
                    id="featurestsakti_filesubahfile" 
                  required accept=".xls, .xlsx, .pdf" /></p>
                  <div class="invalid-feedback bg-secondary errorFeaturestsaktiFilesubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahfilesfeaturestsakti">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahfeaturestsakti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Tabel Sakti</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('features/tsakticontroller/perbaruidata', 
            ['class' => 'formModalubahfeaturestsakti']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Tabel Sakti</label>
                  <input class="form-control" type="text"  placeholder="JSAK001" 
                        name="featurestsakti_kodeubah" id="featurestsakti_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturestsaktiKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Jenis Tabel</label>
                  <select class="form-control" id="featurestsakti_jenisubah" name="featurestsakti_jenisubah">
                    <?php foreach($jenis_tsakti as $item): ?>
                    <option value="<?= $item['kode_jenis_tsakti']; ?>">
                        <?= $item['jenis_t_sakti']; ?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Judul Tabel Sakti</label>
                  <input class="form-control" type="text" placeholder="Weekly Chart" 
                        name="featurestsakti_namaubah" id="featurestsakti_namaubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenistsaktiNamaubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Tanggal</label>
                  <input class="form-control datepicker" placeholder="Start date" type="text" 
						value="<?= date("m/d/Y"); ?>" name="featurestsakti_tanggalubah" id="featurestsakti_tanggalubah">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenistsaktiTanggalubah">testte</div>
                </div>

                <!-- <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Files</label>
                  <input type="file" name="featurestsakti_filesubah" class="form-control" 
                    id="featurestsakti_filesubah" 
                  required accept=".xls, .xlsx" /></p>
                  <div class="invalid-feedback bg-secondary errorFeaturestsaktiFilesubah">testte</div>
                </div> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahfeaturestsakti">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
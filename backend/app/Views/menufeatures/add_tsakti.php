 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahfeaturestsakti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tabel Sakti</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('features/tsakticontroller/simpandata', 
            ['class' => 'formModaltambahfeaturestsakti']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Tabel Sakti</label>
                  <input class="form-control" type="text"  placeholder="JSAK001" 
                        name="featurestsakti_kode" id="featurestsakti_kode" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturestsaktiKode">test</div>
                </div>

                <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Jenis Tabel</label>
                  <select class="form-control" id="featurestsakti_jenis" name="featurestsakti_jenis">
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
                        name="featurestsakti_nama" id="featurestsakti_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenistsaktiNama">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Tanggal</label>
                  <input class="form-control datepicker" placeholder="Start date" type="text" 
						value="<?= date("m/d/Y"); ?>" name="featurestsakti_tanggal" id="featurestsakti_tanggal">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorFeaturesjenistsaktiTanggal">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Files</label>
                  <input type="file" name="featurestsakti_files" class="form-control" id="featurestsakti_files" 
                  required accept=".xls, .pdf, .xlsx" /></p>
                  <div class="invalid-feedback bg-secondary errorFeaturestsaktiFiles">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahfeaturestsakti">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
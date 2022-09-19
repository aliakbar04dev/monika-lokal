 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahpackagedisc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Diskon Paket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('package/disccontroller/simpandata', ['class' => 'formModaltambahpackagedisc']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Diskon Paket</label>
                  <input class="form-control" type="text" placeholder="HPKT001" 
                        name="packagedisc_kode" id="packagedisc_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagedisckode">test</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Diskon Paket</label>
                  <input class="form-control" type="number" placeholder="25" 
                        name="packagedisc_diskon" id="packagedisc_diskon" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagediscdiskon">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Keterangan</label>
                  <textarea class="form-control" rows="3" name="packagedisc_keterangan" 
                        id="packagedisc_keterangan"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagediscKeterangan">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahdiscfeature">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
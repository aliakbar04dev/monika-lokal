 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahpackagedisc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Diskon Paket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('package/disccontroller/perbaruidata', ['class' => 'formModalubahpackagedisc']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                 <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Diskon Paket</label>
                  <input class="form-control" type="text" placeholder="HPKT001" 
                        name="packagedisc_kodeubah" id="packagedisc_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagedisckodeubah">test</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Diskon Paket</label>
                  <input class="form-control" type="number" placeholder="25" 
                        name="packagedisc_diskonubah" id="packagedisc_diskonubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagediscdiskonubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Keterangan</label>
                  <textarea class="form-control" rows="3" name="packagedisc_keteranganubah" 
                        id="packagedisc_keteranganubah"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorPackagediscKeteranganubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahpackagedisc">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
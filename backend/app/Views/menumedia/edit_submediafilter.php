 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahsubmediafilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Sub Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('media/Filtersubmedcontroller/perbaruidata', ['class' => 'formModalubahsubmediafilter']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Sub Kategori</label>
                  <input class="form-control" type="text"  placeholder="FMED001" 
                        name="submediafilter_kodeubah" id="submediafilter_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSubmediafilterKodeubah">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama Sub Kategori</label>
                  <input class="form-control" type="text" placeholder="Video Utama" 
                        name="submediafilter_keteranganubah" id="submediafilter_keteranganubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSubmediafilterKeteranganubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi Sub Kategori</label>
                  <textarea id="submediafilter_descubah" name="submediafilter_descubah" required></textarea>
                  <div class="invalid-feedback bg-secondary errorSubmediafilterdescubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahsubmediafilter">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
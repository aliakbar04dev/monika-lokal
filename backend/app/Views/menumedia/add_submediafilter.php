 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahsubmediafilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sub Kategori Media</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('media/Filtersubmedcontroller/simpandata', ['class' => 'formModaltambahsubmediafilter']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                <div class="form-group">
                  <label for="kode-infocategory-input" class="form-control-label">Kode Sub Kategori</label>
                  <input class="form-control" type="text"  placeholder="FMED001" 
                        name="submediafilter_kode" id="submediafilter_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSubmediafilterKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Nama Sub Kategori</label>
                  <input class="form-control" type="text" placeholder="Belajar macam-macam perintah Chart Teknikal" 
                        name="submediafilter_keterangan" id="submediafilter_keterangan" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorSubmediafilterKeterangan">testte</div>
                </div>
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Deskripsi Sub Kategori</label>
                  <textarea id="submediafilter_desc" name="submediafilter_desc" required></textarea>
                  <div class="invalid-feedback bg-secondary errorSubmediafilterdesc">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahsubmediafilter">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
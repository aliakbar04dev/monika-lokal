 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahcareercategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kategori Pekerjaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('career/CategorycarController/perbaruidata', ['class' => 'formModalubahcareercategory']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Kategori Pekerjaan</label>
                  <input class="form-control" type="text" placeholder="TKTP001" 
                        name="careercategory_kodeubah" id="careercategory_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCategorycareerKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infotype-input" class="form-control-label">Kategori Pekerjaan</label>
                  <input class="form-control" type="text" placeholder="Fulltime"
                        name="careercategory_namaubah" id="careercategory_namaubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCategorycareerNamaubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahCategorycareer">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
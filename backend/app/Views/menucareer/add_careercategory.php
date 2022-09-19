 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahcareercategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori Pekerjaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('career/CategorycarController/simpandata', ['class' => 'formModaltambahcareercategory']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Kategori Pekerjaan</label>
                  <input class="form-control" type="text" placeholder="TKTP001" 
                        name="careercategory_kode" id="careercategory_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareercategoryKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infotype-input" class="form-control-label">Kategori Pekerjaan</label>
                  <input class="form-control" type="text" placeholder="Fulltime" 
                        name="careercategory_nama" id="careercategory_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareercategoryNama">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahCareercategory">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
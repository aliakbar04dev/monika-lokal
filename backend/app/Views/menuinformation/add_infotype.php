 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahinfotype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengumuman</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('information/typecontroller/simpandata', ['class' => 'formModaltambahinfotype']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Jenis Pengumuman</label>
                  <input class="form-control" type="text" placeholder="JEPM001" 
                        name="infotype_kode" id="infotype_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfotypeKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infotype-input" class="form-control-label">Nama Jenis Pengumuman</label>
                  <input class="form-control" type="text" placeholder="News" 
                        name="infotype_nama" id="infotype_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfotypeNama">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahinfotype">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
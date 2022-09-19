 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahcareerdepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Departemen Pekerjaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('career/DepartmentcarController/simpandata', ['class' => 'formModaltambahcareerdepartment']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="kode-infotype-input" class="form-control-label">Kode Departemen Pekerjaan</label>
                  <input class="form-control" type="text" placeholder="TDEP001" 
                        name="careerdepartment_kode" id="careerdepartment_kode" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareerDepartmentKode">test</div>
                </div>

                <div class="form-group">
                  <label for="nama-infotype-input" class="form-control-label">Departemen Pekerjaan</label>
                  <input class="form-control" type="text" placeholder="Technology" 
                        name="careerdepartment_nama" id="careerdepartment_nama" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorCareerDepartmentNama">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahCareerdepartment">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
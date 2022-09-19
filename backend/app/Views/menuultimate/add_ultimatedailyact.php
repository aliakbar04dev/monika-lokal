 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimatedailyact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Content IHSG Daily Stock</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/dailyactcontroller/simpandata',
           ['class' => 'formModaltambahultimatedailyact']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode IHSG Daily Stock</label>
                  <input class="form-control" type="text" placeholder="KDSR001" 
                        name="ultimatedailyact_kode" id="ultimatedailyact_kode" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyactKode">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Content</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorSettingbannerDeskripsi">testte</div>
                  <textarea id="ultimatedailyact_deskripsi" name="ultimatedailyact_deskripsi"></textarea>
				  
				  <br />
				  
				  <label class="custom-toggle float-right">
                    <input type="checkbox" id="ultimatedailyact_isactive" class="ultimatedailyact_isactive" value="1" checked/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahultimatedailyact">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
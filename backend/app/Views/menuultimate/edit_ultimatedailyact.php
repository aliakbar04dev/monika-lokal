 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahultimatedailyact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Content IHSG Daily Stock</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/dailyactcontroller/perbaruidata',
           ['class' => 'formModalubahultimatedailyact']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode IHSG Daily Stock</label>
                  <input class="form-control" type="text" placeholder="KDSR001" 
                        name="ultimatedailyact_kodeubah" id="ultimatedailyact_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyactKodeubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Content</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorSettingbannerDeskripsiubah">testte</div>
                  <textarea id="ultimatedailyact_deskripsiubah" name="ultimatedailyact_deskripsiubah"></textarea>
				  
				  <br />
				  
				  <label class="custom-toggle float-right">
                    <input type="checkbox" id="ultimatedailyact_isactiveubah" class="ultimatedailyact_isactiveubah" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahultimatedailyact">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
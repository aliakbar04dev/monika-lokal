 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimatedailychart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Article Daily</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/dailychartcontroller/simpandata',
           ['class' => 'formModaltambahultimatedailychart']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body" style="max-height: calc(100vh - 210px); overflow-y: auto;">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Article Daily</label>
                  <input class="form-control" type="text" placeholder="KDSR001" 
                        name="ultimatedailychart_kode" id="ultimatedailychart_kode" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailychartKode">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Content</label>
                  <!-- <div id="infonews_summernote"></div> -->
                  <div class="invalid-feedback bg-secondary errorSettingbannerDeskripsi">testte</div>
                  <textarea id="ultimatedailychart_deskripsi" name="ultimatedailychart_deskripsi"></textarea>
				  
				  <br />
				  
				  <label class="custom-toggle float-right">
                    <input type="checkbox" id="ultimatedailychart_isactive" class="ultimatedailychart_isactive" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahultimatedailychart">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
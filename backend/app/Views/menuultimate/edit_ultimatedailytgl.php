 <!-- Modal ubah Info -->
 <div class="modal fade" id="modaleditultimatedailytgl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Tgl Dailystock</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/dailycontroller/perbaruidatatgl', ['class' => 'formModalubahultimatedailytgl']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
          <input class="form-control" type="hidden" name="ultimatedaily_idtgl" id="ultimatedaily_idtgl" />
				  <div class="form-group">
              <label for="kode-infonews-input" class="form-control-label">Tgl Daily Stock</label>
              <input class="form-control" type="date" name="ultimatedaily_edittgl" id="ultimatedaily_edittgl" />
              <div class="invalid-feedback bg-secondary errorultimatedailytglubah">testte</div>
				  <br />
				  
				  <label class="custom-toggle float-right">
            <input type="checkbox" id="ultimatedaily_isactiveubahtgl" class="ultimatedaily_isactiveubahtgl" value="1"/>
            <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
          </label>
          <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
        </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning btnmodalubahultimatedailytgl">Update</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
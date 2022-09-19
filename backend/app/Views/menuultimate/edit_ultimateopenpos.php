 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahultimateopenpos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Copy Trades | Open Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/openposcontroller/perbaruidata',
           ['class' => 'formModalubahultimateopenpos']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Kode Open Position</label>
                  <input class="form-control" type="text" placeholder="KUOP001" 
                        name="ultimateopenpos_kodeubah" id="ultimateopenpos_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateopenposKodeubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Kode Saham</label>
                  <input class="form-control" type="text" placeholder="TLKM" 
                        name="ultimateopenpos_stockubah" id="ultimateopenpos_stockubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateopenposstockubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Date</label>
                  <input class="form-control datepicker" placeholder="Buy Date" type="text" 
				value="<?= date("m/d/Y"); ?>" name="ultimateopenpos_buydateubah" id="ultimateopenpos_buydateubah">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateopenposbuydateubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Price</label>
                  <input class="form-control" type="text" placeholder="22.501" 
                        name="ultimateopenpos_buypriceubah" id="ultimateopenpos_buypriceubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateopenposbuypriceubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Target Price</label>
                  <input class="form-control" type="text" placeholder="20.000" 
                        name="ultimateopenpos_targetpriceubah" id="ultimateopenpos_targetpriceubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateopenpostargetpriceubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Last Price</label>
                  <input class="form-control" type="text" placeholder="19.000" 
                        name="ultimateopenpos_lastpriceubah" id="ultimateopenpos_lastpriceubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateopenposlastpriceubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Loss Profit</label>
                  <input class="form-control" type="text" placeholder="- 3.4 %" 
                        name="ultimateopenpos_lostprofitubah" id="ultimateopenpos_lostprofitubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateopenposlostprofitubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Story</label>
                  <input class="form-control" type="text" placeholder="Right Issue" 
                        name="ultimateopenpos_narrationubah" id="ultimateopenpos_narrationubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateopenposnarrationubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Description Story</label>
                  <div class="invalid-feedback bg-secondary errorDesNarrationOpenUbah">testte</div>
                  <textarea id="ultimateopenpos_descnarrationubah" name="ultimateopenpos_descnarrationubah" required></textarea>
                </div>
				
				<div class="form-group">
          <label for="nama-infocategory-input" class="form-control-label">Ubah Stop Loss</label>
                  <input class="form-control" type="text" placeholder="19.000" 
                        name="ultimateopenpos_stoplossubah" id="ultimateopenpos_stoplossubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateopenposstoplossubah">testte</div>
				  
				  <br />
				  
				  <label class="custom-toggle float-right">
                    <input type="checkbox" id="ultimateopenpos_isactiveubah" class="ultimateopenpos_isactiveubah" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahultimateopenpos">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
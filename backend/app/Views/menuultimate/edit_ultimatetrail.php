 <!-- Modal ubah Info -->
 <div class="modal fade" id="modalubahultimatetrail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Data Trailing Stop | Open Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/trailingcontroller/perbaruidata',
           ['class' => 'formModalubahultimatetrail']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Trailing</label>
                  <input class="form-control" type="text" placeholder="TBNR001" 
                        name="ultimatetrail_kodeubah" id="ultimatetrail_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailKodeubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Kode Saham</label>
                  <input class="form-control" type="text" placeholder="ISAT" 
                        name="ultimatetrail_stockubah" id="ultimatetrail_stockubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailstockubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Date</label>
                  <input class="form-control datepicker" placeholder="Buy Date" type="text" 
						value="<?= date("m/d/Y"); ?>" name="ultimatetrail_buydateubah" id="ultimatetrail_buydateubah">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailbuydateubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Price</label>
                  <input class="form-control" type="text" placeholder="22501" 
                        name="ultimatetrail_buypriceubah" id="ultimatetrail_buypriceubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailbuypriceubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Close Price</label>
                  <input class="form-control" type="text" placeholder="20000" 
                        name="ultimatetrail_closepriceubah" id="ultimatetrail_closepriceubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailclosepriceubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Gain / Loss</label>
                  <input class="form-control" type="text" placeholder="- 10 %" 
                        name="ultimatetrail_gainlossubah" id="ultimatetrail_gainlossubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailgainlossubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Trailing Stop</label>
                  <input class="form-control" type="text" placeholder="19000" 
                        name="ultimatetrail_trailingstopubah" id="ultimatetrail_trailingstopubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailtrailingstopubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Jarak TS</label>
                  <input class="form-control" type="text" placeholder="- 3.4 %" 
                        name="ultimatetrail_jaraktsubah" id="ultimatetrail_jaraktsubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailjaraktsubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Ubah Syariah</label>
                  <select class="form-control" id="ultimatetrail_syariahubah" name="ultimatetrail_syariahubah">
                    <option value="Yes">
                        Yes
                    </option>
					<option value="No">
                        No
                    </option>
                  </select>
				  
				  <br />
				  
				  <label class="custom-toggle float-right">
                    <input type="checkbox" id="ultimatetrail_isactiveubah" class="ultimatetrail_isactiveubah" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahultimatetrailing">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
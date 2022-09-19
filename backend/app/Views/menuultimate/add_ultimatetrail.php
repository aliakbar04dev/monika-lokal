 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimatetrail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Trailing Stop | Open Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/trailingcontroller/simpandata',
           ['class' => 'formModaltambahultimatetrail']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Trailing</label>
                  <input class="form-control" type="text" placeholder="TBNR001" 
                        name="ultimatetrail_kode" id="ultimatetrail_kode" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailKode">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Saham</label>
                  <input class="form-control" type="text" placeholder="ISAT" 
                        name="ultimatetrail_stock" id="ultimatetrail_stock" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailstock">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Buy Date</label>
                  <input class="form-control datepicker" placeholder="Buy Date" type="text" 
						value="<?= date("m/d/Y"); ?>" name="ultimatetrail_buydate" id="ultimatetrail_buydate">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailbuydate">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Buy Price</label>
                  <input class="form-control" type="text" placeholder="22501" 
                        name="ultimatetrail_buyprice" id="ultimatetrail_buyprice" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailbuyprice">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Close Price</label>
                  <input class="form-control" type="text" placeholder="20000" 
                        name="ultimatetrail_closeprice" id="ultimatetrail_closeprice" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailcloseprice">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gain / Loss</label>
                  <input class="form-control" type="text" placeholder="- 10 %" 
                        name="ultimatetrail_gainloss" id="ultimatetrail_gainloss" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailgainloss">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Trailing Stop</label>
                  <input class="form-control" type="text" placeholder="19000" 
                        name="ultimatetrail_trailingstop" id="ultimatetrail_trailingstop" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailtrailingstop">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Jarak TS</label>
                  <input class="form-control" type="text" placeholder="- 3.4 %" 
                        name="ultimatetrail_jarakts" id="ultimatetrail_jarakts" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatetrailjarakts">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Syariah</label>
                  <select class="form-control" id="ultimatetrail_syariah" name="ultimatetrail_syariah">
                    <option value="Yes">
                        Yes
                    </option>
					<option value="No">
                        No
                    </option>
                  </select>
				  
				  <br />
				  
				  <label class="custom-toggle float-right">
                    <input type="checkbox" id="ultimatetrail_isactive" class="ultimatetrail_isactive" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahultimatetrailing">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
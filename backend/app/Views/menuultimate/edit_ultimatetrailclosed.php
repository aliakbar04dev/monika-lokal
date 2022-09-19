  <!-- Modal Tambah Info -->
  <div class="modal fade" id="modalubahultimatetrailclosed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Trailing Stop | Closed Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/Trailingclosedcontroller/perbaruidata', ['class' => 'formModalubahultimatetrailclosed']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">

                  <label for="nama-infocategory-input" class="form-control-label">Kode Close Position</label>
                  <input class="form-control" type="text" placeholder="KUOP001" 
                        name="ultimateclosepos_kodeubah" id="ultimateclosepos_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposKodeubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Kode Saham</label>
                  <input class="form-control" type="text" placeholder="TLKM" 
                        name="ultimateclosepos_stockubah" id="ultimateclosepos_stockubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposstockubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Price</label>
                  <input class="form-control" type="text" placeholder="22.501" 
                        name="ultimateclosepos_buypriceubah" id="ultimateclosepos_buypriceubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposbuypriceubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Sell Price</label>
                  <input class="form-control" type="text" placeholder="20.000" 
                        name="ultimateclosepos_sellpriceubah" id="ultimateclosepos_sellpriceubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateclosepossellpriceubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Date</label>
                  <input class="form-control datepicker" placeholder="Buy Date" type="text" 
						value="<?= date("m/d/Y"); ?>" name="ultimateclosepos_buydateubah" id="ultimateclosepos_buydateubah">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposbuydateubah">testte</div>
                </div>
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Sell Date</label>
                  <input class="form-control datepicker" placeholder="Sell Date" type="text" 
						value="<?= date("m/d/Y"); ?>" name="ultimateclosepos_selldateubah" id="ultimateclosepos_selldateubah">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposselldateubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Profit</label>
                  <input class="form-control" type="text" placeholder="47 %" 
                        name="ultimateclosepos_profitubah" id="ultimateclosepos_profitubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposprofitubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Ubah Days Hold</label>
                  <input class="form-control" type="text" placeholder="10" 
                        name="ultimateclosepos_daysholdubah" id="ultimateclosepos_daysholdubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposdaysholdubah">testte</div>
				  
			<br />
				  
		      <label class="custom-toggle float-right">
                    <input type="checkbox" id="ultimateclosepos_isactiveubah" class="ultimateclosepos_isactiveubah" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahultimatetrailingclosed">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
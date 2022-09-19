 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahultimatewtcdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Watchlist</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/wtcdatacontroller/perbaruidata',
           ['class' => 'formModalubahultimatewtcdata']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Watchlist Data</label>
                  <input class="form-control" type="text" placeholder="KWLA001" 
                        name="ultimatewtcdata_kodeubah" id="ultimatewtcdata_kodeubah" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdataKodeubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Saham</label>
                  <input class="form-control" type="text" placeholder="TLKM" 
                        name="ultimatewtcdata_stockubah" id="ultimatewtcdata_stockubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatatockubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Market Cap</label>
                  <input class="form-control" type="text" placeholder="174,46 M" 
                        name="ultimatewtcdata_marketubah" id="ultimatewtcdata_marketubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatamarketubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Buy Price</label>
                  <input class="form-control" type="text" placeholder="22.501" 
                        name="ultimatewtcdata_buypriceubah" id="ultimatewtcdata_buypriceubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatabuypriceubah">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Target Price</label>
                  <input class="form-control" type="text" placeholder="20.000" 
                        name="ultimatewtcdata_targetpriceubah" id="ultimatewtcdata_targetpriceubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatatargetpriceubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Stop Loss</label>
                  <input class="form-control" type="text" placeholder="19.000" 
                        name="ultimatewtcdata_stoplossubah" id="ultimatewtcdata_stoplossubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatastoplossubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Risk</label>
                  <input class="form-control" type="text" placeholder="- 3.4 %" 
                        name="ultimatewtcdata_riskubah" id="ultimatewtcdata_riskubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatariskubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Narration</label>
                  <input class="form-control" type="text" placeholder="Right Issue" 
                        name="ultimatewtcdata_narrationubah" id="ultimatewtcdata_narrationubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatanarrationubah">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Buy / Sell</label>
                  <select class="form-control" id="ultimatewtcdata_actionubah" name="ultimatewtcdata_actionubah">
                    <option value="NO ACTION">
                        NO ACTION
                    </option>
                    <option value="BUY">
                        BUY
                    </option>
			  <option value="SELL">
                        SELL
                    </option>
                  </select>
				  
			 <br />
				  
			<label class="custom-toggle float-right">
                    <input type="checkbox" id="ultimatewtcdata_isactiveubah" class="ultimatewtcdata_isactiveubah" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahultimatewtcdata">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
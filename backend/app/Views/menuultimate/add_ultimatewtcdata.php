 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimatewtcdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Watchlist</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/wtcdatacontroller/simpandata',
           ['class' => 'formModaltambahultimatewtcdata']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Watchlist Data</label>
                  <input class="form-control" type="text" placeholder="KWLA001" 
                        name="ultimatewtcdata_kode" id="ultimatewtcdata_kode" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdataKode">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Saham</label>
                  <input class="form-control" type="text" placeholder="TLKM" 
                        name="ultimatewtcdata_stock" id="ultimatewtcdata_stock" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatatock">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Market Cap</label>
                  <input class="form-control" type="text" placeholder="174,46 M" 
                        name="ultimatewtcdata_market" id="ultimatewtcdata_market" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatamarket">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Buy Price</label>
                  <input class="form-control" type="text" placeholder="22.501" 
                        name="ultimatewtcdata_buyprice" id="ultimatewtcdata_buyprice" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatabuyprice">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Target Price</label>
                  <input class="form-control" type="text" placeholder="20.000" 
                        name="ultimatewtcdata_targetprice" id="ultimatewtcdata_targetprice" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatatargetprice">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Stop Loss</label>
                  <input class="form-control" type="text" placeholder="19.000" 
                        name="ultimatewtcdata_stoploss" id="ultimatewtcdata_stoploss" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatastoploss">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Risk</label>
                  <input class="form-control" type="text" placeholder="- 3.4 %" 
                        name="ultimatewtcdata_risk" id="ultimatewtcdata_risk" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatarisk">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Narration</label>
                  <input class="form-control" type="text" placeholder="Right Issue" 
                        name="ultimatewtcdata_narration" id="ultimatewtcdata_narration" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatewtcdatanarration">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="kode-infonews-input" class="form-control-label">Buy / Sell</label>
                  <select class="form-control" id="ultimatewtcdata_action" name="ultimatewtcdata_action">
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
                    <input type="checkbox" id="ultimatewtcdata_isactive" class="ultimatewtcdata_isactive" value="1"/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahultimatewtcdata">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
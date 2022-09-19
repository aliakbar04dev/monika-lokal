 
 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimatedailyclosed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Daily Stock | Closed Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/Dailyclosedcontroller/simpandata', ['class' => 'formModaltambahultimatedailyclosed']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Close Position</label>
                  <input class="form-control" type="text" placeholder="KUOP001" 
                        name="ultimatedailyclosed_kode" id="ultimatedailyclosed_kode" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedKode">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Stock</label>
                  <input class="form-control" type="text" placeholder="Contoh: TLKM" 
                        name="ultimatedailyclosed_stock" id="ultimatedailyclosed_stock" required/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedstock">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Buy Price</label>
                  <input class="form-control" type="text" placeholder="Contoh: 22.501" 
                        name="ultimatedailyclosed_buyprice" id="ultimatedailyclosed_buyprice"  required/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedbuyprice">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Sell Price</label>
                  <input class="form-control" type="text" placeholder="Contoh: 20.000" 
                        name="ultimatedailyclosed_sellprice" id="ultimatedailyclosed_sellprice"  required/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedsellprice">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Buy Date</label>
                  <input class="form-control datepicker" placeholder="Contoh: Buy Date" type="text" 
						value="<?= date("m/d/Y"); ?>" name="ultimatedailyclosed_buydate" id="ultimatedailyclosed_buydate" required>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedbuydate">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Sell Date</label>
                  <input class="form-control datepicker" placeholder="Contoh: Sell Date" type="text" 
						value="<?= date("m/d/Y"); ?>" name="ultimatedailyclosed_selldate" id="ultimatedailyclosed_selldate" required>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedselldate">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Gain/Loss</label>
                  <input class="form-control" type="text" placeholder="Contoh: 47 %" 
                        name="ultimatedailyclosed_gainloss" id="ultimatedailyclosed_gainloss" required/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedgainloss">testte</div>
                </div>
                
                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Target</label>
                  <input class="form-control" type="text" placeholder="Contoh: 1000-1050" 
                        name="ultimatedailyclosed_target" id="ultimatedailyclosed_target" required/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedtarget">testte</div>
                </div>

                <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Hit/Miss</label>
                  <select class="form-control" id="ultimatedailyclosed_hitmiss" name="ultimatedailyclosed_hitmiss">
                    <option value="hit">
                        Hit
                    </option>
                    <option value="miss">
                        Miss
                    </option>
                  </select>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedhitmiss">testte</div>
                </div>
				
		    <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Highest</label>
                  <input class="form-control" type="text" placeholder="Contoh: 1123" 
                        name="ultimatedailyclosed_highest" id="ultimatedailyclosed_highest" required/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatedailyclosedhighest">testte</div>
				  
			<br />
				  
		      <label class="custom-toggle float-right">
                    <input type="checkbox" id="ultimatedailyclosed_isactive" class="ultimatedailyclosed_isactive" value="1" checked/>
                    <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
                  </label>
                  <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
                </div>				
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahultimatedailyclosed">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
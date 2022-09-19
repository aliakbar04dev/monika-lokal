 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimateclosepos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Copy Trades | Close Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open_multipart('ultimate/closeposcontroller/simpandata',
           ['class' => 'formModaltambahultimateclosepos']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
            <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Close Position</label>
                  <input class="form-control" type="text" placeholder="KUOP001" 
                        name="ultimateclosepos_kode" id="ultimateclosepos_kode" readonly/>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposKode">testte</div>
            </div>

            <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Kode Saham</label>
                  <input class="form-control" type="text" placeholder="TLKM" 
                        name="ultimateclosepos_stock" id="ultimateclosepos_stock" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposstock">testte</div>
            </div>

            <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Buy Price</label>
                  <input class="form-control" type="text" placeholder="22.501" 
                        name="ultimateclosepos_buyprice" id="ultimateclosepos_buyprice" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposbuyprice">testte</div>
            </div>
                  
            <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Sell Price</label>
                  <input class="form-control" type="text" placeholder="20.000" 
                        name="ultimateclosepos_sellprice" id="ultimateclosepos_sellprice" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimateclosepossellprice">testte</div>
            </div>
                  
            <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Buy Date</label>
                  <input class="form-control datepicker" placeholder="Buy Date" type="text" value="<?= date("m/d/Y"); ?>" name="ultimateclosepos_buydate" id="ultimateclosepos_buydate">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposbuydate">testte</div>
            </div>

            <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Sell Date</label>
                  <input class="form-control datepicker" placeholder="Sell Date" type="text" 
                                    value="<?= date("m/d/Y"); ?>" name="ultimateclosepos_selldate" id="ultimateclosepos_selldate">
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposselldate">testte</div>
            </div>
                  
            <div class="form-group">
                  <label for="nama-infocategory-input" class="form-control-label">Profit</label>
                  <input class="form-control" type="text" placeholder="47 %" 
                        name="ultimateclosepos_profit" id="ultimateclosepos_profit" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorultimatecloseposprofit">testte</div>
            </div>
                  
            <div class="form-group">
            <label for="nama-infocategory-input" class="form-control-label">Days Hold</label>
            <input class="form-control" type="text" placeholder="10" name="ultimateclosepos_dayshold" id="ultimateclosepos_dayshold" />
            <!-- Error Validation -->
            <div class="invalid-feedback bg-secondary errorultimatecloseposdayshold">testte</div>
                        
            <!-- <br />
                        
            <label class="custom-toggle float-right">
                  <input type="checkbox" id="ultimateclosepos_isactive" class="ultimateclosepos_isactive" value="1"/>
                  <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
            </label>
            <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label> -->
            </div>				
        </div>
        <div class="modal-footer" style="margin-top: -40px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodaltambahultimateclosepos">Simpan</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
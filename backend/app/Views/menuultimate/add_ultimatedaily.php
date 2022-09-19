 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimatedaily" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Tambah Data Open Position</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('ultimate/dailycontroller/simpandata', ['class' => 'formModaltambahultimatedaily']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body">
         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Kode Daily</label>
           <input class="form-control" type="text" placeholder="KDSR001" name="ultimatedaily_kode"
             id="ultimatedaily_kode" readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyKode">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Stock</label>
           <input class="form-control" type="text" placeholder="Contoh: AGRO" name="ultimatedaily_stock"
             id="ultimatedaily_stock" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailystock">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Buy Date</label>
           <input class="form-control datepicker" placeholder="Contoh: Buy Date" type="text" value="<?= date("m/d/Y"); ?>"
             name="ultimatedaily_buydate" id="ultimatedaily_buydate">
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailybuydate">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Buy Price</label>
           <input class="form-control" type="text" placeholder="Contoh: 22501" name="ultimatedaily_buyprice"
             id="ultimatedaily_buyprice" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailybuyprice">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Close Price</label>
           <input class="form-control" type="text" placeholder="Contoh: 2.000" name="ultimatedaily_closed"
             id="ultimatedaily_closed" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyclosed">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Gain / Loss %</label>
           <input class="form-control" type="text" placeholder="Contoh: - 10 %" name="ultimatedaily_gainloss"
             id="ultimatedaily_gainloss" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailygainloss">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Resistance 1</label>
           <input class="form-control" type="text" placeholder="Contoh: 2.050 - 2.100" name="ultimatedaily_areabeli"
             id="ultimatedaily_areabeli" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyareabeli">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Resistance 2</label>
           <input class="form-control" type="text" placeholder="Contoh: 2.250 - 2.300" name="ultimatedaily_areajual"
             id="ultimatedaily_areajual" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyareajual">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Stop Loss</label>
           <input class="form-control" type="text" placeholder="Contoh: 2.000" name="ultimatedaily_stoploss"
             id="ultimatedaily_stoploss" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailystoploss">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Jarak SL %</label>
           <input class="form-control" type="text" placeholder="Contoh: - 3.4 %" name="ultimatedaily_jaraksl"
             id="ultimatedaily_jaraksl" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyjaraksl">testte</div>

           <!-- <br />

           <label class="custom-toggle float-right">
             <input type="checkbox" id="ultimatedaily_isactive" class="ultimatedaily_isactive" value="1" />
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label> -->
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodaltambahultimatedaily">Simpan</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>
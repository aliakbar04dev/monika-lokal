 <!-- Modal ubah Info -->
 <div class="modal fade" id="modalubahultimatedaily" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Ubah Data Daily loh</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('ultimate/dailycontroller/perbaruidata',
           ['class' => 'formModalubahultimatedaily']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body">
         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Kode Daily</label>
           <input class="form-control" type="text" placeholder="KDSR001" name="ultimatedaily_kodeubah"
             id="ultimatedaily_kodeubah" readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyKodeubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Stock</label>
           <input class="form-control" type="text" placeholder="AGRO" name="ultimatedaily_stockubah"
             id="ultimatedaily_stockubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailystockubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Date</label>
           <input class="form-control datepicker" placeholder="Contoh: Buy Date" type="text" name="ultimatedaily_buydateubah" id="ultimatedaily_buydateubah">
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailybuydateubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Price</label>
           <input class="form-control" type="text" placeholder="Contoh: 22501" name="ultimatedaily_buypriceubah"
             id="ultimatedaily_buypriceubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailybuypriceubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Close Price</label>
           <input class="form-control" type="text" placeholder="" name="ultimatedaily_closedubah"
             id="ultimatedaily_closedubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyclosedubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Gain / Loss %</label>
           <input class="form-control" type="text" placeholder="Contoh: - 10 %" name="ultimatedaily_gainlossubah"
             id="ultimatedaily_gainlossubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailygainlossubah">testte</div>
         </div>


         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Resistance 1</label>
           <input class="form-control" type="text" placeholder="2.050 - 2.100" name="ultimatedaily_areabeliubah"
             id="ultimatedaily_areabeliubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyareabeliubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Resistance 2</label>
           <input class="form-control" type="text" placeholder="2.250 - 2.300" name="ultimatedaily_areajualubah"
             id="ultimatedaily_areajualubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyareajualubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Stop Loss</label>
           <input class="form-control" type="text" placeholder="2.000" name="ultimatedaily_stoplossubah"
             id="ultimatedaily_stoplossubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailystoplossubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Jarak SL %</label>
           <input class="form-control" type="text" placeholder="Contoh: - 3.4 %" name="ultimatedaily_jarakslubah"
             id="ultimatedaily_jarakslubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatedailyjarakslubah">testte</div>

           <br />

           <label class="custom-toggle float-right">
             <input type="checkbox" id="ultimatedaily_isactiveubah" class="ultimatedaily_isactiveubah" value="1" />
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
         </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
           <button type="submit" class="btn btn-warning btnmodalubahultimatedaily">Update</button>
         </div>

         <?= form_close(); ?>
         <!-- Handle FORM -->
       </div>
     </div>
   </div>
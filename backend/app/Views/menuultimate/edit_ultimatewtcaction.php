 <!-- Modal ubah Info -->
 <div class="modal fade" id="modalubahultimatewtcaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg" style="overflow-y: scroll; max-height:90%;" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Ubah Data Copy Trades | Watchlist Action</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <!-- Handle Form -->
       <?= form_open_multipart('ultimate/wtcactioncontroller/perbaruidata',
           ['class' => 'formModalubahultimatewtcaction']); ?>
       <?= csrf_field(); ?>

       <div class="modal-body">
         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Kode Watchlist Action</label>
           <input class="form-control" type="text" placeholder="KWLA001" name="ultimatewtcaction_kodeubah"
             id="ultimatewtcaction_kodeubah" readonly />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatewtcactionKodeubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Kode Saham</label>
           <input class="form-control" type="text" placeholder="TLKM" name="ultimatewtcaction_stockubah"
             id="ultimatewtcaction_stockubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatewtcactiontockubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Value</label>
           <input class="form-control" type="text" placeholder="174,46 M" name="ultimatewtcaction_valueubah"
             id="ultimatewtcaction_valueubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatewtcactionvalueubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Buy Price</label>
           <input class="form-control" type="text" placeholder="22.501" name="ultimatewtcaction_buypriceubah"
             id="ultimatewtcaction_buypriceubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatewtcactionbuypriceubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Target Price</label>
           <input class="form-control" type="text" placeholder="20.000" name="ultimatewtcaction_targetpriceubah"
             id="ultimatewtcaction_targetpriceubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatewtcactiontargetpriceubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Stop Loss</label>
           <input class="form-control" type="text" placeholder="19.000" name="ultimatewtcaction_stoplossubah"
             id="ultimatewtcaction_stoplossubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatewtcactionstoplossubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Risk</label>
           <input class="form-control" type="text" placeholder="- 3.4 %" name="ultimatewtcaction_riskubah"
             id="ultimatewtcaction_riskubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatewtcactionriskubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Story</label>
           <input class="form-control" type="text" placeholder="Right Issue" name="ultimatewtcaction_narrationubah"
             id="ultimatewtcaction_narrationubah" />
           <!-- Error Validation -->
           <div class="invalid-feedback bg-secondary errorultimatewtcactionnarrationubah">testte</div>
         </div>

         <div class="form-group">
           <label for="nama-infocategory-input" class="form-control-label">Ubah Description Story</label>
           <textarea id="ultimatewtcaction_descnarrationubah" name="ultimatewtcaction_descnarrationubah"
             required></textarea>
         </div>

         <div class="form-group">
           <label for="kode-infonews-input" class="form-control-label">Ubah Buy / Sell</label>
           <select class="form-control" id="ultimatewtcaction_actionubah" name="ultimatewtcaction_actionubah">
             <option value="BUY">
               BUY
             </option>
             <option value="SELL">
               SELL
             </option>
           </select>

           <br />

           <label class="custom-toggle float-right">
             <input type="checkbox" id="ultimatewtcaction_isactiveubah" class="ultimatewtcaction_isactiveubah"
               value="1" />
             <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Iya"></span>
           </label>
           <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data &nbsp;</label>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
         <button type="submit" class="btn btn-primary btnmodalubahultimatewtcaction">Ubah</button>
       </div>

       <?= form_close(); ?>
       <!-- Handle FORM -->
     </div>
   </div>
 </div>
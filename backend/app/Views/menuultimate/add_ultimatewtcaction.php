 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimatewtcaction" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" style="overflow-y: scroll; max-height:90%;"
             role="document">
             <div class="modal-content">
                   <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Tambah Data Copy Trades | Watchlist Action</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                         </button>
                   </div>
                   <!-- Handle Form -->
                   <?= form_open_multipart('ultimate/wtcactioncontroller/simpandata', ['class' => 'formModaltambahultimatewtcaction']); ?>
                   <?= csrf_field(); ?>

                   <div class="modal-body">
                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Kode Watchlist
                                     Action</label>
                               <input class="form-control" type="text" placeholder="KWLA001"
                                     name="ultimatewtcaction_kode" id="ultimatewtcaction_kode" readonly />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimatewtcactionKode">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Kode Saham</label>
                               <input class="form-control" type="text" placeholder="TLKM" name="ultimatewtcaction_stock"
                                     id="ultimatewtcaction_stock" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimatewtcactiontock">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Value</label>
                               <input class="form-control" type="text" placeholder="174,46 M"
                                     name="ultimatewtcaction_value" id="ultimatewtcaction_value" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimatewtcactionvalue">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Buy Price</label>
                               <input class="form-control" type="text" placeholder="22.501"
                                     name="ultimatewtcaction_buyprice" id="ultimatewtcaction_buyprice" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimatewtcactionbuyprice">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Target Price</label>
                               <input class="form-control" type="text" placeholder="20.000"
                                     name="ultimatewtcaction_targetprice" id="ultimatewtcaction_targetprice" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimatewtcactiontargetprice">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Stop Loss</label>
                               <input class="form-control" type="text" placeholder="19.000"
                                     name="ultimatewtcaction_stoploss" id="ultimatewtcaction_stoploss" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimatewtcactionstoploss">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Risk</label>
                               <input class="form-control" type="text" placeholder="- 3.4 %"
                                     name="ultimatewtcaction_risk" id="ultimatewtcaction_risk" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimatewtcactionrisk">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Story</label>
                               <input class="form-control" type="text" placeholder="Right Issue"
                                     name="ultimatewtcaction_narration" id="ultimatewtcaction_narration" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimatewtcactionnarration">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Description Story</label>
                               <textarea id="ultimatewtcaction_descnarration" name="ultimatewtcaction_descnarration"
                                     required></textarea>
                         </div>

                         <div class="form-group">
                               <label for="kode-infonews-input" class="form-control-label">Buy / Sell</label>
                               <select class="form-control" id="ultimatewtcaction_action"
                                     name="ultimatewtcaction_action">
                                     <option value="BUY">
                                           BUY
                                     </option>
                                     <option value="SELL">
                                           SELL
                                     </option>
                               </select>

                               <br />

                               <label class="custom-toggle float-right">
                                     <input type="checkbox" id="ultimatewtcaction_isactive"
                                           class="ultimatewtcaction_isactive" value="1" />
                                     <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak"
                                           data-label-on="Iya"></span>
                               </label>
                               <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data
                                     &nbsp;</label>
                         </div>
                   </div>
                   <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-primary btnmodaltambahultimatewtcaction">Simpan</button>
                   </div>

                   <?= form_close(); ?>
                   <!-- Handle FORM -->
             </div>
       </div>
 </div>
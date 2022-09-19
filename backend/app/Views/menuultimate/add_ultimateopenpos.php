 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modaltambahultimateopenpos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
             <div class="modal-content">
                   <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Tambah Data Copy Trades | Open Position</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                         </button>
                   </div>
                   <!-- Handle Form -->
                   <?= form_open_multipart('ultimate/openposcontroller/simpandata', ['class' => 'formModaltambahultimateopenpos']); ?>
                   <?= csrf_field(); ?>

                   <div class="modal-body">
                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Kode Open
                                     Position</label>
                               <input class="form-control" type="text" placeholder="KUOP001" name="ultimateopenpos_kode"
                                     id="ultimateopenpos_kode" readonly />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimateopenposKode">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Kode Saham</label>
                               <input class="form-control" type="text" placeholder="TLKM" name="ultimateopenpos_stock"
                                     id="ultimateopenpos_stock" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimateopenposstock">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Buy Date</label>
                               <input class="form-control datepicker" placeholder="Buy Date" type="text"
                                     value="<?= date("m/d/Y"); ?>" name="ultimateopenpos_buydate"
                                     id="ultimateopenpos_buydate">
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimateopenposbuydate">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Buy Price</label>
                               <input class="form-control" type="text" placeholder="22.501"
                                     name="ultimateopenpos_buyprice" id="ultimateopenpos_buyprice" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimateopenposbuyprice">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Target Price</label>
                               <input class="form-control" type="text" placeholder="20.000"
                                     name="ultimateopenpos_targetprice" id="ultimateopenpos_targetprice" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimateopenpostargetprice">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Last Price</label>
                               <input class="form-control" type="text" placeholder="19.000"
                                     name="ultimateopenpos_lastprice" id="ultimateopenpos_lastprice" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimateopenposlastprice">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Loss Profit</label>
                               <input class="form-control" type="text" placeholder="- 3.4 %"
                                     name="ultimateopenpos_lostprofit" id="ultimateopenpos_lostprofit" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimateopenposlostprofit">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Story</label>
                               <input class="form-control" type="text" placeholder="Right Issue"
                                     name="ultimateopenpos_narration" id="ultimateopenpos_narration" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimateopenposnarration">testte</div>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Description Story</label>
                               <div class="invalid-feedback bg-secondary errorDesNarrationOpen">testte</div>
                               <textarea id="ultimateopenpos_descnarration" name="ultimateopenpos_descnarration"
                                     required></textarea>
                         </div>

                         <div class="form-group">
                               <label for="nama-infocategory-input" class="form-control-label">Stop Loss</label>
                               <input class="form-control" type="text" placeholder="19.000"
                                     name="ultimateopenpos_stoploss" id="ultimateopenpos_stoploss" />
                               <!-- Error Validation -->
                               <div class="invalid-feedback bg-secondary errorultimateopenposstoploss">testte</div>
                         </div>

                         <div class="form-group">
                              <label for="nama-infocategory-input" class="form-control-label">Berkas</label>
                              <input type="file" name="ultimateopenpos_gambar" class="form-control" id="ultimateopenpos_gambar" accept="application/pdf" />
                              <small>Ukuran file jangan lebih dari 3 MB.</small>
                              <div class="invalid-feedback bg-secondary errorultimateopenposGambar">testte</div>
                              <br />

                               <label class="custom-toggle float-right">
                                     <input type="checkbox" id="ultimateopenpos_isactive"
                                           class="ultimateopenpos_isactive" value="1" />
                                     <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak"
                                           data-label-on="Iya"></span>
                               </label>
                               <label for="nama-infocategory-input" class="form-control-label float-right">Aktifkan data&nbsp;</label>
                        </div>
                   </div>
                   <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-primary btnmodaltambahultimateopenpos">Simpan</button>
                   </div>

                   <?= form_close(); ?>
                   <!-- Handle FORM -->
             </div>
       </div>
 </div>
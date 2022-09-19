 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalubahinfofaq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Faq</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('information/faqcontroller/perbaruidata', ['class' => 'formModalubahinfofaq']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-infotype-input" class="form-control-label">Pertanyaan</label>
				  <input class="form-control" type="hidden" placeholder="Bagaimana cara investasi saham ?" 
                        name="infofaq_kodeubah" id="infofaq_kodeubah" />
						
                  <input class="form-control" type="text" placeholder="Bagaimana cara investasi saham ?" 
                        name="infofaq_soalubah" id="infofaq_soalubah" />
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfofaqSoalubah">testte</div>
                </div>
				
				<div class="form-group">
                  <label for="nama-infotype-input" class="form-control-label">Jawaban</label>
                  <textarea class="form-control" rows="3" name="infofaq_jawabubah" 
                        id="infofaq_jawabubah"></textarea>
                  <!-- Error Validation -->
                  <div class="invalid-feedback bg-secondary errorInfotypeJawabubah">testte</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btnmodalubahinfofaq">Ubah</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalviewquestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('information/categorycontroller/perbaruidata', ['class' => 'formModalubahinfocategory']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                  <label for="nama-questionfeedback-input" class="form-control-label">Nama</label>
                  <div id="nama-questionfeedback"></div>
                </div>

                <div class="form-group">
                  <label for="email-questionfeedback-input" class="form-control-label">Alamat email</label>
                  <div id="email-questionfeedback"></div>
                </div>

                <div class="form-group">
                  <label for="hp-questionfeedback-input" class="form-control-label">No hp</label>
                  <div id="hp-questionfeedback"></div>
                </div>

                <div class="form-group">
                  <label for="tgl-questionfeedback-input" class="form-control-label">Tanggal</label>
                  <div id="tgl-questionfeedback"></div>
                </div>

                <div class="form-group">
                  <label for="pesan-questionfeedback-input" class="form-control-label">Isi pesan</label>
                  <div id="pesan-questionfeedback"></div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btnmodalbatalinfocategory" data-dismiss="modal">Keluar</button>
            <!-- <button type="submit" class="btn btn-primary btnmodalubahinfocategory">Ubah</button> -->
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
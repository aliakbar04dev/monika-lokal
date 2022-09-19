 <!-- Modal Tambah Info -->
 <div class="modal fade" id="modalexportfeaturesreferal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Handle Form -->
        <?= form_open('features/referalcontroller/proses', ['class' => 'formModalexportfeaturesreferal']); ?>
        <?= csrf_field(); ?>

        <div class="modal-body">
                <div class="form-group">
                <label class="form-control-label">Start date</label>
                    <input class="form-control datepicker" placeholder="Start date" type="text" 
                      value="<?= $start_date; ?>" name="featuresreferal_exportstdate" id="featuresreferal_exportstdate" required>
                    <div class="invalid-feedback bg-secondary errorFeaturesfilterstdate">test</div>
                </div>

                <div class="form-group">
                <label class="form-control-label">End date</label>
                    <input class="form-control datepicker" placeholder="End date" type="text" 
                     value="<?= $end_date ?>"  name="featuresreferal_exporteddate" id="featuresreferal_exporteddate" required>
                    <div class="invalid-feedback bg-secondary errorFeaturesfiltereddate">test</div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btnmodalbatalexportfeaturesreferal" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-success btnmodalexportfeaturesreferal">Export Excel</button>
        </div>

        <?= form_close(); ?>
        <!-- Handle FORM -->
        </div>
    </div>
</div>
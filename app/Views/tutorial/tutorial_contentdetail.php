<div class="col-lg-9">
    <div class="card">
        <div class="card-header">
            <div class="col-sm-10" style="vertical-align: middle;">
                <h4 style="color: #fdc134;">Tutorial</h4>
            </div>
            <div class="col-sm-2" style="vertical-align: middle;">
                <button type="button" style="width:auto; background-color:#612D11; border-color:#612D11;" class="btn btn-warning btn-sm" onClick="javascript:history.go(-1)">
                    <font style="color:#fff; font-family: Poppins; font-weight:bold;">Kembali</font>
                </button>
            </div>
        </div>
        <div class="card-body" id="tempatgambar">
            <h1 style="margin-top: -2%;"><?= $dataDetail['title'] ?></h1>
            <?= $dataDetail['content'] ?>
        </div>
    </div>
</div>
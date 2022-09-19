<div class="col-lg-12 list-item " style="margin-bottom:2%; margin-top:1%;">
    <div style="padding-left: 20%; padding-right: 20%;">
        <form method="GET" action="<?= base_url('tutorial') ?>" class="form-group">
            <div class="row" style="text-align: center;">
                <div class="col-lg-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="" required style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit" style="border-bottom-right-radius: 10px; border-top-right-radius: 10px; background-color: #fdc134; border-color: #fdc134; color: #612D11; font-family: Poppins; font-weight:bold;">CARI</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if ($cari): ?>
        <div class="text-center">
            <button class="btn btn-light" onclick="window.location.href='<?= base_url('tutorial') ?>'" style="background-color: #fdc134; border-color: #fdc134; color: #612D11; margin-top:-4px; margin-bottom:4px; font-family: Poppins; font-weight:bold;">SEMUA TUTORIAL</button>
        </div>

    <?php else: ?>

    <?php endif ?>
</div>

<?php foreach ($konten_tutorial as $row): ?>
    <div class="col-lg-6 pb-2 list-item" onclick="location.href='<?= base_url().'/detail-tutorial'.'/'.$row['id_tutorial'] ?>'" style="cursor: pointer;">
        <div class="kartu-tutorial pb-2 pt-3 pl-5 pr-5">
            <h6 class="coklat"><?= $row['title'] ?></h6>

            <?php if (strlen($row['sub_title']) < 52 ): ?>
                <p style="font-family: Poppins; font-weight:bold; font-size:12px; margin-bottom:30px;"><?= substr($row['sub_title'], 0, 52) ?> </p>
                <a href="<?= base_url().'/detail-tutorial'.'/'.$row['id_tutorial'] ?>" style="font-family: Poppins; font-weight:bold;"><b style="color: #612D11; font-size:12px;">Read More</b></a>
            <?php elseif (strlen($row['sub_title']) >= 52 ): ?>
                <p style="font-family: Poppins; font-weight:bold; font-size:12px;"><?= substr($row['sub_title'], 0, 52) ?> ... </p>
                <a href="<?= base_url().'/detail-tutorial'.'/'.$row['id_tutorial'] ?>" style="font-family: Poppins; font-weight:bold;"><b style="color: #612D11; font-size:12px;">Read More</b></a>
            <?php else: ?>
                error
            <?php endif; ?>
            

            
        </div>
    </div>
<?php endforeach; ?>

<?= $pager->Links() ?>



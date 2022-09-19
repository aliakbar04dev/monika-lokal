<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/daily.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/m/css/bootstrap.min.css">
</head>

<body>

    <div class="containeri">
        <div class="hd">
            <div class="hd-1">Daily Stock Recomendation</div>
        </div>
        <div class="pt-1">
            <table>
                <tr>
                    <td>Stock</td>
                    <td>Area Beli</td>
                    <td>Target Jual</td>
                    <td>Stop Loss</td>
                    <td>Type</td>
                </tr>
                <!-- <tr>
                    <td>BIMA</td>
                    <td>216</td>
                    <td>224</td>
                    <td>210</td>
                    <td>Fast Trade</td>
                </tr>
                <tr>
                    <td>BIMA</td>
                    <td>216</td>
                    <td>224</td>
                    <td>210</td>
                    <td>Fast Trade</td>
                </tr>
                <tr>
                    <td>BIMA</td>
                    <td>216</td>
                    <td>224</td>
                    <td>210</td>
                    <td>Fast Trade</td>
                </tr> -->
                <?php
                foreach ($all_data as $item) :
                ?>
                    <tr>
                        <td><?= $item['stock']; ?></td>
                        <td><?= $item['area_beli']; ?></td>
                        <td><?= $item['area_jual']; ?></td>
                        <td><?= $item['stop_loss']; ?></td>
                        <td><?= $item['type']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
     <!--  <div class="pt-2">
           <a class="head-v">INDEX REVIEW :</a>
            <div class="hr"></div>
            <img class="cart" alt="image" src="/public/assets/img/cobacart.jpg">
        </div>
       <div class="containeri">
            <div class="row">
                <div class="col kecil cen">Net Foreign Buy(ALL)<br><a class="kecil cen" style="color:#3F8E3C;">773,06 Miliar</a></div>
                <div class="col kecil cen">Net Foreign Buy(RG)<br><a class="kecil cen" style="color:#3F8E3C;">746,11 Miliar</a></div>
                <div class="col kecil cen">Net Foreign Buy(Nego + TN)<br><a class="kecil cen" style="color:#3F8E3C;">26,95 Miliar</a></div>
                <div class="col-12 kecil cen">Review :<br>
                    Kenaikan kemarin belum mengkonfirmasi pergerakan. Sikap wait&see masih berlaku. Support di area 6.600. jika tembus, potensi ke area 6.500.
                    <br> Resistent : 6700. Support : 6500-6600
                </div>
            </div>
        </div> -->
	  <br />
	  <div class="pt-2">
			<?php
				foreach ($content as $item) :
			?>
				<?=  $item['content']; ?>
			<?php endforeach; ?>
      </div> 
    </div>

</body>

</html>
<div class="" style="background-color: #eee;">
    <div class="container  pl-3 pr-3 pb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="tittle">
                    FAQ
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php foreach ($faq as $f) : ?>
                    <button class="accordion">
                        <!-- <a class="acc font pl-4 pr-3" style="font-size: 20px; color: #432C1A; "><?= $f['question']; ?></a> -->
                        <a class="acc font pr-3" style="font-size: 20px; color: #432C1A; "><?= $f['question']; ?></a>
                    </button>
                    <div class="panel">
                        <a class="pt-5" style="font-size: 15px;"><?= $f['answered']; ?></a>
                    </div>
                <?php endforeach; ?>

                <!-- <button class="accordion"><a class="acc font pl-4 pr-3" style="font-size: 20px; color: #432C1A; ">Bagaimana Cara Investasi Saham ?</a></button>
                <div class="panel">
                    <p class="pl-4" style="font-size: 15px;">Ini adalah pertanyaan tentang jual beli saham yang kerap diajukan. Cara Berinvestasi saham adalah membuat rekening efek di perusahaan sekuritas</p>
                </div>

                <button class="accordion"><a class="acc font pl-4 pr-3" style="font-size: 20px; color: #432C1A; ">Bagaimana Cara Investasi Saham ?</a></button>
                <div class="panel">
                    <p class="pl-4" style="font-size: 15px;">Ini adalah pertanyaan tentang jual beli saham yang kerap diajukan. Cara Berinvestasi saham adalah membuat rekening efek di perusahaan sekuritas</p>
                </div> -->

            </div>
        </div>
    </div>
</div>
<img class="mb-4" src="<?= base_url() ?>/public/assets/img/pricing/pricing_bawah.png" style="" width="100%" height="100%">
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("actived");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>
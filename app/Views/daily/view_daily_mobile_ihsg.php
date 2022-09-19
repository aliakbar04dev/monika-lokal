<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/daily.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/m/css/bootstrap.min.css">
    <style>
        .cke_top {
            display: none !important
        }
        .text-primary-ali {
        color: #145eab;
        font-weight:bold;
    }
    .text-success-ali {
        color: #0ec92d;
        font-weight:bold;
    }
    .text-danger-ali {
        color: #ec1c24;
        font-weight:bold;
    }
    </style>
</head>

<body>

    <div class="containeri">
        <div class="hd">
            <div class="hd-1">Monika Secret | Daily Stock | IHSG | <?= date('d / m / Y') ?></div>
        </div>
        <div class="pt-1">
            <?php foreach ($content as $item) :?>
            <?=  $item['content']; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

    <script type="text/javascript">
        CKEDITOR.replace('keteranganDailyweb', {
            height: 300,
        });

        CKEDITOR.instances.keteranganDailyweb.config.readOnly = true;
    </script>

</body>

</html>
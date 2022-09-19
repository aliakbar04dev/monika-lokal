<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
            border-collapse: collapse;
            width: 100%;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }
        </style>
    </head>
<body>

    <table style="width: 100%;">
        <thead>
            <tr height="25px" style="background-color: #ffd737;">
                <td style="font-weight:bold; font-size:12px; color:#000;">Company</td>
                <td style="font-weight:bold; font-size:12px; color:#000;">Code</td>
                <td style="font-weight:bold; font-size:12px; color:#000;">Interval</td>
                <td style="font-weight:bold; font-size:12px; color:#000;">Price</td>
                <td style="text-align: center; font-weight:bold; font-size:12px; color:#000;">Now Status</td>
            </tr>

            <?php foreach($dataResult as $result) : ?>
                <tr height="25px">
                    <td style="font-size:12px; color:#000;"><?= $result['codename'] ?></td>
                    <td style="font-size:12px; color:#000;"><?= $result['code'] ?></td>
                    <td style="font-size:12px; color:#000;"><?= $result['timeframe'] ?></td>
                    <td style="font-size:12px; color:#000;"><?= $result['close'] ?></td>
                    <td style="text-align: center; font-size:12px;">
                        <?php if ( $result['sig_dsl'] == 'Buy' OR $result['sig_dsl'] == 'Avg Up' ) : ?>
                            <b style="font-size:12px; color:#61B210;"><?= $result['sig_dsl'] ?></b>
                        <?php elseif ($result['sig_dsl'] == 'Sell'): ?>
                            <b style="font-size:12px; color:#E50000;"><?= $result['sig_dsl'] ?></b>
                        <?php elseif ($result['sig_dsl'] == ' ' OR $result['sig_dsl'] == '' OR $result['sig_dsl'] == null): ?>
                            <b style="font-size:12px; color:#000;">-</b>
                        <?php else : ?>
                            Error
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </thead>
    </table>

</body>
</html>

